<template>
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reasearcher Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create">
                <div class="modal-body">
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        <li class="nav-item" @click="tab = 'profile'">
                            <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Profile</span> 
                            </a>
                        </li>
                        <li class="nav-item" @click="tab = 'educations'">
                            <a class="nav-link" data-toggle="tab" href="#education" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">Educations</span> 
                            </a>
                        </li>
                        <li class="nav-item" @click="tab = 'trainings'">
                            <a class="nav-link" data-toggle="tab" href="#trainings" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">Trainings</span>   
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content p-3 text-muted" style="height: 330px;">
                        <div class="tab-pane active" id="home" role="tabpanel">
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Designation: <span v-if="errors.designation" class="haveerror">({{ errors.designation[0] }})</span></label>
                                                <multiselect 
                                                v-model="user.designation" 
                                                :options="designations" 
                                                label="name" track-by="id" :show-labels="false" :allow-empty="false"
                                                placeholder="Select Designation">
                                                </multiselect>
                                            </div>
                                        </div>
                                        <div v-if="type != 'Secretariat'" class="col-md-8">
                                            <div class="form-group">
                                                <label>Institution: <span v-if="errors.institution" class="haveerror">({{ errors.institution[0] }})</span></label>
                                                <multiselect 
                                                v-model="user.institution" 
                                                :options="institutions" 
                                                id="ajax" @search-change="asyncFind" @input="onChangeCustomer(institution.institution_id)"
                                                label="name" track-by="id" :show-labels="false" :allow-empty="false"
                                                placeholder="Select Institution">
                                                </multiselect>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Specialty: <span v-if="errors.specialty" class="haveerror">({{ errors.specialty[0] }})</span></label>
                                                <multiselect 
                                                v-model="user.specialty" 
                                                :options="specialties" 
                                                label="name" track-by="id" :show-labels="false" :allow-empty="false"
                                                placeholder="Select Specialty">
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
                        <div class="tab-pane" id="education" role="tabpanel"><br>
                            <div style="margin-left: 15px;" v-for="(list , index) in lists" class="row customerform" v-bind:key="'a-'+list.id+index">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Year Graduated: <span v-if="errors['lists.'+index+'.year']" class="haveerror"> {{( errors['lists.'+index+'.year'][0] )}}</span></label>
                                        <input type="text" class="form-control" v-model="list.year" maxlength="4">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Institution:  <span v-if="errors['lists.'+index+'.institution']" class="haveerror"> {{( errors['lists.'+index+'.institution'][0] )}}</span></label>
                                        <input type="text" class="form-control" v-model="list.institution" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Degree\Program:  <span v-if="errors['lists.'+index+'.degree']" class="haveerror"> {{( errors['lists.'+index+'.degree'][0] )}}</span></label>
                                        <input type="text" class="form-control" v-model="list.degree" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Qualification: <span v-if="errors['lists.'+index+'.qualification']" class="haveerror"> {{( errors['lists.'+index+'.qualification'][0] )}}</span></label>
                                         <multiselect 
                                        v-model="list.qualification" 
                                        :options="qualifications" 
                                        label="name" track-by="id" :show-labels="false" :allow-empty="false"
                                        placeholder="Select Qualification">
                                        </multiselect>
                                    </div>
                                </div>
                                
                                <div class="col-md-1 mt-3">
                                <i @click="del(index)" class='bx bxs-x-square' style="font-size: 35px;"></i>
                                </div>
                            </div>
                            <center><button type="button" @click="add" class="ml-4 btn btn-outline-danger btn-sm waves-effect waves-light">Add more</button></center>
                        </div>
                        <div class="tab-pane" id="trainings" role="tabpanel"><br>
                          <div style="margin-left: 15px;" v-for="(training , index) in trainings" class="row customerform" v-bind:key="'a-'+training.id+index">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title: <span v-if="errors['trainings.'+index+'.title']" class="haveerror"> {{( errors['trainings.'+index+'.title'][0] )}}</span></label>
                                        <input type="text" class="form-control" v-model="training.title" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Inclusive Dates:  <span v-if="errors['trainings.'+index+'.date']" class="haveerror"> {{( errors['trainings.'+index+'.date'][0] )}}</span></label>
                                        <input type="date" class="form-control" v-model="training.date">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Venue:  <span v-if="errors['trainings.'+index+'.venue']" class="haveerror"> {{( errors['trainings.'+index+'.venue'][0] )}}</span></label>
                                        <input type="text" class="form-control" v-model="training.venue" style="text-transform: capitalize;">
                                    </div>
                                </div>
                                
                                <div class="col-md-1 mt-3">
                                <i @click="del(index)" class='bx bxs-x-square' style="font-size: 35px;"></i>
                                </div>
                            </div>
                            <center><button type="button" @click="add" class="ml-4 btn btn-outline-danger btn-sm waves-effect waves-light">Add more</button></center>
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
                types: ['Receiver','Commenter','Approver'],
                user: {id: '',firstname: '',lastname: '',middlename: '',type: '', gender: '', mobile: '',birthdate: '',avatar: '', designation: '',institution: '', specialty: ''},
                photo: {show: false,url: '',signature: ''},
                params: {token: '123456798',name: 'avatar'},
                headers: {smail: '*_~'},
                editable: false,
                isLoading: false,
                fullPage: true,
                institutions: [],
                designations: [],
                specialties: [],
                lists : [],
                trainings : [],
                tab : 'profile',
                qualifications: []
            }
        },

        created(){
            this.fetchDesignation();
            this.fetchSpecialty();
            this.fetchQualification();
        },

        methods : {
            
            asyncFind(value) {
                axios.post(this.currentUrl + '/request/admin/organization/search', {
                    word: value,
                })
                .then(response => {
                    this.institutions = response.data.data;
                })
                .catch(err => console.log(err));
            },


            fetchSpecialty() {
                axios.get(this.currentUrl + '/request/admin/dropdown/Specialties/-/-')
                .then(response => {
                    this.specialties = response.data.data;
                })
                .catch(err => console.log(err));
            },

            fetchQualification() {
                axios.get(this.currentUrl + '/request/admin/dropdown/Qualifications/-/-')
                .then(response => {
                    this.qualifications = response.data.data;
                })
                .catch(err => console.log(err));
            },

            fetchDesignation() {
                axios.get(this.currentUrl + '/request/admin/dropdown/Designations/-/-')
                .then(response => {
                    this.designations = response.data.data;
                })
                .catch(err => console.log(err));
            },

            create(){
                this.isLoading = true;
                axios.post(this.currentUrl + '/request/common/researcher/store', {
                    id: this.user.id,
                    firstname: this.user.firstname,
                    lastname: this.user.lastname,
                    middlename: this.user.middlename,
                    designation: this.user.designation,
                    institution: this.user.institution,
                    specialty: this.user.specialty,
                    email: this.user.email,
                    birthdate: this.user.birthdate,
                    gender: this.user.gender,
                    mobile: this.user.mobile,
                    type: this.user.type,
                    avatar: this.photo.url,
                    lists : this.lists,
                    trainings : this.trainings,
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
                     this.isLoading = false;
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
                this.lists = [];
                this.trainings = [];
            },

            toggleShow() {
                this.photo.show = !this.photo.show;
            },

            cropSuccess(imgDataUrl, field) {
                this.photo.url = imgDataUrl;
            },

            add() {
                if(this.tab == 'educations'){
                    this.lists.push({year: '',institution: '',degree:'',qualification: ''});
                }else{
                    this.trainings.push({title: '',date: '',venue:''});
                }
            },

            del(index) {
                (this.tab == 'educations') ? this.lists.splice(index, 1) : this.trainings.splice(index, 1)
            },

        }, components: { Multiselect, myUpload, Loading }
    }
</script>