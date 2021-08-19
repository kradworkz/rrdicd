<template>
    <div class="card card-body"> 
        
        <div class="row justify-content-center">
               <ul class="list-inline user-chat-nav text-right mb-0 dropdown">
            <li @click="close('back')" class="list-inline-item d-non d-sm-inline-block">
                <button type="button" class="btn btn-light">
                    <span class="d-none d-sm-inline-block "><i class='bx bxs-left-arrow-circle'></i></span>
                </button>
            </li>
        </ul>
            <div class="col-xl-12">
                <div>
                    <div class="text-center">
                        <h4 class="text-primary font-size-16">{{event.name}}</h4>
                    </div>

                    <hr>
                    <div class="text-center">
                        <div class="row">
                            <div class="col-sm-4">
                                <div>
                                    <p class="text-muted mb-2 font-size-11">Schedule At</p>
                                    <h5 class="font-size-13">{{ event.date }}</h5>
                                </div>
                            </div>
                             <div class="col-sm-4">
                                <div>
                                    <p class="text-muted mb-2 font-size-11">Type of meeting</p>
                                    <h5 class="font-size-13">{{ event.type.name }}</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mt-4 mt-sm-0">
                                    <p class="text-muted font-size-11 mb-2">Created At</p>
                                    <h5 class="font-size-13">{{ event.created_at }}</h5>
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
            'event': Object
        },
        data() {
            return {
                currentUrl: window.location.origin,
                errors: [],
                id: 0,
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
