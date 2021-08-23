<template>
<div>
    <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">File</h5>
                <button type="button" @click="close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="save">
                <div class="modal-body">
                    <div class="row customerform" style="margin-right: 10px; margin-left: 10px;">
                        <div class="col-md-12" v-if="editable == true">
                            <div class="form-group">
                                <label>Name: <span v-if="errors.name" class="haveerror">({{ errors.name[0] }})</span></label>
                                <input type="text" class="form-control" v-model="file.name" style="text-transform: capitalize;">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mt-4 alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-alert-outline mr-2"></i>
                                Allowed Filetype : PDF, Docx
                            </div>
                           <input class="mt-2 mb-4" multiple type="file" @change="uploadFieldChange">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><span v-if="editable == false">Save</span><span v-else>Update</span></button>
                    <button type="button" @click="close" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>

        </div>
    </div>
     <loading :active.sync="isLoading" 
        :can-cancel="true" 
        loader="dots"
        background-color="black"
        :is-full-page="fullPage">
        </loading>
        </div>
</template>

<script>
    import Loading from 'vue-loading-overlay';
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                name: '',
                file: '',
                attachments: [],
                editable : false,
                 isLoading: false,
                fullPage: true
            }
        },

        methods : {

            save(){
                if(this.editable){
                    axios.post(this.currentUrl + '/request/admin/file/store', {
                        id: this.file.id,
                        name: this.file.name,
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
                }else{
                     this.isLoading = true;
                    const config = {
                        headers: {
                            'content-type': 'multipart/form-data'
                        }
                    }
                    let existingObj = this;
                    let data = new FormData();
                    for (var i = this.attachments.length - 1; i >= 0; i--) {
                        data.append('files[]', this.attachments[i]);
                    }

                    axios.post('/request/admin/file/store', data, config)
                    .then(response => {
                        this.$emit('status', true);
                    })
                    .catch(error => {
                         this.isLoading = false;
                        existingObj.output = err;
                        
                    });
                }
            },
    
            uploadFieldChange(e) {
                e.preventDefault();
                var files = e.target.files || e.dataTransfer.files;

                if (!files.length)
                    return;
                for (var i = files.length - 1; i >= 0; i--) {
                    this.attachments.push(files[i]);
                }
            },

            edit(file){
                this.editable = true;
                this.file = file;
            },

            clear(){
                this.editable = false;
            },

            close(){
                this.errors = [];
            }

           
        }, components: { Loading }
    }
</script>