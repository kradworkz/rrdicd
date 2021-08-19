<template>
    <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Attendace Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create">
                <div class="modal-body">
                    <div class="customerform">
                       <div class="col-md-12">
                            <div class="form-group">
                                <label>Member<span v-if="errors.member" class="haveerror">({{ errors.member[0] }})</span></label>
                                <multiselect 
                                v-model="member" 
                                :options="members" 
                                id="ajax" @search-change="asyncFind"
                                label="name" track-by="id" :show-labels="false" :allow-empty="false"
                                placeholder="Select Member">
                                </multiselect>
                            </div>
                       </div>
                       <div class="col-md-12">
                            <div class="custom-control custom-checkbox mb-4">
                                <input type="checkbox" class="custom-control-input" @click="check" id="customCheck1">
                                <label class="custom-control-label text-danger" for="customCheck1">Check if representative</label>
                            </div>
                        </div>
                        <div class="col-md-12" v-if="have == true">
                            <div class="form-group">
                                <label>Representative: <span v-if="errors.representative" class="haveerror">({{ errors.representative[0] }})</span></label>
                                <input type="text" class="form-control" v-model="representative">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    export default {
        props : ['event'],
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                members: [],
                member: '',
                representative: '',
                have: false
            }
        },

        methods : {
            asyncFind(value) {
                axios.post(this.currentUrl + '/request/common/staff/search', {
                    word: value,
                    event: this.event.id
                })
                .then(response => {
                    this.members = response.data.data;
                })
                .catch(err => console.log(err));
            },

            create(){
                axios.post(this.currentUrl + '/request/admin/event/attendance', {
                    user: this.member.id,
                    event: this.event.id,
                    representative: this.representative
                })
                .then(response => {
                    this.clear();
                    this.$emit('status', true);
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                });
            },

            clear(){
                this.members = [];
                this.member = '';
                this.representative = '';
            },

            check : function(event) {
                if (event.target.checked) {
                    this.have = true;
                }else{
                    this.have = false;
                }
            }

         }, components: { Multiselect }
    }
</script>
