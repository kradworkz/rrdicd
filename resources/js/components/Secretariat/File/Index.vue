<template>
<div class="d-xl-flex">                
    <div class="w-100">
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
                                <th class="text-center">Created Date</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(file,index) in files" v-bind:key="file.id">
                                <td><i class="bx bxs-file-pdf font-size-16 align-middle text-primary mr-2"></i> {{file.name.substring(0,80)+".."}}</td>
                                <td class="text-center font-size-11">{{file.created_at}}</td>
                                <td class="text-center font-size-11">
                                    <a :href="currentUrl+file.path" target="_blank" type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                       Download
                                    </a> 
                                </td>
                                <td class="text-right">
                                    <a class="mr-3 text-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class='bx bx-show'></i></a>
                                    <a class="mr-3 text-warning" @click="editfile(file)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class='bx bx-edit-alt' ></i></a>
                                    <a class="text-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class='bx bx-trash'></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade exampleModal" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <file-create @status="message" ref="edit"></file-create>
            </div>

        </div>
    </div>   
</div>
</template>

<script>
export default {
    props : ['usertype'],
    data(){
        return {
            currentUrl: window.location.origin,
            errors: [],
            pagination: {},
            keyword: '',
            files : [],
            edit: false
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
            page_url = page_url || this.currentUrl + '/request/admin/files/'+key;

            axios.get(page_url)
            .then(response => {
                this.files = response.data.data;
                vm.makePagination(response.data.meta, response.data.links);
            })
            .catch(err => console.log(err));
        },

        show(research){
            this.research = research;
        },

        editfile(file){
            this.$refs.edit.edit(file);
            this.edit = true;
            $("#add").modal('show');
        },

        message(status) {
            if(status == true){
                this.fetch();
                Vue.$toast.success('<strong>File Uploaded</strong>', {
                    position: 'bottom-right'
                });
            }else{
                this.edit = false; 
                this.fetch();
                Vue.$toast.success('<strong>File Updated</strong>', {
                    position: 'bottom-right'
                });
            }
            $("#add").modal('hide');
        },

        addnew(){
            // this.view = true;
            // this.create = true;
            // this.edit = false;
            this.$refs.edit.clear();
            $("#add").modal('show');
        }
    }, 
}
</script>