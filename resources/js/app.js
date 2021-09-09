/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import VueToast from 'vue-toast-notification';
Vue.use(VueToast);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('password', require('./components/Password.vue').default);
Vue.component('verify', require('./components/Verify.vue').default);
Vue.component('secretariat', require('./components/Admin/Dashboard/Index.vue').default);
Vue.component('secretariat-left', require('./components/Admin/Dashboard/Left.vue').default);
Vue.component('secretariat-right', require('./components/Admin/Dashboard/Right.vue').default);
Vue.component('secretariat-top', require('./components/Admin/Dashboard/Top.vue').default);
Vue.component('secretariat-bottom-right', require('./components/Admin/Dashboard/RightBottom.vue').default);

Vue.component('dropdowns', require('./components/Admin/Dropdown/Index.vue').default);
Vue.component('dropdown-create', require('./components/Admin/Dropdown/Create.vue').default);

Vue.component('organizations', require('./components/Admin/Organization/Index.vue').default);
Vue.component('organization-create', require('./components/Admin/Organization/Create.vue').default);

Vue.component('events', require('./components/Admin/Event/Index.vue').default);
Vue.component('event-create', require('./components/Admin/Event/Create.vue').default);
Vue.component('event-view', require('./components/Admin/Event/View.vue').default);
Vue.component('event-attendance', require('./components/Admin/Event/Attendance.vue').default);


// COMMON TO SOME USERS //

Vue.component('staffs', require('./components/Common/Staff/Index.vue').default);
Vue.component('staff-create', require('./components/Common/Staff/Create.vue').default);
Vue.component('staff-status', require('./components/Common/Staff/Status.vue').default);

Vue.component('research', require('./components/Common/Research/Index.vue').default);
Vue.component('research-create', require('./components/Common/Research/Create.vue').default);
Vue.component('research-add', require('./components/Common/Research/Add.vue').default);
Vue.component('research-view', require('./components/Common/Research/View.vue').default);
Vue.component('research-modal', require('./components/Common/Research/Modal.vue').default);
Vue.component('research-status', require('./components/Common/Research/Status.vue').default);

Vue.component('researchers', require('./components/Common/Researcher/Index.vue').default);
Vue.component('researcher-create', require('./components/Common/Researcher/Create.vue').default);
Vue.component('researcher-view', require('./components/Common/Researcher/View.vue').default);

Vue.component('reports', require('./components/Common/Report/Report.vue').default);
Vue.component('report-research', require('./components/Common/Report/Research.vue').default);
Vue.component('report-researcher', require('./components/Common/Report/Researcher.vue').default);
Vue.component('report-institution', require('./components/Common/Report/Institution.vue').default);
Vue.component('report-filter', require('./components/Common/Report/Filter.vue').default);


// LABORATORY COORDINATOR// 
Vue.component('coordinator', require('./components/Coordinator/Index.vue').default);
Vue.component('inventory', require('./components/Coordinator/Inventory/Index.vue').default);
Vue.component('inventory-create', require('./components/Coordinator/Inventory/Create.vue').default);
Vue.component('inventory-view', require('./components/Coordinator/Inventory/View.vue').default);

// SECRETARIAT //

Vue.component('d-secretariat', require('./components/Secretariat/Dashboard/Index.vue').default);
Vue.component('d-secretariat-left', require('./components/Secretariat/Dashboard/Left.vue').default);
Vue.component('d-secretariat-right', require('./components/Secretariat/Dashboard/Right.vue').default);
Vue.component('d-secretariat-top', require('./components/Secretariat/Dashboard/Top.vue').default);

Vue.component('file', require('./components/Secretariat/File/Index.vue').default);
Vue.component('file-create', require('./components/Secretariat/File/Create.vue').default);

//RESEARCHER

Vue.component('r-index', require('./components/Researcher/Index.vue').default);
Vue.component('r-left', require('./components/Researcher/Left.vue').default);
Vue.component('r-right', require('./components/Researcher/Right.vue').default);

//PUBLIC

Vue.component('public-search', require('./components/Public/Index.vue').default);
Vue.component('public-view', require('./components/Public/View.vue').default);
Vue.component('public-history', require('./components/Public/History.vue').default);
Vue.component('public-function', require('./components/Public/Functions.vue').default);
Vue.component('public-navigation', require('./components/Public/Navigation.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data(){
        return {
            currentUrl: window.location.origin,
            func: false,
            search: true,
            history: false
        }
    },
    methods : {
        settings(){
            $("#settings").modal('show');
        },
        xsettings(){
            $("#settings").modal('hide');
            Vue.$toast.success('<strong>Successfully Updated</strong>', {
                position: 'bottom-right'
            });
        },
        show(num){
            if(num == 1){
                this.search = true;
                this.history = false;
                this.func = false;
            }else if(num == 2){
                this.search = false;
                this.history = true;
                this.func = false;
            }else{
                this.search = false;
                this.history = false;
                this.func = true;
            }
        }
    }
});
