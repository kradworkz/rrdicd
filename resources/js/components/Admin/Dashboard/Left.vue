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
            <div class="card-body">
            <div class="clearfix">
                                            <div class="float-right">
                                                <div class="input-group input-group-sm">
                                                    <select class="custom-select custom-select-sm">
                                                        <option selected="">Jan</option>
                                                        <option value="1">Dec</option>
                                                        <option value="2">Nov</option>
                                                        <option value="3">Oct</option>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <label class="input-group-text">Month</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="card-title mb-4">Earning</h4>
                                        </div>
                <div class="row">

                    <div class="col-xl-6">
                        <h6 class="card-title font-size-12 mb-2">Field of Science and Technology</h6>
                        <div class="table-responsive mt-3">
                            <table class="table table-centered table-nowrap">
                                <tbody>
                                    <tr class="font-size-11" v-for="(status,index) in statuses" v-bind:key="status.id">
                                        <td><p class="mb-0">{{status.name}}</p></td>
                                        <td><p class="mb-0"><b>{{status.counts}}</b></p></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <h6 class="card-title font-size-12 mb-2">Age group</h6>
                        <div class="table-responsive mt-3">
                            <table class="table table-centered table-nowrap font-size-11">
                                <tbody>
                                    <tr v-for="(list) in ages" v-bind:key="list.id">
                                        <td style="width: 30%">
                                            <p class="mb-0">{{list.name}}</p>
                                        </td>
                                        <td style="width: 25%">
                                            <h5 class="mb-0 font-size-11"><b>{{list.count}}</b> <span class="text-muted font-size-11"> ({{list.percentage}}%)</span></h5></td>
                                        <td>
                                            <div class="progress progress-sm">
                                                <div :class="'progress-bar bg-'+list.color+' rounded'" role="progressbar" :style="'width: '+list.percentage+'%'" :aria-valuenow="list.percentage" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="col-md-12"><hr></hr></div>

                    <div class="col-xl-6">
                        <div class="text-center text-muted mb-0">
                            <div class="row">
                                <div class="col-4" v-for="(list,index) in qualifications" v-bind:key="list.id" >
                                    <div class="mt-1">
                                        <p class="mb-1 text-truncate font-size-12"><i :class="'bx bxs-circle text-'+list.color+' mr-1'"></i>{{ list.name }}</p>
                                        <h5>{{ list.counts }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row">
                             <div class="col-md-6">
                                <div class="d-flex flex-wrap mb-1 mt-1">
                                    <div class="avatar-sm mr-3">
                                        <div class="avatar-title bg-light rounded-circle font-size-18 text-danger">
                                            <i class="bx bx-female"></i>
                                        </div>
                                    </div> 
                                    <h5 class="mb-0 mt-3 text-dark font-size-12">Female <span class="text-muted font-14">- 1</span></h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-wrap mb-1 mt-1">
                                    <div class="avatar-sm mr-3">
                                        <div class="avatar-title bg-light rounded-circle font-size-18 text-info">
                                            <i class="bx bx-male"></i>
                                        </div>
                                    </div> 
                                    <h5 class="mb-0 mt-3 text-dark font-size-12">Male <span class="text-muted font-14">- 1</span></h5>
                                </div>
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
                total: [],
                qualifications: [],
                ages: []
            }   
        },

        created(){
            this.fetchStatuses();
            this.fetchTotals();
            this.fetchQualifications();
            this.fetchAges();
        },

        methods : {
            fetchStatuses(){
                axios.get(this.currentUrl + '/request/admin/dropdowncount/Specialties/-')
                .then(response => {
                    this.statuses = response.data.data;
                })
                .catch(err => console.log(err));
            },

            fetchQualifications(){
                axios.get(this.currentUrl + '/request/admin/dropdowncount/Qualifications/-')
                .then(response => {
                    this.qualifications = response.data.data;
                })
                .catch(err => console.log(err));
            },

            fetchTotals(){
                axios.get(this.currentUrl + '/request/admin/totals')
                .then(response => {
                    this.total = response.data[0];
                })
                .catch(err => console.log(err));
            },

            fetchAges(){
                axios.get(this.currentUrl + '/request/admin/ages')
                .then(response => {
                    this.ages = response.data[0];
                })
                .catch(err => console.log(err));
            },

        }
    }
</script>
