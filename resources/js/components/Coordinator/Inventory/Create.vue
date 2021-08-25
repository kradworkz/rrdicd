<template>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Equipment Information</h5>
                <button type="button" class="close" @click="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create">
             <div data-simplebar style="max-height: 300px; overflow: auto;">
                <div class="modal-body">
                  
                        <div v-if="editable == false" v-for="(list , index) in lists" v-bind:key="'a-'+list.id+index" class="row customerform" style="margin-right: 10px; margin-left: 10px;">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Name: <span v-if="errors['lists.'+index+'.name']" class="haveerror"> {{( errors['lists.'+index+'.name'][0] )}}</span></label>
                                    <input type="text" class="form-control form-control-sm" v-model="list.name" style="text-transform: capitalize;">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Quantity: <span v-if="errors.quantity" class="haveerror">({{ errors.quantity[0] }})</span></label>
                                    <input type="text" class="form-control form-control-sm" v-model="list.quantity">
                                </div>
                            </div>
                            <div class="col-md-1 mt-3">
                                <input type="button" class="btn btn-danger btn-sm " value="x" @click="del(index)" />
                            </div>
                        </div>
                        <div v-else class="row customerform" style="margin-right: 10px; margin-left: 10px;">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name: <span v-if="errors['name']" class="haveerror"> {{( errors['name'][0] )}}</span></label>
                                    <input type="text" class="form-control" v-model="equipment.name" style="text-transform: capitalize;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button v-if="editable != true" type="button" @click="add" class="btn btn-secondary">Add</button>
                    <button type="submit" class="btn btn-primary">Save</button>
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
                lists : [{
                    name : '',
                    quantity: 1
                }
                ],
            }
        },

        methods : {
            create(){
                axios.post(this.currentUrl + '/request/coordinator/equipment/store', {
                    id: this.equipment.id,
                    name: this.equipment.name,
                    lists : this.lists,
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
                this.lists = [
                    {
                        name: '',
                        quantity: 1
                    }
                ];
                this.errors = [];
            },

            close(){
                this.errors = [];
            },

            add() {
                this.lists.push({name: '',quantity: 1});
            },

            del(index) {
                this.lists.splice(index, 1);
            },

        }
    }
</script>