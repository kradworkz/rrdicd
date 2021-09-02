<template>
    <section v-bind:class="[(researches.length > 0) ? '' : 'my-5 pt-sm-5']">
        <div class="container" v-if="view == false">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="home-wrapper">
                        <h4 class="mt-5 text-primary">Find your research here. <i class='bx bx-wink-smile' ></i></h4>
                        <p>Discover scientific knowledge and stay connected to the world of science.</p>
                        <div class="row justify-content-center">
                            <div class="search-box chat-search-box py-4">
                                <div class="position-relative" style="width: 600px;">
                                    <input type="text" class="form-control" placeholder="Search research title..." v-model="keyword" @keyup="fetch()">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table project-list-table table-nowrap table-centered table-borderless">
                                <tbody>
                                    <tr v-for="(research,index) in researches" v-bind:key="research.id">   
                                        <td class="text-left">
                                            <div class="team" >
                                                <a href="javascript: void(0);" class="team-member d-inline-block" data-toggle="tooltip" data-placement="top" title="" data-original-title="Daniel Canales">
                                                    <img src="assets/images/users/avatar-2.jpg" class="rounded-circle avatar-xs m-1" alt=""> {{research.researcher.firstname}} {{research.researcher.lastname}}
                                                </a>
                                            </div>
                                        </td>
                                        <td >
                                            <h5 class="text-truncate font-size-14 mb-0"><a href="#" class="text-dark">{{ research.title}}</a></h5>
                                            <p class="text-muted mb-0">{{research.researcher.institution.name}}</p>
                                        </td>
                                        <td>{{research.created_at}}</td>
                                        <td><button @click="viewR(research)" type="button" class="btn btn-danger btn-sm w-sm waves-effect waves-light">View</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="button-items mt-4">
                            <a href="#" class="btn w-lg btn-danger">RRDICOM</a>
                            <a href="/login" class="btn w-lg btn-secondary">Login Here</a>
                        </div>
                        <div class="mt-5 text-center"><div><p>©  RRDICOM. Developed by DOST-IX</p></div></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" v-else>
            <public-view :research="research" @status="message"></public-view>
        </div>
    </section>

</template>

<script>
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
                pagination: {},
                keyword: '',
                researches: [],
                view: false,
                research: {}
            }
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
                let vm = this; let key;
                (this.keyword != '' && this.keyword != null) ? key = this.keyword : key = '-';
                page_url = page_url || this.currentUrl + '/search/'+key;
                if(this.keyword == ''){
                    this.researches = [];
                }else{
                    axios.get(page_url) 
                    .then(response => {
                        this.researches = response.data.data;
                        vm.makePagination(response.data.meta, response.data.links);
                    })
                    .catch(err => console.log(err));
                }
            },

            viewR(research){
                this.view = true;
                this.research = research;
            },

            message(){
                this.view = false;
            }
        }
    }
</script>
