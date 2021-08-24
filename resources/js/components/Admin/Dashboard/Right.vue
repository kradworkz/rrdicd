<template>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title mb-3 font-size-12">Latests Happenings</h6>
                <div class="chat-leftsidebar-nav">
                    <div class="mt-2" v-for="(event,index) in events" v-bind:key="event.id">
                        <div class="card border shadow-none mb-2">
                            <a href="javascript: void(0);" class="text-body">
                                <div class="p-2">
                                    <div class="d-flex">
                                        <div class="avatar-xs align-self-center ml-2 mr-3">
                                            <div :class="'avatar-title rounded bg-transparent text-'+event.color+' font-size-20'">
                                                    <i :class="'bx bx-'+event.type"></i>
                                            </div>
                                        </div>

                                        <div class="overflow-hidden mr-auto">
                                            <h5 class="font-size-13 text-truncate mb-1">{{ event.name }}</h5>
                                            <p class="text-muted text-truncate mb-0">{{event.counts}} Pending meetings</p>
                                        </div>

                                        <div class="float-right font-size-16 mt-2 mr-2">
                                        <i :class="'text-'+event.color+' bx bxs-alarm-exclamation'"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>           
                    </div>
                </div>
                <hr></hr>
                <div class="mt-2">
                    <div class="card border shadow-none mb-2">
                        <a class="text-body">
                            <div class="p-2">
                                <div class="d-flex">
                                    <div class="avatar-xs align-self-center ml-2 mr-3">
                                        <div class="'avatar-title rounded bg-transparent text-danger font-size-20'">
                                            <i class="bx bxs-file bx-tada" style="font-size: 30px;"></i>
                                        </div>
                                    </div>
                                     <div v-if="research.length == 0" class="overflow-hidden mr-auto">
                                        <h4 class="text-danger font-size-15 text-truncate mb-1 mt-2">NO RESEARCH FOUND</h4>
                                    </div>
                                    <div v-else class="overflow-hidden mr-auto">
                                        <h5 class="text-danger font-size-13 text-truncate mb-1 mt-1">{{research.title}}</h5>
                                        <p class="text-secondary text-truncate mb-0" v-if="research.length > 0">{{research.user.profile.firstname}} {{research.user.profile.lastname}}</p>
                                        <h6 class="text-muted font-size-12 text-truncate mt-1 mb-1">{{research.created_at}}</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>           
                </div>
                <div class="mt-2">
                    <div class="card border shadow-none mb-2" @click="attendance()">
                        <a class="text-body">
                            <div class="p-2">
                                <div class="d-flex">
                                    <div class="avatar-xs align-self-center ml-2 mr-3">
                                        <div class="'avatar-title rounded bg-transparent text-warning font-size-20'">
                                            <i class="bx bxs-calendar-exclamation bx-tada" style="font-size: 30px;"></i>
                                        </div>
                                    </div>
                                    
                                    <div v-if="event.length == 0" class="overflow-hidden mr-auto">
                                        <h4 class="text-warning font-size-15 text-truncate mb-1 mt-2">NO CURRENT EVENT</h4>
                                    </div>
                                    <div v-else class="overflow-hidden mr-auto">
                                        <h5 class="text-warning font-size-13 text-truncate mb-1 mt-1">{{event.name}}</h5>
                                        <p v-if="event.length > 0" class="text-warning text-truncate mb-0">{{event.type.name}}</p>
                                        <h6 class="text-muted font-size-12 text-truncate mt-1 mb-1">{{event.date}}</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>           
                </div>
                <div class="mt-2">
                    <div class="card border shadow-none mb-2">
                        <a :href="currentUrl+file.path" target="_blank" class="text-body">
                            <div class="p-2">
                                <div class="d-flex">
                                    <div class="avatar-xs align-self-center ml-2 mr-3">
                                        <div class="'avatar-title rounded bg-transparent text-info font-size-20'">
                                            <i class='bx bx-cloud-download bx-tada' style="font-size: 30px;"></i>
                                        </div>
                                    </div>
                                   <div class="overflow-hidden mr-auto">
                                        <p class="text-info text-truncate mb-0">{{file.name.substring(0,30)+".."}}</p>
                                        <h6 class="text-muted font-size-12 text-truncate mt-1 mb-1">{{file.created_at}}</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>           
                </div>
            </div>
        </div>
    </div>
     <div class="modal fade exampleModal" id="attendance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <event-attendance :event="event" @status="message" ref="attendance"></event-attendance>
    </div>
</div>
</template>

<script>
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
                events: [],
                event: {
                    type: ''
                },
                file: {
                    name: ''
                },
                research: {}
            }   
        },

        created(){
            this.fetch();
        },

        methods : {
            fetch(){
                axios.get(this.currentUrl + '/request/admin/side')
                .then(response => {
                   this.event = response.data[0][0];
                   this.file = response.data[0][1];
                   this.events =  response.data[0][2];
                   this.research = response.data[0][3];

                })
                .catch(err => console.log(err));
            },

            message(val){
                if(val){
                    $("#attendance").modal('hide');
                        Vue.$toast.success('<strong>Attendance Added</strong>', {
                        position: 'bottom-right'
                    });
                    this.fetch();
                }
            },

            attendance(){
                $("#attendance").modal('show'); 
            }
        }
    }
</script>