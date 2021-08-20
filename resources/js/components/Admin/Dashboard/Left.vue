<template>
<div class="row">
    <div class="col-lg-4" v-for="(list,index) in total" v-bind:key="list.id">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-flex flex-wrap">
                    <div class="mr-3">
                        <p class="text-muted text-truncate mb-2">{{list.name}}</p>
                        <h5 class="mb-0">{{list.count}}</h5>
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
            <div class="card-body">
                <div class="text-center text-muted">
                    <div class="row justify-content-center">
                        <div class="col-lg-2" v-for="(list,index) in statuses" v-bind:key="list.id" >
                            <div class="mt-2">
                                <p class="mb-2 text-truncate"><i :class="'bx bxs-circle text-'+list.color+' mr-1'"></i>{{ list.name }}</p>
                                <h5>{{ list.counts }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
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
                statuses: [],
                total: []
            }   
        },

        created(){
            this.fetchStatuses();
            this.fetchTotals();
        },

        methods : {
            fetchStatuses(){
                axios.get(this.currentUrl + '/request/admin/dropdowncount/Status/Research Status')
                .then(response => {
                    this.statuses = response.data.data;
                })
                .catch(err => console.log(err));
            },

            fetchTotals(){
                axios.get(this.currentUrl + '/request/admin/totals')
                .then(response => {
                    this.total = response.data[0];
                    console.log(this.total);
                })
                .catch(err => console.log(err));
            },

        }
    }
</script>
