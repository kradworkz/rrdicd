<template>
    <div class="card card-body"> 
        
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div>
                   <div class="float-right" style="margin-top: -10px;">
                        <button @click="notes"  type="button" class="btn btn-light">
                            <span class="d-none d-sm-inline-block "><i class='bx bx-notepad'></i></span>
                        </button>
                        <button @click="attendance"  type="button" class="btn btn-light">
                            <span class="d-none d-sm-inline-block "><i class='bx bx-user-plus'></i></span>
                        </button>
                        <button @click="print(event.id)" type="button" class="btn btn-light">
                            <span class="d-none d-sm-inline-block "><i class='bx bx-printer'></i></span>
                        </button>
                        <button @click="close('back')"  type="button" class="btn btn-light">
                            <span class="d-none d-sm-inline-block "><i class='bx bxs-left-arrow-circle'></i></span>
                        </button>
                    </div>
                    <h4 class="card-title mb-3">Attendance Lists : <span class="text-danger">{{event.name}}</span></h4>

                    <hr>
                    <div v-if="note == false">
                        <div class="text-center">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div>
                                        <p class="text-muted mb-1 font-size-11">Schedule At</p>
                                        <h5 class="font-size-13">{{ event.date }}</h5>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div>
                                        <p class="text-muted mb-1 font-size-11">Type of meeting</p>
                                        <h5 class="font-size-13">{{ event.type.name }}</h5>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mt-4 mt-sm-0">
                                        <p class="text-muted font-size-11 mb-1">Created At</p>
                                        <h5 class="font-size-13">{{ event.created_at }}</h5>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mt-4 mt-sm-0">
                                        <p class="text-muted font-size-11 mb-1">No. of Attendees</p>
                                        <h5 class="font-size-13">{{ attendees.length }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap mb-0 font-size-12">
                                <thead class="thead-light">
                                    <tr>
                                        <th></th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Institution</th>
                                        <th class="text-center">Representative</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in attendees" v-bind:key="user.id">
                                    <td>
                                            <div class="avatar-xs" v-if="user.avatar == 'n/a'">
                                                <span class="avatar-title rounded-circle">{{user.name.charAt(0)}}</span>
                                            </div>
                                            <div v-else>
                                                <img class="rounded-circle avatar-xs" :src="currentUrl+'/images/avatars/'+user.avatar" alt="">
                                            </div>
                                        </td>
                                        <td class="text-center"><a href="javascript: void(0);" class="text-body font-weight-bold">{{ user.name }}</a> </td>
                                        <td class="text-center">{{ user.institution }}</td>
                                        <td class="text-center">
                                            {{ user.representative }}
                                        </td>
                                        <td class="text-center">
                                        {{ user.created_at }}
                                        </td>
                                        <td class="text-center">
                                            <button @click="remove(user.id)" type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                                Remove
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div v-else>
                         <vue-editor v-model="content" style="max-height: 500px; overflow-y: scroll"></vue-editor>
                         <button @click="save" type="button" class="float-right mt-2 btn btn-success w-lg waves-effect waves-light">Save</button>
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
    import { VueEditor } from "vue2-editor";
    export default {
        props: {
            'event': Object
        },
        data() {
            return {
                currentUrl: window.location.origin,
                errors: [],
                pagination: {},
                attendees: [],
                note: false,
                content: ''
            }
        },

        created(){
            this.fetch();
        },

        methods: {  
            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev,
                    total: meta.total,
                };
                this.pagination = pagination;
            },

            fetch(page_url){
                let vm = this; 
                page_url = page_url || this.currentUrl + '/request/admin/event/attendees/'+this.event.id;
                
                axios.get(page_url)
                .then(response => {
                    this.attendees = response.data.data;
                    vm.makePagination(response.data.meta, response.data.links);
                })
                .catch(err => console.log(err));
            },

            attendance(){
                $("#attendance").modal('show');
            },

            close(type) {
                if (type == 'back') {
                    this.$emit('status', type);
                } else {
                    this.$emit('status', type);
                }
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

            print(id){
                axios.get(this.currentUrl + '/request/admin/event/print/'+id)
                .then(response => {
                })
                .catch(err => console.log(err));
            },

            notes(){
                (this.note == true) ? this.note = false : this.note = true;
                this.content = this.event.content;
            },

            remove(id){
                 axios.get(this.currentUrl + '/request/admin/event/remove/'+id)
                .then(response => {
                    Vue.$toast.success('<strong>Member Removed</strong>', {
                        position: 'bottom-right'
                    });
                    this.fetch();
                })
                .catch(err => console.log(err));
            },

            save(){
                axios.post(this.currentUrl + '/request/admin/event/save', {
                    id: this.event.id,
                    content: this.content,
                })
                .then(response => {
                    Vue.$toast.success('<strong>Saved!</strong>', {
                        position: 'bottom-right'
                    });
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }else{
                        Vue.$toast.error('<strong>Please contact Administrator</strong>', {
                            position: 'bottom-right'
                        });
                    }
                });
            },

        }, components: { VueEditor },
    }

</script>
