<template>
    <div class="row">
        <div class="col-lg-4" v-for="(list,index) in total" v-bind:key="list.id">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex flex-wrap">
                        <div class="mr-3">
                            <p class="text-muted text-truncate mb-2">{{list.name}}</p>
                            <h5 class="mb-0">
                                <span>{{list.count}}</span>
                                <span class="text-info font-size-11" v-if="list.male != 'n/a'"><i
                                        class='text-info bx bx-male'></i> {{list.male}}</span>
                                <span class="text-danger font-size-11" v-if="list.female != 'n/a'"><i
                                        class='text-danger bx bx-female'></i> {{list.female}} </span>
                            </h5>
                        </div>

                        <div class="avatar-sm ml-auto">
                            <div :class="'avatar-title bg-light rounded-circle text-'+list.color+' font-size-20'">
                                <i :class="'bx '+list.icon+''"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" style="min-height: 52vh;">
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative" style="margin-top:-20px;">
                            <input type="text" placeholder="Search..." class="form-control" v-model="keyword" @keyup="fetch()">
                            <span class="bx bx-search-alt"></span>
                        </div>
                    </form>
                    <div class="row" v-if="results.length == 0">
                        <div class="col-lg-4">
                            <div class="border p-3 rounded mt-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-xs mr-3">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                          <i class='bx bxs-book'></i>
                                        </span>
                                    </div>
                                    <h5 class="font-size-14 mb-0">Researches</h5>
                                </div><hr></hr>
                                
                                <button @click="addresearch" class="btn btn-sm btn-block btn-primary">Add Research</button>

                               <hr></hr>
                                <button @click="generate('Research')" class="btn btn-sm btn-block btn-light">Generate Reports</button>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="border p-3 rounded mt-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-xs mr-3">
                                        <span class="avatar-title rounded-circle bg-soft-warning text-warning font-size-18">
                                            <i class='bx bxs-user-circle'></i>
                                        </span>
                                    </div>
                                    <h5 class="font-size-14 mb-0">Researchers</h5>
                                </div>
                                <hr></hr>
                                
                                <button @click="addresearcher" class="btn btn-sm btn-block btn-warning">Add Researcher</button>
                                <hr></hr>
                                <button @click="generate('Researcher')" class="btn btn-sm btn-block btn-light">Generate Reports</button>
                            </div>
                        </div>
                       
                        <div class="col-lg-4">
                            <div class="border p-3 rounded mt-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-xs mr-3">
                                        <span class="avatar-title rounded-circle bg-soft-success text-success font-size-18">
                                            <i class='bx bxs-school' ></i>
                                        </span>
                                    </div>
                                    <h5 class="font-size-14 mb-0">Institutions</h5>
                                </div>
                                <hr></hr>
                                <button class="btn btn-sm btn-block btn-success">Add Institution</button>
                                <hr></hr>
                                <button @click="generate('Institution')" class="btn btn-sm btn-block btn-light">Generate Reports</button>
                            </div>
                        </div>
                    </div>
                    <div class="row" v-else>
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap">
                                <thead>
                                    <tr class="font-size-12">
                                        <th class="text-center">Title</th>  
                                        <th v-if="usertype == 'Researcher'" class="text-center">Classification</th>
                                        <th v-if="usertype == 'Researcher'"class="text-center">IPR Status</th>
                                        <th v-else class="text-center">Researcher</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Created Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(research,index) in results" v-bind:key="research.id">
                                        <td class="text-center"> {{research.title.substring(0,50)+".."}}</td>
                                        <td v-if="usertype == 'Researcher'" class="text-center">{{research.classification.name}}</td>
                                        <td v-if="usertype == 'Researcher'" class="text-center">{{research.iprstatus.name}}</td>
                                        <td v-else class="text-center">{{research.user}}</td>
                                        <td class="text-center">
                                            <span :class="'font-size-11 badge badge-'+research.status.color">{{research.status.name}}</span>
                                        </td>
                                        <td class="text-center font-size-11">{{research.created_at}}</td>
                                        <td class="text-right">
                                            <a @click="show(research)" class="mr-3 text-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><i class='bx bx-show'></i></a>
                                            <a class="mr-3 text-warning" @click="editstatus(research)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class='bx bx-edit-alt' ></i></a>
                                           
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade exampleModal" id="addresearch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <research-add @status="message" ref="edit"></research-add>
        </div>

        <div class="modal fade exampleModal" id="addresearcher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <researcher-create @status="message" :type="usertype" ref="create"></researcher-create>
        </div>
        <div class="modal fade exampleModal" id="reports" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <reports :type="type" @status="message" ref="report"></reports>
        </div>

         <div v-if="view == true" class="modal fade exampleModal" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <research-modal :research="research" @status="message" ref="view"></research-modal>
        </div>

        <div class="modal fade exampleModal" id="statusss" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <research-status  @status="message" ref="status"></research-status>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['usertype'],
        data() {
            return {
                currentUrl: window.location.origin,
                errors: [],
                pagination: {},
                total: [],
                results: [],
                keyword: '',
                type: '',
                research: {},
                view: false
            }
        },

        created() {
            this.fetchTotals();
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
                page_url = page_url || this.currentUrl + '/request/common/researches/'+key;

                axios.get(page_url)
                .then(response => {
                    this.results = response.data.data;
                    vm.makePagination(response.data.meta, response.data.links);
                    if(this.keyword.length < 1){
                        this.results = [];
                    }
                })
                .catch(err => console.log(err));
            },

            show(research){
                this.research = research;
                this.view = true;
                $("#view").modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true
                });
                this.$refs.view.fetchFile();
            },

            editstatus(research){
                this.$refs.status.set(research);
                $("#statusss").modal("show");
            },

            fetchTotals() {
                axios.get(this.currentUrl + '/request/admin/totals')
                .then(response => {
                    this.total = response.data[0];
                })
                .catch(err => console.log(err));
            },

            addresearch(){
                $("#addresearch").modal("show");
            },

            addresearcher(){
                $("#addresearcher").modal("show");
            },

            addinstitution(){
                $("#addinstitution").modal("show");
            },

            message(val){
                if(val){
                    Vue.$toast.success('<strong>Successfully Created</strong>', {
                        position: 'bottom-right'
                    });
                    
                    $("#addresearcher").modal('hide');
                    $("#addresearch").modal('hide');
                    $("#statusss").modal('hide');
                    this.fetch();
                }
            },

            generate(type){
                this.type = type;
                $("#reports").modal("show");
            }
        }
    }

</script>
