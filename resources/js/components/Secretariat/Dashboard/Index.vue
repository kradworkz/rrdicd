<template>
    <div class="row">
   
        <div class="col-lg-8">
            <secretariat-left></secretariat-left>
        </div>
        <div class="col-lg-4">
            <d-secretariat-right></d-secretariat-right>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
                keyword: '',
            }
        }
    }
</script>
