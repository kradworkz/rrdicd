<template>
   <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="media">
                                <div class="mr-3">
                                    <img :src="currentUrl+'/images/avatars/'+user.avatar" alt="" class="avatar-md rounded-circle img-thumbnail">
                                </div>
                                <div class="media-body align-self-center">
                                    <div class="text-muted">
                                        <p class="mb-2 font-size-11">Laboratory Coordinator</p>
                                        <h5 class="mb-1">{{user.firstname}} {{user.lastname}}</h5>
                                        <p class="mb-0 font-size-12">{{insti}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 align-self-center">
                            <div class="text-lg-center mt-4 mt-lg-0">
                                <div class="row">
                                    <div class="col-6" v-for="(list) in counts" v-bind:key="list.id">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">{{list.name}}</p>
                                            <h5 class="mb-0">{{list.counts}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <form class="form-inline float-right">
                                <div class="search-box mt-3">
                                    <div class="position-relative">
                                        <input type="text" class="form-control bg-light border-light rounded" placeholder="Search..." v-model="keyword" @keyup="fetch()">
                                        <i class='bx bx-search-alt search-icon'></i>
                                    </div>
                                </div>
                            </form>  
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>

        <div v-if="results.length > 0" class="col-lg-12">  
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title font-size-12 mb-2">Results for <span class="text-danger">{{keyword}}</span></h6>
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 text-center">
                            <thead class="thead-light">
                                <tr class="font-size-11">
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Purchased At</th>
                                    <th>Created At</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="font-size-11" v-for="(list) in results" v-bind:key="list.id">
                                    <td><a class="text-body font-weight-bold">{{list.code}}</a> </td>
                                    <td>{{list.name}}</td>
                                    <td>{{list.type}}</td>
                                    <td><span :class="'badge badge-pill badge-soft-'+list.status.color+' font-size-10'">{{list.status.name}}</span></td>
                                    <td>{{list.purchased_at}}</td>
                                    <td>{{list.created_at}}</td>
                                    <td>
                                        <button @click="edit(list.id,'status',list.status)" type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light" data-toggle="modal" data-target=".exampleModal">
                                            Update
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="results.length == 0" class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title font-size-12 mb-2">Latest Basic Equipments</h6>
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 text-center">
                            <thead class="thead-light">
                                <tr class="font-size-11">
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Purchased At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="font-size-11" v-for="(list) in basic" v-bind:key="list.id">
                                    <td><a class="text-body font-weight-bold">{{list.code}}</a> </td>
                                    <td>{{list.name}}</td>
                                    <td><span :class="'badge badge-pill badge-soft-'+list.status.color+' font-size-10'">{{list.status.name}}</span></td>
                                    <td>{{list.purchased_at}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="results.length == 0" class="col-lg-6" >
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title font-size-12 mb-2">Latest Specialized Equipments</h6>
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 text-center">
                            <thead class="thead-light">
                                <tr class="font-size-11">
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Purchased At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="font-size-11" v-for="(list) in specialized" v-bind:key="list.id">
                                    <td><a class="text-body font-weight-bold">{{list.code}}</a> </td>
                                    <td>{{list.name}}</td>
                                    <td><span :class="'badge badge-pill badge-soft-'+list.status.color+' font-size-10'">{{list.status.name}}</span></td>
                                    <td>{{list.purchased_at}}</td>
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
        props: ['user','insti'],
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
                pagination: {},
                keyword: '',
                counts : [],
                basic: [],
                specialized : [],
                results : [],
                option : '',
                statuses: [],
                status: '',
                id: '',
                purchase : ''
            }
        },

        created(){
            this.fetchCounts();
            this.fetchStatuses();
        },

        methods : {

            fetchStatuses() {
                axios.get(this.currentUrl + '/request/admin/dropdown/Status/Inventory/-')
                .then(response => {
                    this.statuses = response.data.data;
                })
                .catch(err => console.log(err));
            },

            fetch(){
                let key;
                (this.keyword != '' && this.keyword != null) ? key = this.keyword : key = '-';
                axios.get(this.currentUrl + '/request/coordinator/equipment/search/'+key)
                .then(response => {
                    this.results = response.data.data;
                })
                .catch(err => console.log(err));
            },

            fetchCounts(){
                axios.get(this.currentUrl + '/request/coordinator/equipment/dashboard')
                .then(response => {
                    this.counts = response.data;
                    this.basic = response.data[0].lists;
                    this.specialized = response.data[1].lists;
                })
                .catch(err => console.log(err));
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
                }

                $("#update-equipment").modal('show');
            },

            update(){
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
            },

            clear(){
                this.purchase = '';
                this.status = '';
                this.id = '';
                this.option = '';
            }

         }, components: { Multiselect }
    }
</script>