<template>
<div class="row">
    <div class="col-lg-12">
        <div class="card" style="min-height: 405px;">
            <div class="card-body">

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
            }   
        },

        created(){
            this.fetch();
        },

        methods : {
        }
    }
</script>