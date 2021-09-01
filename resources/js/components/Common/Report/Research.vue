<template>
<div style="margin-top: 10px; margin-left: 20px; margin-right: 20px;">
    <div class="row">
        <div class="col-xl-4">
            <h6 class="card-title font-size-12 mb-2">Classifications</h6>
            <div class="table-responsive mt-3">
                <table class="table table-centered table-nowrap">
                    <tbody>
                        <tr class="font-size-11" v-for="(status,index) in classifications" v-bind:key="status.id">
                            <td><p class="mb-0">{{status.name}}</p></td>
                            <td class="text-right"><p class="mb-0"><b>{{status.count}}</b></p></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-xl-4">
            <h6 class="card-title font-size-12 mb-2">Statuses</h6>
            <div class="table-responsive mt-3">
                <table class="table table-centered table-nowrap">
                    <tbody>
                        <tr class="font-size-11" v-for="(status,index) in statuses" v-bind:key="status.id">
                            <td><p class="mb-0">{{status.name}}</p></td>
                            <td class="text-right"><p class="mb-0"><b>{{status.count}}</b></p></td>
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
            return {
                currentUrl: window.location.origin,
                errors: [],
                classifications: [],
                statuses: [],
                keyword : ''
            }
        },

        created(){
            this.fetchClassifications();
            this.fetchStatus();
        },

        methods : {

            fetchClassifications(){
                 let key;
                (this.keyword != '' && this.keyword != null) ? key = this.keyword : key = '-';
                axios.get(this.currentUrl + '/request/admin/dropdowns/Classifications/'+key)
                .then(response => {
                    this.classifications = response.data;
                })
                .catch(err => console.log(err));
            },

            fetchStatus(){
                 let key;
                (this.keyword != '' && this.keyword != null) ? key = this.keyword : key = '-';
                axios.get(this.currentUrl + '/request/admin/dropdowns/Status/'+key)
                .then(response => {
                    this.statuses = response.data;
                })
                .catch(err => console.log(err));
            },

            filter(id,from,to){
                this.keyword = id+'*'+from+'*'+to;
                this.fetchClassifications();
                this.fetchStatus();
            }
        }
    }
</script>
