<template>
    <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lists</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create">
                <div class="modal-body">
                    <div class="customerform">
                        <div class="row" style="margin-bottom: -10px;">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name: <span v-if="errors.name" class="haveerror">({{ errors.name[0] }})</span></label>
                                    <input type="text" class="form-control"  v-model="name" style="text-transform: capitalize;">
                                </div>
                            </div>
                        </div>
                        <div class="row" v-if="selected == 'Statuses'">
                            <div class="col-md-12">
                                <label for="formrow-firstname-input">Color: <span v-if="errors.color" class="haveerror">({{ errors.color[0] }})</span></label>
                                <multiselect 
                                    v-model="color" 
                                    :options="colors"
                                    :allow-empty="false">
                                </multiselect>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        
    }
</script>
