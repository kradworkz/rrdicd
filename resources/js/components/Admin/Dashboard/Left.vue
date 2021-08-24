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
                             <span class="text-info font-size-11" v-if="list.male != 'n/a'"><i class='text-info bx bx-male'></i> {{list.male}}</span>
                            <span class="text-danger font-size-11" v-if="list.female != 'n/a'"><i class='text-danger bx bx-female'></i> {{list.female}} </span>
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
                total: [],
            }   
        },

        created(){
            this.fetchTotals();
        },

        methods : {
          
            fetchTotals(){
                axios.get(this.currentUrl + '/request/admin/totals')
                .then(response => {
                    this.total = response.data[0];
                })
                .catch(err => console.log(err));
            },

        }
    }
</script>
