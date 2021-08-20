<template>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title mb-3 font-size-14">Current Event</h6>
                    <div class="mt-2">
                        <div class="card border shadow-none mb-2" @click="attendance()">
                            <a href="javascript: void(0);" class="text-body">
                                <div class="p-2">
                                    <div class="d-flex">
                                       <div class="avatar-xs align-self-center ml-2 mr-3">
                                            <div class="'avatar-title rounded bg-transparent text-warning font-size-20'">
                                                <i class="bx bxs-alarm-exclamation bx-tada" style="font-size: 30px;"></i>
                                            </div>
                                        </div>

                                        <div class="overflow-hidden mr-auto">
                                            <h5 class="text-info font-size-13 text-truncate mb-1 mt-1">{{event.name}}</h5>
                                            <p class="text-warning text-truncate mb-0">{{event.type.name}}</p>
                                            <h6 class="text-muted font-size-12 text-truncate mt-1 mb-1">{{event.date}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>           
                    </div>
                <hr></hr>
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
                }
            }   
        },

        created(){
            this.fetchEvents();
            this.fetchEvent();
        },

        methods : {
            fetchEvents(){
                axios.get(this.currentUrl + '/request/admin/dropdowncount/Events/-')
                .then(response => {
                    this.events = response.data.data;
                })
                .catch(err => console.log(err));
            },

            fetchEvent(){
                axios.get(this.currentUrl + '/request/admin/event/today')
                .then(response => {
                    this.event = response.data.data;
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