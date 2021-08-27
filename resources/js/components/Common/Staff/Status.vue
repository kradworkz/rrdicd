<template>
    <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create">
                <div class="modal-body">
                    
                    <div class="row customerform" style="margin-right: 10px; margin-left: 10px;">
                         <div class="col-md-12">
                            <div class="form-group">
                                <label>Status: <span v-if="errors.statjs" class="haveerror">({{ errors.status[0] }})</span></label>
                                <multiselect 
                                v-model="status" 
                                :options="statuses" 
                                :show-labels="false" :allow-empty="false"
                                placeholder="Select Status">
                                </multiselect>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><span>Update</span></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</template>

<script>;
    import Multiselect from 'vue-multiselect';
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                statuses : ['Active','Inactive','Disabled'],
                status: '',
                id: ''
            }
        },

        methods : {
            update(status,id){
                this.id = id;
                this.status = status;
            },

            create(){
                axios.post(this.currentUrl + '/request/common/staff/status', {
                    id: this.id,
                    status: this.status
                })
                .then(response => {
                     $("#updatestatus").modal('hide');
                    this.$emit('status', true);
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                });
            },
        }, components: { Multiselect }
    }
</script>