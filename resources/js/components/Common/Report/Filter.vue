<template>
<div style="margin-top: 10px; margin-left: 20px; margin-right: 20px;">
    
    <div class="row customerform">
        <div class="col-xl-6" style="margin-bottom: 15px;">
            <div class="form-group">
                <label>Institution:</label>
                <multiselect 
                v-model="institution" 
                :options="institutions" 
                id="ajax" @search-change="asyncFind"
                label="name" track-by="id" :show-labels="false" :allow-empty="true"
                placeholder="Select Institution">
                </multiselect>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="form-group">
                <label>From:</label>
                <input type="date" class="form-control" v-model="from">
            </div>
        </div>
        <div class="col-xl-3">
            <div class="form-group">
                <label>To:</label>
                <input type="date" class="form-control" v-model="to">
            </div>
        </div>

    </div>
</div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
                institutions: [],
                institution: '',
                from: '',
                to: ''
            }
        },

        watch : {
            institution : function(){
                if(this.institution != '' && this.institution != null){
                    this.$parent.fill('id',this.institution);
                }else{
                    this.$parent.clear('id');
                }
            },
            from : function(){
                if(this.from != '' && this.from != null){
                    this.$parent.fill('from',this.from);
                }else{
                    this.$parent.clear('from');
                }
            },
            to : function(){
                if(this.to != '' && this.to != null){
                    this.$parent.fill('to',this.to);
                }else{
                    this.$parent.clear('to');
                }
            }
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
        }, components : { Multiselect }
    }
</script>
