<template>
   <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <form @submit.prevent="update">
                <div class="modal-header">
                    <div class="col-md-10">
                        <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Update Status</h5>
                    </div>
                </div>
                <div class="modal-body mb-4">
                    <div class="row ml-3 mr-3 mt-3 mb-3">
                        <div class="col-xl-12">

                            <div class="form-group">
                                <label>Status: <span v-if="errors.status" class="haveerror">({{ errors.status[0] }})</span></label>
                                <multiselect 
                                v-model="status" 
                                :options="statuses" 
                                label="name" track-by="id" :show-labels="false" :allow-empty="false"
                                placeholder="Select Status">
                                </multiselect>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
                statuses: [],
                status: '',
                id: ''
            }
        },

        created(){
            this.fetchStatuses();
        },  

        methods : {
            fetchStatuses() {
                axios.get(this.currentUrl + '/request/admin/dropdown/Status/Research Status/-')
                .then(response => {
                    this.statuses = response.data.data;
                })
                .catch(err => console.log(err));
            },

            set(research){
                this.status = research.status;
                this.id = research.id;
            },

            update(){
                axios.post(this.currentUrl + '/request/common/research/update', {
                    id: this.id,
                    status: this.status.id
                })
                .then(response => {
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
        }, components: { Multiselect }
    }
</script>