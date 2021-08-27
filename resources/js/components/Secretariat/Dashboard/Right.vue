<template>
<div class="row">
    <div class="col-lg-12">
        <div class="card" style="min-height: 430px;">
            <div class="card-body">
                <h6 class="card-title font-size-12">Latest Researcher</h6>
                <div class="mt-2">
                    <div class="card border shadow-none mb-2" @click="attendance()">
                        <a class="text-body">
                            <div class="p-2">
                                <div class="d-flex">
                                    <div class="avatar-xs align-self-center ml-2 mr-3">
                                        <div class="'avatar-title rounded bg-transparent text-primary font-size-20'">
                                            <i class="bx bx-user-circle bx-tada" style="font-size: 30px;"></i>
                                        </div>
                                    </div>
                                    
                                    <div v-if="researcher == null" class="overflow-hidden mr-auto">
                                        <h4 class="text-primary font-size-15 text-truncate mb-1 mt-2">NO NEW RESEARCHER</h4>
                                    </div>
                                    <div v-else class="overflow-hidden mr-auto">
                                        <h5 class="text-primary font-size-13 text-truncate mb-1 mt-1">{{researcher.user.profile.firstname}} {{researcher.user.profile.lastname}}</h5>
                                        <h6 class="text-muted font-size-12 text-truncate mt-1 mb-1">{{researcher.user.profile.created_at}}</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>           
                </div>
                <hr></hr>
                <h6 class="card-title font-size-12">Latest Event</h6>
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
                                    
                                    <div v-if="event  == null" class="overflow-hidden mr-auto">
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
                <h6 class="card-title font-size-12">Latest File</h6>
                <div class="mt-2">
                    <div class="card border shadow-none mb-2">
                        <a @click="download(file.id)" class="text-body">
                            <div class="p-2">
                                <div class="d-flex">
                                    <div class="avatar-xs align-self-center ml-2 mr-3">
                                        <div class="'avatar-title rounded bg-transparent text-info font-size-20'">
                                            <i class='bx bx-cloud-download bx-tada' style="font-size: 30px;"></i>
                                        </div>
                                    </div>
                                    <div v-if="file == null" class="overflow-hidden mr-auto">
                                        <h4 class="text-warning font-size-15 text-truncate mb-1 mt-2">NO CURRENT FILE</h4>
                                    </div>
                                    <div v-else class="overflow-hidden mr-auto">
                                        <p class="text-info text-truncate mb-0">{{file.name.substring(0,30)+".."}}</p>
                                        <h6 class="text-muted font-size-12 text-truncate mt-1 mb-1">{{file.created_at}}</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>           
                </div>

                <h6 class="card-title font-size-12">My Latest Research</h6>
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
                                     <div v-if="research == null" class="overflow-hidden mr-auto">
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
                events: [],
                event: {
                    type: ''
                },
                file: {
                    name: ''
                },
                research: {},
                researcher: {
                    user: {
                        profile: ''
                    }
                }
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
                   this.researcher = response.data[0][4];

                })
                .catch(err => console.log(err));
            },

            download(id){
                axios.post(this.currentUrl + '/request/admin/file/download', {
                    id: id
                })
                .then(response => {
                
                })
                .catch(err => console.log(err));
            },


        }
    }
</script>