<template>
<div class="d-xl-flex">                
    <div class="w-100"  v-if="view == false">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-xl-6 col-sm-6 form-inline">
                        <button type="button" @click="addnew" class="btn btn-danger waves-effect waves-light mr-2"><i class='bx bx-plus-medical'></i></button>
                        <form class="form-inline">
                            <div class="search-box">
                                <div class="position-relative">
                                    <input type="text" class="form-control bg-light border-light rounded" placeholder="Search..." v-model="keyword" @keyup="fetch()">
                                    <i class='bx bx-search-alt search-icon'></i>
                                </div>
                            </div>
                        </form>  
                    </div>
                    <div class="col-xl-6 col-sm-6">
                        <ul class="list-inline user-chat-nav text-right mb-0 dropdown">
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
                </div>

                <div class="table-responsive">
                    <table class="table table-centered table-nowrap">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Created At</th>
                                <th class="text-center">Updated At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="equipment in equipments" v-bind:key="equipment.id">
                              
                                <td>{{equipment.name}}</td>
                                <td class="text-center">{{equipment.quantity}}</td>
                                <td class="text-center font-size-12">{{equipment.created_at}}</td>
                                <td class="text-center font-size-12">{{equipment.updated_at}}</td>
                                <td class="text-center">
                                    <a class="mr-3 text-info" @click="show(equipment)" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class='bx bx-show'></i></a>
                                    <a class="mr-3 text-warning" @click="edit(equipment)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class='bx bx-edit-alt' ></i></a>
                                    <a class="text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="w-100" v-else>
        <inventory-view :equipment="equipment" @status="message"></inventory-view>
    </div>
    
    <div class="modal fade exampleModal" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <inventory-create :type="type" @status="message" ref="create"></inventory-create>
    </div>
</div>
</template>

<script>
export default {
    props: ['type'],
    data(){
        return {
            currentUrl: window.location.origin,
            errors: [],
            pagination: {},
            keyword: '',
            equipments : [],
            view: false
        }
    },

    created(){
        this.fetch();
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

        fetch(page_url) {
            let vm = this; let key;
            (this.keyword != '' && this.keyword != null) ? key = this.keyword : key = '-';
            page_url = page_url || this.currentUrl + '/request/coordinator/equipments/'+this.type+'/'+key;

            axios.get(page_url)
            .then(response => {
                this.equipments = response.data.data;
                vm.makePagination(response.data.meta, response.data.links);
            })
            .catch(err => console.log(err));
        },

        show(equipment){
            this.equipment = equipment;
            this.view = true;
        },


        addnew(){
            $("#new").modal('show');
        },

        edit(equipment){
            this.editable = true;
            $("#new").modal('show');
            this.$refs.create.edit(equipment,true);
        },

        message(val){
            if(val){
                if(this.editable == true){
                    let page_url = '/request/coordinator/equipments/-?page=' + this.pagination.current_page;
                    this.fetch(page_url);
                }else if(val == 'back'){
                    this.view = false;
                }else{
                    this.fetch();
                }
                $("#newloc").modal('hide');
                this.editable = false;
            }
        }

    }, 
}
</script>