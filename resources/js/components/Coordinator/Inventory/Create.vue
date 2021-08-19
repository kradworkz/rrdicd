<template>
    <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Equipment Information</h5>
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
                                <input type="text" class="form-control" v-model="equipment.name" style="text-transform: capitalize;">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Quantity: <span v-if="errors.quantity" class="haveerror">({{ errors.quantity[0] }})</span></label>
                                <input type="text" class="form-control" v-model="equipment.quantity">
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
    export default {
        props: ['type'],
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                equipment: {id: '',name: '',quantity: ''},
                editable: false,
            }
        },

        methods : {
            create(){
                axios.post(this.currentUrl + '/request/coordinator/equipment/store', {
                    id: this.equipment.id,
                    name: this.equipment.name,
                    quantity: this.equipment.quantity,
                    type: this.type,
                    editable: this.editable
                })
                .then(response => {
                    this.clear();
                    this.$emit('status', true);
                    Vue.$toast.success('<strong>Successfully Created</strong>', {
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

            edit(equipment,editable){
                this.equipment = equipment;
                this.editable = editable;
            },

            clear(){
                $("#new").modal("hide");
                this.editable = false;
                this.equipment = {};  
                this.errors = [];
            }

        }
    }
</script>