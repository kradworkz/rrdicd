<template>
    <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create">
                <div class="modal-body">
                    <div class="row customerform" style="margin-right: 10px; margin-left: 10px;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name: <span v-if="errors.name" class="haveerror">({{ errors.name[0] }})</span></label>
                                <input type="text" class="form-control" v-model="event.name" style="text-transform: capitalize;">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Type: <span v-if="errors.type" class="haveerror">({{ errors.type[0] }})</span></label>
                                <multiselect 
                                v-model="event.type" 
                                :options="types" 
                                label="name" track-by="id" :show-labels="false" :allow-empty="false"
                                placeholder="Select Type">
                                </multiselect>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Schedule: <span v-if="errors.schedule" class="haveerror">({{ errors.schedule[0] }})</span></label>
                                <input type="date" class="form-control" v-model="event.schedule">
                            </div>
                        </div>
                         <div class="col-md-4">
                            <div class="form-group">
                                <label>Time: <span v-if="errors.time" class="haveerror">({{ errors.time[0] }})</span></label>
                                <br><vue-timepicker format="hh:mm A" v-model="event.time"></vue-timepicker>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    import VueTimepicker from 'vue2-timepicker/src/vue-timepicker.vue'
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
                pagination: {},
                keyword: '',
                event : {
                    name: '',
                    schedule: '',
                    type: {id: ''},
                    time: ''
                },
                types: [],
                editable: false,
            }
        },

        created(){
            this.fetchEventtype();
        },

        methods : {
            fetchEventtype() {
                axios.get(this.currentUrl + '/request/admin/dropdown/Events/-/-')
                .then(response => {
                    this.types = response.data.data;
                })
                .catch(err => console.log(err));
            },

            create(){
                axios.post(this.currentUrl + '/request/admin/event/store', {
                    id: this.event.id,
                    name: this.event.name,
                    schedule: this.event.schedule,
                    type: this.event.type,
                    time: this.event.time,
                    editable: this.editable,
                })
                .then(response => {
                    this.clear();
                    this.$emit('status', true);
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

            edit(event,editable){
                this.event = event;
                this.editable = editable;
            },

            clear(){
                this.event = {};
            }
        }, components: { Multiselect, VueTimepicker }
    }
</script>

<style>
.vue__time-picker input.display-time {
    display: block;
width: 100%;
height: calc(1.5em + .94rem + 2px);
padding: .47rem .75rem;
font-size: .8125rem;
font-weight: 400;
line-height: 1.5;
color: #495057;
background-color: #fff;
background-clip: padding-box;
border: 1px solid #ced4da;
border-radius: .25rem;
transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
</style>