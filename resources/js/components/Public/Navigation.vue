<template>
    <ul class="navbar-nav ml-auto" id="topnav-menu" >
        <li class="nav-item">
            <a class="nav-link active" @click="show(1)">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" @click="show(2)">History</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" @click="show(3)">Functions</a>
        </li>
    </ul>
</template>

<script>
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [],
            }
        },

        methods : {
            show(num) {
                this.$parent.show(num);
            },
        }
    }
</script>


