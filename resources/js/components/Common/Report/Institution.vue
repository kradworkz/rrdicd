<template>
<div style="margin-top: 10px; margin-left: 20px; margin-right: 20px;">
    <div class="row">
        <div class="col-xl-12">
            <div class="table-responsive mt-3" data-simplebar style="height: 40vh;">
                <table class="table table-centered table-nowrap">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td class="text-center">Researcher</td>
                            <td class="text-center">Research</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="font-size-11" v-for="(status,index) in top" v-bind:key="status.id">
                            <td><p class="mb-0">{{status.name}}</p></td>
                            <td class="text-center"><p class="mb-0"><b>{{status.researchers}}</b></p></td>
                            <td class="text-center"><p class="mb-0"><b>{{status.research}}</b></p></td>
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
                institutions: [],
            }
        },

        created(){
            this.fetchInstitutions();
        },

        computed: {
            top: function() {
                return this.institutions.sort((a, b) => a.research + b.research)
            }
        },

        methods : {

            fetchInstitutions(){
                axios.get(this.currentUrl + '/request/admin/institutions')
                .then(response => {
                    this.institutions = response.data.data;
                })
                .catch(err => console.log(err));
            },

        }
    }
</script>
