<template>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body" data-simplebar style="height: 51vh;">
                <div class="row mb-3">
                    <div class="col-xl-6 col-sm-6 form-inline">
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
                            <tr class="font-size-11">
                                <th class="text-center">Title</th>  
                                <th class="text-center">Classification</th>
                                <th class="text-center">IPR Status</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Created Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(research,index) in researches" v-bind:key="research.id"  @click="view(research.id)" :class="{'table-success':trselected == research.id}">
                                <td class="text-center"> {{research.title.substring(0,50)+".."}}</td>
                                <td class="text-center font-size-10">{{research.classification.name}}</td>
                                <td class="text-center font-size-10">{{research.iprstatus.name}}</td>
                                <td class="text-center">
                                    <span :class="'font-size-10 badge badge-'+research.status.color">{{research.status.name}}</span>
                                </td>
                                <td class="text-center font-size-10">{{research.created_at}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                pagination: {},
                keyword: '',
                researches : [],
                edit: false,
                trselected : '',
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
                let vm = this; let key;
                (this.keyword != '' && this.keyword != null) ? key = this.keyword : key = '-';
                page_url = page_url || this.currentUrl + '/request/researcher/researches/'+key;

                axios.get(page_url)
                .then(response => {
                    this.researches = response.data.data;
                    vm.makePagination(response.data.meta, response.data.links);
                })
                .catch(err => console.log(err));
            },

            view(research){
                this.trselected = research;
            },
        }
    }
</script>

<style lang="scss" scoped>

</style>