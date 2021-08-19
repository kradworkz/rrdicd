<template>
    <div class="card card-body"> 
        
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div>
                   <div class="float-right" style="margin-top: -10px;">
                   
                        <button @click="close('back')"  type="button" class="btn btn-light">
                            <span class="d-none d-sm-inline-block "><i class='bx bxs-left-arrow-circle'></i></span>
                        </button>
                    </div>
                    <h4 class="card-title mb-3">Attendance Lists : <span class="text-danger">{{equipment.name}}</span></h4>

                    <hr>
                    <div class="text-center">
                        <div class="row">
                            <div class="col-sm-4">
                                <div>
                                    <p class="text-muted mb-1 font-size-11">Functional</p>
                                    <h5 class="font-size-13">{{ equipment.quantity }}</h5>
                                </div>
                            </div>
                             <div class="col-sm-4">
                                <div>
                                    <p class="text-muted mb-1 font-size-11">Non-functional</p>
                                    <h5 class="font-size-13">{{ equipment.quantity }}</h5>
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
                                        <a class="mr-3 text-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class='bx bx-show'></i></a>
                                        <a class="mr-3 text-warning"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class='bx bx-edit-alt' ></i></a>
                                        <a class="text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class='bx bx-trash'></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: {
            'equipment': Object
        },
        data() {
            return {
                currentUrl: window.location.origin,
                errors: [],
                keyword: '',
                pagination: {},
                equipments: []
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

            message(val){
                if(val){
                    $("#attendance").modal('hide');
                     Vue.$toast.success('<strong>Attendance Added</strong>', {
                        position: 'bottom-right'
                    });
                    this.fetch();
                }
            },
        }
    }

</script>
