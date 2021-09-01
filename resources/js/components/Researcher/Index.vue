<template>
    <div class="row">
        <r-left></r-left>
        
        <div class="col-md-9">
           <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="media">
                                    <div class="mr-3">
                                        <img :src="currentUrl+'/images/avatars/'+user.avatar" alt="" class="avatar-md rounded-circle img-thumbnail">
                                    </div>
                                    <div class="media-body align-self-center">
                                        <div class="text-muted">
                                            <p class="mb-2 font-size-10">Welcome to RRDICOM</p>
                                            <h5 class="mb-1">{{user.firstname}} {{user.lastname}}</h5>
                                            <p class="mb-0">{{org}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <r-right></r-right>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            'user': Object,
            'org' : String
        },

        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
            }
        },

    

        methods : {
            

        }
    }
</script>
