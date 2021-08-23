<template>
    <div class="card card-body"> 
        
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div>
                   <div class="float-right" style="margin-top: -10px;">
                        <button @click="close('back')"  type="button" class="btn btn-light">
                            <span class="d-none d-sm-inline-block "><i class='bx bxs-left-arrow-circle'></i></span>
                        </button>
                    </div>
                    <h4 class="card-title mb-3"><i class='bx bx-notepad mr-2'></i><span class="text-danger">{{research.title}}</span></h4>

                    <hr>
                    <div class="text-center">
                        <div class="row">
                            <div class="col-sm-3">
                                <div>
                                    <p class="text-muted mb-1 font-size-11">Classifications</p>
                                    <h5 class="font-size-13">{{ research.classification.name }}</h5>
                                </div>
                            </div>
                             <div class="col-sm-3">
                                <div>
                                    <p class="text-muted mb-1 font-size-11">IPR Status</p>
                                    <h5 class="font-size-13">{{ research.iprstatus.name }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mt-4 mt-sm-0">
                                    <p class="text-muted font-size-11 mb-1">Research Status</p>
                                    <h5 class="font-size-13">{{ research.status.name }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mt-4 mt-sm-0">
                                    <p class="text-muted font-size-11 mb-1">Created At</p>
                                    <h5 class="font-size-13">{{ research.created_at }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    

                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: {
            'research': Object
        },
        data() {
            return {
                currentUrl: window.location.origin,
                errors: [],
                pagination: {},
                attendees: []
            }
        },

        methods: {  
            close(type) {
                if (type == 'back') {
                    this.$emit('status', type);
                } else {
                    this.$emit('status', type);
                }
            },
        }
    }

</script>
