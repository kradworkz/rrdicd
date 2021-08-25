<template>
<div class="card card-body">
    <div class="clearfix">
        <div class="float-right">
            <button type="button" class="btn btn-light btn-sm" id="six_months">
                <i class='bx bx-filter' ></i>
            </button>
            <button type="button" class="btn btn-light btn-sm" id="six_months">
                <i class='bx bx-printer'></i>
            </button>
        </div>
        <h4 class="card-title mb-4">Researcher</h4>
    </div>
    <div class="row">
        <div class="col-xl-4">
            <div class="row">
                <div class="col-md-6" v-for="(status,index) in genders" v-bind:key="status.id">
                    <div class="d-flex flex-wrap mb-1 mt-1">
                        <div class="avatar-sm mr-3">
                            <div :class="'avatar-title bg-light rounded-circle font-size-18 text-'+status.color">
                                <i :class="'bx '+status.icon"></i>
                            </div>
                        </div> 
                        <h5 class="mb-0 mt-3 text-dark font-size-12">{{status.name}} <span class="text-muted font-14">- {{status.count}}</span></h5>
                    </div>
                </div>
            </div>
            <hr></hr>
            <h6 class="card-title font-size-12 mt-5 mb-2">Highest Qualification</h6>
            <div class="table-responsive mt-3">
                <table class="table table-centered table-nowrap">
                    <tbody>
                        <tr class="font-size-11" v-for="(status,index) in qualifications" v-bind:key="status.id">
                            <td><p class="mb-0">{{status.name}}</p></td>
                            <td class="text-right"><p class="mb-0"><b>{{status.counts}}</b></p></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-xl-4">
            <h6 class="card-title font-size-12 mb-2">Field of Science and Technology</h6>
            <div class="table-responsive mt-3">
                <table class="table table-centered table-nowrap">
                    <tbody>
                        <tr class="font-size-11" v-for="(status,index) in statuses" v-bind:key="status.id">
                            <td><p class="mb-0">{{status.name}}</p></td>
                            <td class="text-right"><p class="mb-0"><b>{{status.counts}}</b></p></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-xl-4">
            <h6 class="card-title font-size-12 mb-2">Age Group</h6>
            <div class="table-responsive mt-3">
                <table class="table table-centered table-nowrap">
                    <tbody>
                        <tr class="font-size-11" v-for="(list) in ages" v-bind:key="list.id">
                            <td><p class="mb-0">{{list.name}}</p></td>
                            <td class="text-right"><p class="mb-0"><b>{{list.count}}</b> </p></td>
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
                statuses: [],
                qualifications: [],
                ages: [],
                genders: []
            }
        },

        created(){
            this.fetchGender();
            this.fetchAges();
            this.fetchQualifications();
            this.fetchStatuses();
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

            fetchAges(){
                axios.get(this.currentUrl + '/request/admin/ages')
                .then(response => {
                    this.ages = response.data[0];
                })
                .catch(err => console.log(err));
            },

             fetchGender(){
                axios.get(this.currentUrl + '/request/admin/gender')
                .then(response => {
                    this.genders = response.data;
                })
                .catch(err => console.log(err));
            },
        }
    }
</script>
