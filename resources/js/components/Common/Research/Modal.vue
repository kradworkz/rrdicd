<template>
   <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-10">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">
                    {{research.title}} <span :class="'mr-2 badge badge-'+research.status.color">{{ research.status.name}}</span>
                    </h5>
                    <p class="text-muted" style="margin-top: -5px; margin-bottom: -10px;"><i class="bx bx-calendar-plus font-size-12 align-middle text-primary mr-1"></i><span class="font-size-11">{{research.created_at}}</span></p>
                </div>
                <div class="form-inline float-right">
                    <button @click="ups" type="button"  class="btn btn-light waves-light waves-effect  mr-2">
                    <i class='bx bx-cloud-upload'></i>
                    </button>
                    <div data-toggle="tooltip" data-placement="bottom" data-original-title="Close">
                        <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-light waves-light waves-effect  mr-2">
                        <i class='bx bx-x-circle'></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-body mb-4" v-if="research != null">
                <div class="row ml-3 mr-3 mt-3 mb-3">
                    <div class="col-xl-12">
                       
                       <div class="text-center">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div>
                                        <p class="text-muted mb-1 font-size-11">Researcher</p>
                                        <h5 class="font-size-13">{{research.researcher.firstname}} {{research.researcher.lastname}}</h5>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div>
                                        <p class="text-muted mb-1 font-size-11">Institution</p>
                                        <h5 class="font-size-13">{{ research.researcher.institution.name}}</h5>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div>
                                        <p class="text-muted mb-1 font-size-11">Year Published</p>
                                        <h5 class="font-size-13">{{ research.published}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr></hr>
                        <div class="text-center">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div>
                                        <p class="text-muted mb-1 font-size-11">Funded By</p>
                                        <h5 class="font-size-13">{{ research.institution.name}}</h5>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div>
                                        <p class="text-muted mb-1 font-size-11">Amount</p>
                                        <h5 class="font-size-13">₱{{ formatPrice(research.amount)}}</h5>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mt-4 mt-sm-0">
                                        <p class="text-muted font-size-11 mb-1">Funded Date</p>
                                        <h5 class="font-size-13">{{ research.date }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr></hr>
                        <div class="text-center">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div>
                                        <p class="text-muted mb-1 font-size-11">Classifications</p>
                                        <h5 class="font-size-13">{{ research.classification.name }}</h5>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div>
                                        <p class="text-muted mb-1 font-size-11">IPR Status</p>
                                        <h5 class="font-size-13">{{ research.iprstatus.name }}</h5>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mt-4 mt-sm-0">
                                        <p class="text-muted font-size-11 mb-1">Period IPR Covered</p>
                                        <h5 class="font-size-13">{{ research.period }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <hr></hr>

                        <div class="col-md-12" v-if="upload == true">
                        <form @submit.prevent="save">
                            
                                <div class="mt-4 alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="mdi mdi-alert-outline mr-2"></i>
                                    Allowed Filetype : PDF, Docx
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Upload</button>
                                 <input class="mt-2 mb-4" multiple type="file" @change="uploadFieldChange">
                            
                        </form>
                        </div>

                        <div v-else class="row justify-content-center">
                            <div class="col-xl-3 col-sm-8" v-for="(file,index) in f" v-bind:key="file.id">
                                <div class="card border shadow-none mb-2">
                                    <a @click="download(file.id)" class="text-body">
                                        <div class="p-2">
                                            <div class="d-flex">
                                                <div class="avatar-xs align-self-center mr-2">
                                                    <div class="avatar-title rounded bg-transparent text-primary font-size-20">
                                                        <i class="bx bx-file"></i>
                                                    </div>
                                                </div>

                                                <div class="overflow-hidden">
                                                    <h5 class="font-size-13 text-truncate mt-2">{{file.path}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                         
                    </div>
                    

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            'research' : Object
        },
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
                f: [],
                attachments: [],
                upload: false
            }
        },

        methods : {
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace(',', '.')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
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

            fetchFile(){
                axios.get(this.currentUrl + '/request/common/research/files/'+this.research.id)
                .then(response => {
                    this.f = response.data.data;
                })
                .catch(err => console.log(err));
            },

            save(){
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
                data.append('id', this.research.id);
                axios.post('/request/common/research/upload', data, config)
                .then(response => {
                   this.fetchFile();
                   this.attachments = [];
                   this.upload = false;
                })
                .catch(error => {
                    this.isLoading = false;
                    existingObj.output = err;
                });
            },

            ups(){
                (this.upload == true) ? this.upload = false : this.upload = true;
            },

            download(id){
                axios.post(this.currentUrl + '/request/common/research/download', {
                    id: id,
                    research_id: this.research.id
                })
                .then(response => {})
                .catch(err => console.log(err));
            },
        }
    }
</script>