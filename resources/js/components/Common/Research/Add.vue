<template>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reasearch Information</h5>
                <button type="button" @click="close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="create">
                <div class="modal-body">
                    <div class="row customerform" style="margin-right: 10px; margin-left: 10px;">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Title: <span v-if="errors.title" class="haveerror">({{ errors.title[0] }})</span></label>
                                <input type="text" class="form-control" v-model="research.title" style="text-transform: capitalize;">
                            </div>
                        </div>
                         <div class="col-md-4">
                            <div class="form-group">
                                <label>Researcher: <span v-if="errors.researcher" class="haveerror">({{ errors.researcher[0] }})</span></label>
                                <multiselect 
                                :custom-label="nameWithLang"
                                v-model="research.researcher" 
                                :options="researchers" 
                                id="ajax" @search-change="fetchResearcher" 
                                label="name" track-by="id" :show-labels="false" :allow-empty="false"
                                placeholder="Search Researcher">
                                </multiselect>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Classification: <span v-if="errors.classification" class="haveerror">({{ errors.classification[0] }})</span></label>
                                <multiselect 
                                v-model="research.classification" 
                                :options="classifications" 
                                label="name" track-by="id" :show-labels="false" :allow-empty="false"
                                placeholder="Select Classification">
                                </multiselect>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>IPR Status: <span v-if="errors.iprstatus" class="haveerror">({{ errors.iprstatus[0] }})</span></label>
                                <multiselect 
                                v-model="research.iprstatus" 
                                :options="iprs" 
                                @input="onChange(research.iprstatus.id)"
                                label="name" track-by="id" :show-labels="false" :allow-empty="false"
                                placeholder="Select IPR Status">
                                </multiselect>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Period IPR Covered: <span v-if="errors.period" class="haveerror">({{ errors.period[0] }})</span></label>
                                <input :disabled="addc" type="text" class="form-control" v-model="research.period">
                            </div>
                        </div>

                       

                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox mb-4">
                                <input type="checkbox" class="custom-control-input" v-model="old" @click="check" id="customCheck1">
                                <label class="custom-control-label text-danger" for="customCheck1">Check if old research</label>
                            </div>
                        </div>
                    </div>

                    <div v-if="old == true" class="row customerform" style="margin-right: 10px; margin-left: 10px;">
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status: <span v-if="errors.status" class="haveerror">({{ errors.status[0] }})</span></label>
                                <multiselect 
                                v-model="research.status" 
                                :options="statuses" 
                                label="name" track-by="id" :show-labels="false" :allow-empty="false"
                                placeholder="Select Status">
                                </multiselect>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Amount: <span v-if="errors.amount" class="haveerror">({{ errors.amount[0] }})</span></label>
                                <input type="text" class="form-control" v-model="research.amount">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date Funded: <span v-if="errors.date" class="haveerror">({{ errors.date[0] }})</span></label>
                                <input type="date" class="form-control" v-model="research.date">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Funding Agency: <span v-if="errors.institution" class="haveerror">({{ errors.institution[0] }})</span></label>
                                <multiselect 
                                v-model="research.institution" 
                                :options="institutions" 
                                id="ajax" @search-change="asyncFind" 
                                label="name" track-by="id" :show-labels="false" :allow-empty="false"
                                placeholder="Select Institution">
                                </multiselect>
                            </div>
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
</template>

<script>
    import Loading from 'vue-loading-overlay';
    import Multiselect from 'vue-multiselect';
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                research : {
                    id: '',
                    title : '',
                    classification: '',
                    iprstatus: '',
                    researcher: '',
                    amount: '',
                    date: '',
                    period: '',
                    status: '',
                    institution: ''
                },
                classifications: [],
                researchers: [],
                iprs: [],
                institutions: [],
                editable : false,
                old: false,
                addc : true
            }
        },

        created(){
            this.fetchClassification();
            this.fetchIpr();
            this.fetchStatuses();
        },

        methods : {
            nameWithLang ({ firstname, lastname }) {
                return `${firstname} ${lastname}`;
            },

            onChange(id){
                (id == 10) ? this.addc = false : this.addc = true;
            },

            asyncFind(value) {
                axios.post(this.currentUrl + '/request/admin/organization/funding/search', {
                    word: value,
                })
                .then(response => {
                    this.institutions = response.data.data;
                })
                .catch(err => console.log(err));
            },

            fetchStatuses() {
                axios.get(this.currentUrl + '/request/admin/dropdown/Status/Research Status/-')
                .then(response => {
                    this.statuses = response.data.data;
                })
                .catch(err => console.log(err));
            },

            fetchClassification() {
                axios.get(this.currentUrl + '/request/admin/dropdown/Classifications/-/-')
                .then(response => {
                    this.classifications = response.data.data;
                })
                .catch(err => console.log(err));
            },

            fetchResearcher(value) {
                axios.post(this.currentUrl + '/request/common/researcher/search', {
                    word: value,
                })
                .then(response => {
                    this.researchers = response.data.data;
                })
                .catch(err => console.log(err));
            },

            fetchIpr() {
                axios.get(this.currentUrl + '/request/admin/dropdown/Status/IPR Status/-')
                .then(response => {
                    this.iprs = response.data.data;
                })
                .catch(err => console.log(err));
            },

            create(){
                console.log(this.research.researcher);
                let frm = new FormData();
                frm.append('id', this.research.id);
                frm.append('title', this.research.title);
                frm.append('classification', (this.research.classification != '') ? JSON.stringify(this.research.classification) : '');
                frm.append('iprstatus', (this.research.iprstatus != '') ? JSON.stringify(this.research.iprstatus) : '');
                frm.append('period', this.research.period);
                frm.append('researcher', (this.research.researcher != '') ? JSON.stringify(this.research.researcher) : '');
                frm.append('editable', this.editable);
                frm.append('old', this.old);

                if(this.old == true){
                    frm.append('amount', this.research.amount);
                    frm.append('date', this.research.date);
                    frm.append('institution', this.research.institution.id);
                    frm.append('status', this.research.status.id);
                }

                axios.post(this.currentUrl + '/request/common/research/store', frm)
                .then(response => {
                    (this.editable == true) ? this.$emit('status', 'edit') : this.$emit('status', true) ;
                    this.clear();
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                     this.isLoading = false;
                });
            },

            edit(research){
                this.editable = true;
                this.research = research;
                this.old = research.old;
            },

            clear(){
               this.research = {
                    id: '',
                    title : '',
                    classification: '',
                    iprstatus: '',
                    researcher: '',
                    amount: '',
                    date: '',
                    period: '',
                    status: '',
                    institution: ''
                },
                this.editable = false;
                this.old = false;
            },

            check : function(event) {
                if (event.target.checked) {
                    this.old = true;
                }else{
                    this.old = false;
                }
            },

            close(){
                this.errors = [];
            }

           
        }, components: { Multiselect, Loading }
    }
</script>