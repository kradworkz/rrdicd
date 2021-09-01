<template>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body" style="height: 73vh;">
                <button class="btn btn-light btn-block dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-plus mr-1"></i> Create New
                </button>
                <hr></hr>
                <div class="text-center">
                    <div class="mb-2">
                        <i class="bx bxs-book-bookmark text-primary" style="font-size: 30px;"></i>
                    </div>
                    <h4>{{total}}</h4>
                    <p>Total Research</p>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-centered table-nowrap">
                        <tbody>
                            <tr v-for="(status,index) in statuses" v-bind:key="status.id">
                                <td class="font-size-12"><i :class='"bx bxs-circle mr-2 text-"+status.color'></i><span class="mb-0">{{status.name}}</span></td>
                                <td class="text-right"><b class="mb-0 font-size-12">{{status.count}}</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>        
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                currentUrl: window.location.origin,
                errors: [],
                statuses: [],
            }
        },

        computed : {
            total: function (values) {
                return this.statuses.reduce((acc, val) => {
                    return acc + parseInt(val.count);
                }, 0);    
            },
        },

        created(){
            this.fetch();
        },  

        methods : {
            fetch() {
                axios.get(this.currentUrl + '/request/researcher/status')
                .then(response => {
                    this.statuses = response.data;
                })
                .catch(err => console.log(err));
            },
        }
    }
</script>