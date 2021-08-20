<template>
    <div class="card card-body"> 
        
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div>
                   <div class="float-right" style="margin-top: -10px;">
                        <button @click="add"  type="button" class="btn btn-light">
                            <span class="d-none d-sm-inline-block "><i class='bx bxs-plus-square'></i></span>
                        </button>
                        <button @click="close('back')"  type="button" class="btn btn-light">
                            <span class="d-none d-sm-inline-block "><i class='bx bxs-left-arrow-circle'></i></span>
                        </button>
                    </div>
                    <div class="float-right" style="margin-top: -10px; margin-right: 20px;">
                       <ul class="list-inline user-chat-nav mb-0 dropdown">
                            <li class="list-inline-item d-none d-sm-inline-block font-size-12">{{pagination.current_page}} out of {{pagination.last_page}}</li>
                            <li class="list-inline-item d-none d-sm-inline-block">
                                <a class="btn nav-btn" v-bind:class="[{disabled: !pagination.prev_page_url}]" @click="fetch(pagination.prev_page_url)">
                                    <i class='bx bxs-chevron-left font-size-16'></i>
                                </a>
                            </li>
                            <li class="list-inline-item d-none d-sm-inline-block">
                                <a class="btn nav-btn" v-bind:class="[{disabled: !pagination.next_page_url}]" @click="fetch(pagination.next_page_url)">
                                    <i class='bx bxs-chevron-right font-size-16'></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="float-right" style="margin-top: -10px; margin-right: 20px;">
                        <form class="form-inline">
                            <div class="search-box">
                                <div class="position-relative">
                                    <input type="text" class="form-control bg-light border-light rounded" placeholder="Search..." v-model="keyword" @keyup="fetch()">
                                    <i class='bx bx-search-alt search-icon'></i>
                                </div>
                            </div>
                        </form>  
                    </div>

                    <h4 class="card-title mb-3">Equipment : <span class="text-danger">{{equipment.name}}</span></h4>

                    <hr>
                    <div class="text-center">
                        <div class="row">
                            <div class="col-sm-4">
                                <div>
                                    <p class="text-muted mb-1 font-size-11">Functional</p>
                                    <h5 class="font-size-13">{{ equipment.available }}</h5>
                                </div>
                            </div>
                             <div class="col-sm-4">
                                <div>
                                    <p class="text-muted mb-1 font-size-11">Non-functional</p>
                                    <h5 class="font-size-13">{{ (equipment.quantity - equipment.available) }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mt-4 mt-sm-0">
                                    <p class="text-muted font-size-11 mb-1">Counts</p>
                                    <h5 class="font-size-13">{{ equipment.quantity }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 font-size-12">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">Code</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Purchased At</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="e in equipments" v-bind:key="e.id">
                                    <td class="text-center"><span class="text-body font-weight-bold">{{ e.code }}</span> </td>
                                    <td class="text-center">{{ e.description }}</td>
                                    <td class="text-center">{{ e.purchased_at }}</td>
                                    <td class="text-center"> <span :class="'badge badge-'+e.status.color">{{e.status.name}}</span></td>
                                    <td class="text-center">{{ e.created_at }}</td>
                                    <td class="text-center">
                                        <a class="mr-3 text-info" @click="edit(e.id,'status',e.status)" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class='bx bxs-cog'></i></a>
                                        <a class="mr-3 text-warning" @click="edit(e.id,'purchased',e.purchased_at)"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class='bx bxs-calendar'></i></a>
                                        <a class="text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class='bx bx-trash'></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>


        <div class="modal fade exampleModal" id="update-equipment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Equipment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <form @submit.prevent="update">
                        <div class="modal-body">
                            <div class="customerform">
                                <div class="col-md-12" v-if="option == 'status'">
                                    <div class="form-group">
                                        <label>Status<span v-if="errors.status" class="haveerror">({{ errors.status[0] }})</span></label>
                                        <multiselect 
                                        v-model="status" 
                                        :options="statuses" 
                                        label="name" track-by="id" :show-labels="false" :allow-empty="false"
                                        placeholder="Select Status">
                                        </multiselect>
                                    </div>
                                </div>
                                <div class="col-md-12" v-if="option == 'purchased'">
                                    <div class="form-group">
                                        <label>Purchased Date: <span v-if="errors.purchase" class="haveerror">({{ errors.purchase[0] }})</span></label>
                                        <input type="date" class="form-control" v-model="purchase">
                                    </div>
                                </div>
                                <div class="col-md-12" v-if="option == 'add'">
                                    <div class="form-group">
                                        <label>Quantity: <span v-if="errors.quantity" class="haveerror">({{ errors.quantity[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="quantity">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    export default {
        props: {
            'equipment': Object,
            'type': String
        },
        data() {
            return {
                currentUrl: window.location.origin,
                errors: [],
                keyword: '',
                pagination: {},
                equipments: [],
                statuses: [],
                option: '',
                status: '',
                purchase: '',
                quantity: '',
            }
        },

        created(){
            this.fetch();
            this.fetchStatuses();
        },

        methods: {  
            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev,
                    total: meta.total,
                };
                this.pagination = pagination;
            },

            fetchStatuses() {
                axios.get(this.currentUrl + '/request/admin/dropdown/Status/Inventory/-')
                .then(response => {
                    this.statuses = response.data.data;
                })
                .catch(err => console.log(err));
            },

            fetch(page_url){
                let vm = this; let key;
                (this.keyword != '' && this.keyword != null) ? key = this.keyword : key = '-';
                page_url = page_url || this.currentUrl + '/request/coordinator/equipment/list/'+this.equipment.id+'/'+key;
                
                axios.get(page_url)
                .then(response => {
                    this.equipments = response.data.data;
                    vm.makePagination(response.data.meta, response.data.links);
                })
                .catch(err => console.log(err));
            },

            close(type) {
                if (type == 'back') {
                    this.$emit('status', type);
                } else {
                    this.$emit('status', type);
                }
            },

            edit(id,option,data){
                this.id = id;
                if(option == 'purchased'){
                    this.option = option;
                    this.purchase = data;
                }else if(option == 'status'){
                    this.option = option;
                    this.status = data;
                }else{
                    this.option = option;
                }

                $("#update-equipment").modal('show');
            },

            update(){
                if(this.option == 'add'){
                    if(this.quantity < 1){
                        Vue.$toast.error('<strong>Please add quantity</strong>', {
                            position: 'bottom-right'
                        });
                    }else{
                        axios.get(this.currentUrl + '/request/coordinator/equipment/'+this.type+'/'+this.equipment.id+'/'+this.quantity)
                        .then(response => {
                            $("#update-equipment").modal('hide');
                            this.clear();
                            this.fetch();
                            Vue.$toast.success('<strong>Successfully Added</strong>', {
                                position: 'bottom-right'
                            });
                        })
                        .catch(err => console.log(err));
                    }
                }else{
                    axios.post(this.currentUrl + '/request/coordinator/equipment/update', {
                        id: this.id,
                        status: this.status,
                        purchase: this.purchase,
                        option: this.option
                    })
                    .then(response => {
                        $("#update-equipment").modal('hide');
                        this.clear();
                        this.fetch();
                        Vue.$toast.success('<strong>Successfully Updated</strong>', {
                            position: 'bottom-right'
                        });
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            this.errors = error.response.data.errors;
                        }else{
                            Vue.$toast.error('<strong>Please contact Administrator</strong>', {
                                position: 'bottom-right'
                            });
                        }
                    });
                }
            },

            add(){
                this.option = 'add';
                $("#update-equipment").modal('show');
            },


            clear(){
                this.status = '';
                this.purchase = '';
                this.option = '';
                this.quantity = '';
            }

        }, components: { Multiselect }
    }

</script>
