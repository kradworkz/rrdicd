<template>
    <div>
        <form class="form-horizontal" @submit.prevent="changepassword">
        <br><br>
            
            <div class="form-group row mb-0">
                <div class="col-12 text-right">
                    <button class="btn btn-primary btn-block w-md waves-effect waves-light" type="submit">Verify</button>
                </div>
            </div>

        </form>
     </div>
</template>
<script>
export default {
    data(){
        return{
            currentUrl: window.location.origin,
            errors: [],
            current_password : '',
            password : '',
            password_confirmation: '',
            test: '',
            test1: ''
        }
    },

    methods : {
        changepassword(){
            axios.post(this.currentUrl + '/request/user/password', {
                current_password: this.current_password,
                password: this.password,
                password_confirmation: this.password_confirmation,
            })
            .then(response => {
                if(response.data.success == "First Attempt"){
                    window.location.replace('/home');
                }else{
                    this.current_password = '';
                    this.password = '';
                    this.password_confirmation = '';
                    alert(response.data.success);
                }
            })
            .catch(error => {
                if (error.response.status == 422) {
                   this.errors = error.response.data.errors;
                } 
                
                if(error.response.status == 401){
                   this.test = error.response.data.error;
                }
            });
        }
    }
}
</script>