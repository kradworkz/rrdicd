<template>
   <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 1000px;">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">View Profile</h5>
                <div class="form-inline float-right">
                    <div data-toggle="tooltip" data-placement="top" data-original-title="Print">
                        <button @click="print(user.id)" type="button" class="btn btn-light mr-1">
                            <span class="d-none d-sm-inline-block "><i class='bx bx-printer'></i></span>
                        </button>
                    </div>
                    <div data-toggle="tooltip" data-placement="top" data-original-title="Close">
                        <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-light waves-light waves-effect  mr-2">
                        <i class='bx bx-x-circle'></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-body mb-4">
                <div class="row ml-3 mr-3  mb-3">
                    <div class="col-xl-12 mb-4">
                        <div class="media">
                            <div class="mr-3">
                                <img :src="currentUrl+'/images/avatars/'+user.avatar" alt="" class="avatar-md rounded-circle img-thumbnail">
                            </div>
                            <div class="media-body align-self-center">
                                <div class="text-muted">
                                    <h5 class="mb-1 font-size-14">{{user.firstname}} {{user.lastname}}</h5>
                                    <p class="mb-0 font-size-11">{{user.designation.name }}</p>
                                    <p class="mb-0 font-size-11">{{user.institution.name}}</p>
                                </div>
                            </div>
                        </div>
                        <hr></hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="font-size-12"><i class="bx bx-mail-send mr-1 text-primary"></i> Email Address</h6>
                                <p class="font-size-11 mb-0">{{user.email}}</p>
                            </div>
                            <div class="col-sm-3">
                                <h6 class="font-size-12"><i class="bx bx-mobile mr-1 text-primary"></i>Mobile no.</h6>
                                <p class="font-size-11 mb-0">{{user.mobile}}</p>
                            </div>
                            <div class="col-sm-3">
                                <h6 class="font-size-12"><i class="bx bx-calendar mr-1 text-primary"></i> Birth Date</h6>
                                <p class="font-size-11 mb-0">{{user.birthdate}}</p>
                            </div>
                            <div class="col-sm-3">
                                <h6 class="font-size-12"><i class="bx bx-calendar-x mr-1 text-primary"></i>Created At</h6>
                                <p class="font-size-11 mb-0">{{ user.created_at}}</p>
                            </div>
                        </div>
                        <hr></hr>
                    </div>

                    <div class="col-xl-12" data-simplebar style="height: 30vh;">
                        <h6 class="card-title mb-3">
                            <i class='font-size-11 bx bx-notepad mr-2'></i><span class="text-danger font-size-11">PUBPLICATIONS</span>
                        </h6>
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0">
                                <thead>
                                    <tr class="font-size-11">
                                        <th class="text-center">Year Published</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(research,index) in user.publications" v-bind:key="research.id">
                                        <td class="text-center">{{research.published}}</td>
                                        <td class="text-center">{{research.title.substring(0,30)+".."}}</td>
                                        <td class="text-center">{{research.description}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr></hr>
                        <h6 class="card-title mb-3">
                            <i class='font-size-11 bx bxs-school mr-2'></i><span class="text-info font-size-11">EDUCATIONS</span>
                        </h6>
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0">
                                <thead>
                                    <tr class="font-size-11">
                                        <th class="text-center">Year</th>
                                        <th class="text-center">Institution</th>
                                        <th class="text-center">Program</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(ed,index) in user.educations" v-bind:key="ed.id">
                                        <td class="text-center">{{ed.year}}</td>
                                        <td class="text-center">{{ed.institution}}</td>
                                        <td class="text-center">{{ed.program}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr></hr>
                        <h6 class="card-title mb-3">
                            <i class='font-size-11 bx bxs-school mr-2'></i><span class="text-info font-size-11">TRAININGS</span>
                        </h6>
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0">
                                <thead>
                                    <tr class="font-size-11">
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Venue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(ed,index) in user.trainings" v-bind:key="ed.id">
                                        <td class="text-center">{{ed.date}}</td>
                                        <td class="text-center">{{ed.title}}</td>
                                        <td class="text-center">{{ed.venue}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            'user' : Object
        },
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
            }
        },

        methods : {
            print(id){
                axios.get(this.currentUrl + '/request/common/researcher/print/'+id)
                .then(response => {
                })
                .catch(err => console.log(err));
            },
        }
    }
</script>