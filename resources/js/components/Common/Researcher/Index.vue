<template>
<div class="d-xl-flex">                
    <div class="w-100">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-xl-6 col-sm-6 form-inline">
                         <button type="button" @click="addnew" class="btn btn-danger waves-effect waves-light mr-2"><i class='bx bx-plus-medical'></i></button>
                        <form class="float-sm-right form-inline">
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
                                <th></th>
                                <th class="font-size-12">Name / Email</th>
                                <th class="font-size-12">Designation / Institution</th>
                                <th class="text-center font-size-12">Status</th>
                                <th class="text-center font-size-12">Created Date</th>
                                <th class="text-right"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in users" v-bind:key="user.id">
                                <td>
                                    <div class="avatar-xs" v-if="user.avatar == 'n/a'">
                                        <span class="avatar-title rounded-circle">{{user.lastname.charAt(0)}}</span>
                                    </div>
                                    <div v-else>
                                        <img class="rounded-circle avatar-xs" :src="currentUrl+'/images/avatars/'+user.avatar" alt="">
                                    </div>
                                </td>
                                <td>
                                    <h5 class="font-size-14 mb-1"><a href="#" class="text-dark">{{user.lastname}}, {{user.firstname}} {{user.middlename}}.</a></h5>
                                    <p class="text-muted mb-0 font-size-10">{{user.email}}</p>
                                </td>
                                 <td>
                                    <h5 class="font-size-14 mb-1"><a href="#" class="text-dark">{{user.designation.name}}.</a></h5>
                                    <p class="text-muted mb-0 font-size-10">{{user.institution.name}}</p>
                                </td>
                                <td class="text-center">
                                    <span v-if="user.status == 'Active'" class="badge badge-success font-size-12">Active</span>
                                    <span v-else-if="user.status == 'Inactive'" class="badge badge-secondary font-size-12">Inactive</span>
                                    <span v-else-if="user.status == 'Disabled'" class="badge badge-warning font-size-12">Disabled</span>
                                    <span v-else class="badge badge-danger font-size-12">Retired</span>
                                </td>
                                <td class="text-center">{{user.created_at}}</td>
                                <td class="text-right">
                                    <a class="mr-3 text-info" @click="view(user)" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class='bx bx-show'></i></a>
                                    <a class="mr-3 text-warning" @click="edit(user)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class='bx bx-edit-alt' ></i></a>
                                    <a class="text-danger"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade exampleModal" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <researcher-create @status="message" :type="user_type" ref="create"></researcher-create>
    </div>
    <div class="modal fade exampleModal" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <researcher-view @status="message" :user="user"></researcher-view>
    </div>
  
</div>
</template>

<script>
export default {
    props : ['user_type'],
    data(){
        return {
            currentUrl: window.location.origin,
            errors: [],
            pagination: {},
            keyword: '',
            users : [],
            user : {
                designation: {},
                institution: {},
                specialty: {}
            }
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
                prev_page_url: links.prev
            };
            this.pagination = pagination;
        },

        fetch(page_url) {
            let vm = this; let key;
            (this.keyword != '' && this.keyword != null) ? key = this.keyword : key = '-';
            page_url = page_url || this.currentUrl + '/request/common/researchers/'+key;

            axios.get(page_url)
            .then(response => {
                this.users = response.data.data;
                vm.makePagination(response.data.meta, response.data.links);
            })
            .catch(err => console.log(err));
        },

        addnew(){
            $("#new").modal('show');
            this.$refs.create.clear();
        },

        view(user){
            this.user = user;
            $("#view").modal('show');
        },

        edit(user){
            this.editable = true;
            $("#new").modal('show');
            this.$refs.create.edit(user,true);
        },

        message(val){
            if(val){
                if(this.editable == true){
                    let page_url = '/request/admin/researchers/-?page=' + this.pagination.current_page;
                    this.fetch(page_url);
                    Vue.$toast.success('<strong>Successfully Updated</strong>', {
                        position: 'bottom-right'
                    });
                }else{
                    Vue.$toast.success('<strong>Successfully Created</strong>', {
                        position: 'bottom-right'
                    });
                    this.fetch();
                }
                $("#new").modal('hide');
                this.editable = false;
            }
        }
    }, 
}
</script>