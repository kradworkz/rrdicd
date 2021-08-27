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
                        <div class="row justify-content-center">
                            <div class="col-xl-4 col-sm-6">
                                <div class="card border shadow-none mb-2">
                                    <a href="javascript: void(0);" class="text-body">
                                        <div class="p-2">
                                            <div class="d-flex">
                                                <div class="avatar-xs align-self-center mr-2">
                                                    <div class="avatar-title rounded bg-transparent text-primary font-size-20">
                                                        <i class="bx bx-file"></i>
                                                    </div>
                                                </div>

                                                <div class="overflow-hidden mr-auto">
                                                    <h5 class="font-size-13 text-truncate mb-1">Document</h5>
                                                    <p class="text-muted text-truncate mb-0">21 Files</p>
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
            }
        },

        methods : {
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace(',', '.')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            },
        }
    }
</script>