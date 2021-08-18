<template>
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Staff Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create">
                <div class="modal-body">
                    
                    <div class="row customerform" style="margin-right: 10px; margin-left: 10px;">
                        
                        <div class="col-md-3" style="margin-top: 20px;">
                            <myUpload field="img" @crop-success="cropSuccess" v-model="photo.show" :width="500" :height="500" :params="params" :headers="headers" lang-type="en" img-format="png">
                            </myUpload>
                            <div @click="toggleShow" class="fuzone" style="width: 225px; height: 210px;">
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
                        <div class="col-md-9 customerform" style="margin-top: 20px;">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Lastname: <span v-if="errors.lastname" class="haveerror">({{ errors.lastname[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="user.lastname" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Firstname: <span v-if="errors.firstname" class="haveerror">({{ errors.firstname[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="user.firstname" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Initial: <span v-if="errors.middlename" class="haveerror">({{ errors.middlename[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="user.middlename" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                    <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email: <span v-if="errors.email" class="haveerror">({{ errors.email[0] }})</span></label>
                                        <input type="email" class="form-control" v-model="user.email" style="text-transform: lowercase;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mobile No.: <span v-if="errors.mobile" class="haveerror">({{ errors.mobile[0] }})</span></label>
                                        <input type="text" class="form-control" v-model="user.mobile">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Birthdate: <span v-if="errors.birthdate" class="haveerror">({{ errors.birthdate[0] }})</span></label>
                                        <input type="date" class="form-control" v-model="user.birthdate">
                                    </div>
                                </div>
                                <div class="col-md-4" v-if="type != 'Secretariat'">
                                    <div class="form-group">
                                        <label>Type <span v-if="errors.type" class="haveerror">({{ errors.type[0] }})</span></label>
                                        <multiselect 
                                        v-model="user.type" 
                                        :options="types" 
                                        placeholder="Select Type">
                                        </multiselect>
                                    </div>
                                </div>
                                <div class="col-md-8" v-if="type != 'Secretariat'">
                                    <div class="form-group">
                                        <label>Organization<span v-if="errors.organization" class="haveerror">({{ errors.organization[0] }})</span></label>
                                        <multiselect 
                                        v-model="user.organization" 
                                        :options="organizations" 
                                        id="ajax" @search-change="asyncFind" @input="onChangeCustomer(organization.organization_id)"
                                        label="name" track-by="id" :show-labels="false" :allow-empty="false"
                                        placeholder="Search Organization">
                                        </multiselect>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top: 5px;">
                                    <div class="row" style="margin-top: 20px;">
                                    <div class="col-md-4">
                                        <div class="custom-control custom-radio mb-3">
                                            <input type="radio" id="customRadio1" class="custom-control-input" checked="checked" value="Male" v-model="user.gender">
                                            <label class="custom-control-label" for="customRadio1">Male</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="custom-control custom-radio mb-3">
                                            <input type="radio" id="customRadio2" class="custom-control-input" checked="checked" value="Female" v-model="user.gender">
                                            <label class="custom-control-label" for="customRadio2">Female</label>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><span v-if="editable == true">Update</span><span v-else>Create</span></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</template>

<script>
    import Loading from 'vue-loading-overlay';
    import Multiselect from 'vue-multiselect';
    import myUpload from 'vue-image-crop-upload/upload-2.vue';
    export default {
        props : ['type'],
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                types: ['Secretariat','Laboratory Coordinator'],
                user: {id: '',firstname: '',lastname: '',middlename: '',type: '', gender: '', mobile_no: '',birthdate: '',avatar: '', organization:''},
                photo: {show: false,url: '',signature: ''},
                params: {token: '123456798',name: 'avatar'},
                headers: {smail: '*_~'},
                editable: false,
                isLoading: false,
                fullPage: true,
                organizations: []
            }
        },

        methods : {
            asyncFind(value) {
                axios.post(this.currentUrl + '/request/admin/organization/search', {
                    word: value,
                })
                .then(response => {
                    this.organizations = response.data.data;
                })
                .catch(err => console.log(err));
            },

            create(){
                axios.post(this.currentUrl + '/request/admin/staff/store', {
                    id: this.user.id,
                    firstname: this.user.firstname,
                    lastname: this.user.lastname,
                    middlename: this.user.middlename,
                    email: this.user.email,
                    birthdate: this.user.birthdate,
                    gender: this.user.gender,
                    mobile_no: this.user.mobile,
                    type: this.user.type,
                    organization: this.user.organization,
                    avatar: this.photo.url,
                    editable: this.editable
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

            edit(user,editable){
                this.user = user;
                this.editable = editable;
            },

            clear(){
                this.editable = false;
                $("#new").modal("hide");
                this.isLoading = false;
                this.empty();
            },

            empty(){
                this.user = {};
            },

            toggleShow() {
                this.photo.show = !this.photo.show;
            },

            cropSuccess(imgDataUrl, field) {
                this.photo.url = imgDataUrl;
            }

        }, components: { Multiselect, myUpload, Loading }
    }
</script>