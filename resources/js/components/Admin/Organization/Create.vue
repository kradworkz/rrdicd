<template>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" v-if="org_id == 3">Consortium Information</h5>
                <h5 class="modal-title" id="exampleModalLabel" v-else>Organization Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create">
                <div class="modal-body">
                    <div class="row" style="margin-right: 10px; margin-left: 10px;">
                        <div class="col-md-4">
                            <myUpload field="img" @crop-success="cropSuccess" v-model="photo.show" :width="500" :height="500" :params="params" :headers="headers" lang-type="en" img-format="png">
                            </myUpload>
                            <div @click="toggleShow" class="fuzone" style="width: 210px; height: 210px;">
                                <div v-if="photo.url != ''">
                                    <img :src="photo.url" style="width: 200px; height: 200x;">
                                </div>
                                <div v-else class="fu-text" @click="toggleShow">
                                    <span><i class="fa fa-picture"></i> Click here to upload<br> <span
                                            v-if="errors.avatar"
                                            style="color: red; font-size: 12px; margin-top: -20px;">
                                            ({{ errors.avatar[0] }})</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 customerform" style="margin-top: 15px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name: <span v-if="errors.name" class="haveerror">({{ errors.name[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="institution.name" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Acronym: <span v-if="errors.acronym" class="haveerror">({{ errors.acronym[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="institution.acronym" style="text-transform: uppercase;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email: <span v-if="errors.email" class="haveerror">({{ errors.email[0] }})</span></label>
                                        <input type="text" class="form-control"  v-model="institution.email" style="text-transform: lowercase;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact no.: <span v-if="errors.contact" class="haveerror">({{ errors.contact[0] }})</span></label>
                                        <input type="text" class="form-control"  v-model="institution.contact">
                                    </div>
                                </div>
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
    import myUpload from 'vue-image-crop-upload/upload-2.vue';
    export default {
        props : ['org_id'],
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                institution: {id: '',name: '',acronym: '',avatar: '',email: '', contact: ''},
                photo: {show: false,url: '',signature: ''},
                params: {token: '123456798',name: 'avatar'},
                headers: {smail: '*_~'},
                editable: false,
            }
        },

        methods : {
            create(){
                axios.post(this.currentUrl + '/request/admin/organization/store', {
                    id: this.institution.id,
                    name: this.institution.name,
                    acronym: this.institution.acronym,
                    email: this.institution.email,
                    contact: this.institution.contact,
                    avatar: this.photo.url,
                    editable: this.editable,
                    type: this.org_id
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

            edit(agency,editable){
                this.institution = agency;
                this.editable = editable;
            },

            clear(){
                $("#new").modal("hide");
                this.editable = false;
                this.institution = {};  
                this.errors = [];
            },

            toggleShow() {
                this.photo.show = !this.photo.show;
            },

            cropSuccess(imgDataUrl, field) {
                this.photo.url = imgDataUrl;
            }

        }, components: { myUpload }
    }
</script>