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

Vue.component('dropdowns', require('./components/Admin/Dropdown/Index.vue').default);
Vue.component('dropdown-create', require('./components/Admin/Dropdown/Create.vue').default);

Vue.component('organizations', require('./components/Admin/Organization/Index.vue').default);
Vue.component('organization-create', require('./components/Admin/Organization/Create.vue').default);

Vue.component('researchers', require('./components/Admin/Researcher/Index.vue').default);
Vue.component('researcher-create', require('./components/Admin/Researcher/Create.vue').default);
Vue.component('researcher-view', require('./components/Admin/Researcher/View.vue').default);

// COMMON TO SOME USERS //

Vue.component('staffs', require('./components/Common/Staff/Index.vue').default);
Vue.component('staff-create', require('./components/Common/Staff/Create.vue').default);

Vue.component('research', require('./components/Common/Research/Index.vue').default);
Vue.component('research-create', require('./components/Common/Research/Create.vue').default);
Vue.component('research-add', require('./components/Common/Research/Add.vue').default);
Vue.component('research-view', require('./components/Common/Research/View.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
