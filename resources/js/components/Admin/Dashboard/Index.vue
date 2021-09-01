<template>
    <div class="row">
   
        <div class="col-lg-8">
            <secretariat-left :usertype="usertype"></secretariat-left>
        </div>
        <div class="col-lg-4">
            <secretariat-right></secretariat-right>
        </div>
       
    </div>
</template>

<script>
    export default {
        props: ['usertype'],
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
                keyword: '',
            }
        }
    }
</script>
