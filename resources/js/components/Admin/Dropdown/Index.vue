<template>
<div class="d-xl-flex">
    <div class="w-100">
        <div class="d-md-flex">
            
            <div class="card filemanager-sidebar mr-md-2">
                <div class="card-body">
                    <div class="d-flex flex-column h-100">
                        <div class="mb-4">
                            <div class="mb-3">
                                <div class="dropdown">
                                    <button @click="addnew" class="btn btn-light btn-block " type="button">
                                        <i class="mdi mdi-plus mr-1"></i> Create New
                                    </button>
                                </div>
                            </div>
                            <div class="mail-list mt-4">
                                <a @click="change('Status')" :class="{active:selected == 'Status'}">
                                   <i class='bx bx-list-ul mr-2'></i>Statuses
                                </a>
                                <a @click="change('Classifications')" :class="{active:selected == 'Classifications'}">
                                    <i class='bx bx-list-check mr-2'></i>Classifications
                                </a>
                                <a @click="change('Specialties')" :class="{active:selected == 'Specialties'}">
                                    <i class='bx bx-list-check mr-2'></i>Specialties
                                </a>
                                <a @click="change('Designations')" :class="{active:selected == 'Designations'}">
                                    <i class='bx bx-list-check mr-2'></i>Designations
                                </a>
                                <a @click="change('Events')" :class="{active:selected == 'Events'}">
                                    <i class='bx bx-list-check mr-2'></i>Events
                                </a>
                                  <a @click="change('Qualifications')" :class="{active:selected == 'Qualifications'}">
                                    <i class='bx bx-list-check mr-2'></i>Qualifications
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-8 col-sm-8 ">
                                <div class="row">
                                    <div class="col-md-4" v-if="selected == 'Status'">
                                        <multiselect 
                                            v-model="status" 
                                            :options="options"
                                            :allow-empty="false"
                                            :show-labels="false"
                                            @input="onChangeStatus()"
                                            >
                                        </multiselect>
                                    </div>
                                    <div class="col-md-6">
                                        <form class="form-inline">
                                            <div class="search-box">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control bg-light border-light rounded" placeholder="Search..." v-model="keyword" @keyup="fetch()">
                                                    <i class='bx bx-search-alt search-icon'></i>
                                                </div>
                                            </div>
                                        </form>  
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-4">
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
                            <table class="table table-centered table-nowrap mt-4">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th class="text-center" v-if="selected == 'Status'">Color</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="list in lists" v-bind:key="list.id">
                                        <td>{{list.name}}</td>
                                        <td class="text-center" v-if="selected == 'Status'">
                                            <span :class="'badge badge-'+list.color">{{list.color}}</span>
                                        </td>
                                        <td class="text-right">
                                            <button @click="status(list.id,list.status)" class="btn btn-sm btn-success waves-effect waves-light">Activate</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade exampleModal" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Lists</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                        <form @submit.prevent="create">
                            <div class="modal-body">
                                <div class="customerform">
                                    <div class="row" style="margin-bottom: -10px;">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Name: <span v-if="errors.name" class="haveerror">({{ errors.name[0] }})</span></label>
                                                <input type="text" class="form-control"  v-model="name" style="text-transform: capitalize;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="selected == 'Status'">
                                        <div class="col-md-12">
                                            <label for="formrow-firstname-input">Color: <span v-if="errors.color" class="haveerror">({{ errors.color[0] }})</span></label>
                                            <multiselect 
                                                v-model="color" 
                                                :options="colors"
                                                :allow-empty="false">
                                            </multiselect>
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
    </div>
</div>
</template>

<script>
import Multiselect from 'vue-multiselect';
export default {
    data(){
        return {
            currentUrl: window.location.origin,
            errors: [],
            pagination: {},
            keyword: '',
            lists: [],
            id: '',
            name: '',
            type: 'Research Status',
            color: '',
            status: 'Research Status',
            selected: 'Status',
            editable: false,
            options : ["Research Status","IPR Status","Inventory"],
            colors : ["green","red","blue","yellow","black","gray"],
        }
    },

    created(){
        this.fetch();
    },

    methods : {

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
            let vm = this; let key; let statust;
            (this.keyword != '' && this.keyword != null) ? key = this.keyword : key = '-';
            (this.status != '' && this.status != null) ? statust = this.status : statust = '-';
            page_url = page_url || this.currentUrl + '/request/admin/dropdown/'+this.selected+'/'+statust+'/'+key;

            axios.get(page_url)
            .then(response => {
                this.lists = response.data.data;
                vm.makePagination(response.data.meta, response.data.links);
            })
            .catch(err => console.log(err));
        },

        onChangeStatus(){
            (this.selected == 'Status') ? this.type = this.status : '';
            this.fetch();
        },

        create(){
            const form = new FormData();
            form.append('id', this.id);
            form.append('name', this.name);
            form.append('selected', this.selected);
            (this.editable == true) ? form.append('update', 'update') : form.append('update','create');
            form.append('type', this.type);
            (this.selected == "Status") ? form.append('color', this.color) : '';

            axios.post(this.currentUrl + '/request/admin/dropdown/store', form)
            .then(response => {
                let statust;
                (this.status != '' && this.status != null) ? statust = this.status : statust = '-';
                $('#new').modal('hide');
                let page_url = '/request/admin/dropdown/'+this.selected+'/'+statust+'/-/?page=' + this.pagination.current_page;
                this.fetch(page_url);
                Vue.$toast.success('<strong>Successfully Updated</strong>', {
                    position: 'bottom-right'
                });
                this.clear();
            })
            .catch(error => {
                if (error.response.status == 422) {
                    this.errors = error.response.data.errors;
                }
            });
        },

        addnew(){
            $("#new").modal('show');
        },

        change(type){
            this.selected = type;
            (type == 'Status') ? this.status = 'Research Status' : this.status = '';
            this.fetch();
            this.errors = [];
        },

        clear(){
            this.name = '';
            this.editable = false;
        }
     }, components: { Multiselect }
}
</script>