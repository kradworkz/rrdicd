<template>
<div class="row">
    <div class="col-md-12">
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
            }   
        },

        created(){
            this.fetchStatuses();
        },

        methods : {
            fetchStatuses(){
                axios.get(this.currentUrl + '/request/admin/dropdowncount/Status/Research Status')
                .then(response => {
                    this.statuses = response.data.data;
                })
                .catch(err => console.log(err));
            },


        }
    }
</script>
