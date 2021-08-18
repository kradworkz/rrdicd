<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="create" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 customerform">
                                <div class="form-group">
                                    <label>Title: <span v-if="errors.title" class="haveerror">({{ errors.title[0] }})</span></label>
                                    <input type="text" class="form-control" v-model="research.title" style="text-transform: capitalize;">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <vue-editor v-model="research.content"></vue-editor>
                                <input class="mt-4" multiple type="file" @change="uploadFieldChange">
                                <button type="submit" class="btn btn-primary w-md mt-4 float-right"><span v-if="edit == false">Submit</span><span v-else>Update</span></button>
                                <button type="button" @click="cancel" class="btn btn-light w-md mt-4 mr-2 float-right">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { VueEditor } from "vue2-editor";
    export default {
        props: {
            'editresearch' : Object,
            'edit' : Boolean
        },
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
                research : {
                    id: '',
                    title: '',
                    ipr: '',
                    content: '',
                    attachments: [],
                    classification : 10
                },
                attachments: []
            }
        },

        created(){
            (this.edit == true) ? this.research = this.editresearch : '';
        },

        methods : {
            create(){
                axios.post(this.currentUrl + '/request/researcher/research/store', {
                    id: this.research.id,
                    title: this.research.title,
                    content: this.research.content,
                    ipr: this.research.ipr,
                    classification: this.research.classification,
                    filelists: this.research.filelists,
                    editable: this.edit
                })
                .then(response => {
                    this.clear();
                    Vue.$toast.success('<strong>Successfully Created</strong>', {
                        position: 'bottom-right'
                    });
                    this.$emit('status', true);
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                     this.isLoading = false;
                });
            },

            uploadFieldChange(e) {
                e.preventDefault();
                let existingObj = this;
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                var files = e.target.files || e.dataTransfer.files;

                if (!files.length)
                    return;
                for (var i = files.length - 1; i >= 0; i--) {
                    this.attachments.push(files[i]);
                }
    
                let data = new FormData();
                for (var i = files.length - 1; i >= 0; i--) {
                    data.append('files[]', this.attachments[i]);
                }

                axios.post('/upload', data, config)
                .then(function (res) {
                    alert('haha');
                })
                .catch(function (err) {
                    existingObj.output = err;
                });
            },

            cancel(){
                this.$emit('status', true);
            },

            clear(){
                this.research = {};
            }
        },

        components: { VueEditor },
 
    }   
</script>
