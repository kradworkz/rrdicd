<template>
   <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 1000px;">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">View Profile</h5>
                <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mb-4">
                <div class="row ml-3 mr-3 mt-3 mb-3">
                    <div class="col-xl-6">
                        <div class="media">
                            <div class="mr-3">
                                <img :src="currentUrl+'/images/avatars/'+user.avatar" alt="" class="avatar-md rounded-circle img-thumbnail">
                            </div>
                            <div class="media-body align-self-center">
                                <div class="text-muted">
                                    <h5 class="mb-1">{{user.firstname}} {{user.lastname}}</h5>
                                    <p class="mb-0 font-size-8">{{user.designation.name }}</p>
                                    <p class="mb-0">as</p>
                                </div>
                            </div>
                        </div>
                        <hr></hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <h6 class="font-size-12"><i class="bx bxs-institution mr-1 text-primary"></i> Institution</h6>
                                <p class="mb-0 font-size-11">{{user.institution.name}}</p>
                            </div>
                        </div>
                        <hr></hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="font-size-12"><i class="bx bx-mail-send mr-1 text-primary"></i> Email Address</h6>
                                <p class="text-primary font-weight-bold mb-0">{{user.email}}</p>
                            </div>
                            <div class="col-sm-6">
                                <h6 class="font-size-12"><i class="bx bx-mobile mr-1 text-primary"></i>Mobile no.</h6>
                                <p class="text-muted mb-0">{{user.mobile}}</p>
                            </div>
                        </div>
                        <hr></hr>
                        <div class="row task-dates">
                            <div class="col-sm-6">
                                <h6 class="font-size-12"><i class="bx bx-calendar mr-1 text-primary"></i> Birth Date</h6>
                                <p class="text-muted mb-0">{{user.birthdate}}</p>
                            </div>
                            <div class="col-sm-6">
                                <h6 class="font-size-12"><i class="bx bx-calendar-x mr-1 text-primary"></i>Created At</h6>
                                <p class="text-muted mb-0">{{ user.created_at}}</p>
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
        props: {
            'user' : Object
        },
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
            }
        },
    }
</script>