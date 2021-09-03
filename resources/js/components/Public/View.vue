<template>
    <div class="row">
        <div class="col-12 text-center">
            <div class="home-wrapper">
                <div class="float-right" style="font-size: 30px" @click="back"><i class='text-danger bx bx-exit'></i></div>
                <h4 class="mt-5 text-primary">{{research.title }}. <i class='bx bx-wink-smile' ></i></h4>
                <p class="mb-3">Discover scientific knowledge and stay connected to the world of science.</p>
               
                <div class="card border shadow-none ">
                    <div class="row ml-3 mr-3 mt-3 mb-3">
                        <div class="col-xl-12">
                        
                            <div class="text-center mt-4">
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
                                <div class="col-xl-4 col-sm-6" v-for="(file,index) in research.files" v-bind:key="file.id">
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
                                                        <h5 class="font-size-13 text-truncate mt-2">{{file.name}}</h5>
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
    </div>
</template>

<script>
    export default {
        props : ['research'],
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
                pagination: {},
            }
        },
        

        methods : {
            formatPrice(value) {
                let val = (value/1).toFixed(2).replace(',', '.')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            },

            back(){
                this.$emit('status');
            },

            download(id){
                axios.post(this.currentUrl + '/research/download', {
                    id: id,
                    research_id: this.research.id
                })
                .then(response => {})
                .catch(err => console.log(err));
            },
        }
    }
</script>
