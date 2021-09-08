<template>
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{type}} Reports</h5>
                <div class="form-inline float-right">
                    <div v-if="type != 'Institution'" data-toggle="tooltip" data-placement="top" data-original-title="Filter">
                        <button @click="filter" type="button" class="btn btn-light mr-1">
                            <span class="d-none d-sm-inline-block "><i class='bx bx-filter'></i></span>
                        </button>
                    </div>
                    <div data-toggle="tooltip" data-placement="top" data-original-title="Print">
                        <button @click="print(type)" type="button" class="btn btn-light mr-1">
                            <span class="d-none d-sm-inline-block "><i class='bx bx-printer'></i></span>
                        </button>
                    </div>
                    <div data-toggle="tooltip" data-placement="top" data-original-title="Close">
                        <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-light waves-light waves-effect  mr-2">
                        <i class='bx bx-x-circle'></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div v-if="filt == true && type != 'Institution'">
                    <report-filter></report-filter>
                </div>
                <div v-if="type == 'Researcher'">
                    <report-researcher ref="researcherfilter"></report-researcher>
                </div>
                <div v-else-if="type == 'Research'">
                    <report-research ref="researcherfilter"></report-research>
                </div>
                <div v-else>
                     <report-institution></report-institution>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props : ['type'],
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                filt: false,
                id: '-',
                from: '-',
                to: '-'
            }
        },

        created(){
        },

        methods : {
            print(){
                if(this.type == "Institution"){
                    window.open(this.currentUrl + '/request/common/report/print/institution')
                }else{
                    window.open(this.currentUrl + '/request/common/report/print/'+this.type+'/'+this.id)
                }
            },

            filter(){
                (this.filt == true) ? this.filt = false : this.filt = true;
            },

            fill(type,val){
                if(type == 'id'){
                    this.id = val.id;
                }else if(type == 'from'){
                    this.from = val;
                }else{
                    this.to = val;
                }
                if(this.type == "Reseacher"){
                    this.$refs.researcherfilter.filter(this.id,this.from,this.to);
                }else{
                    this.$refs.researchfilter.filter(this.id,this.from,this.to);
                }
            },

            clear(type){
                 if(type == 'id'){
                    this.id = '-';
                }else if(type == 'from'){
                    this.from = '-';
                }else{
                    this.to = '-';
                }
                this.$refs.researcherfilter.filter(this.id,this.from,this.to);
            }
        }
    }
</script>