require('./bootstrap');
const URL_SOCIAL = process.env.MIX_APP_URL;

window.axios.defaults.baseURL = `${URL_SOCIAL}`;

require('moment');

window.Vue = require('vue');

window.EventBus = new Vue();

// import Vue from 'vue';

/* import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';

Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue); */
// const app = document.getElementById('app');

/* Vue.component('status-form', require('./components/StatusForm.vue').default);
Vue.component('statuses-list', require('./components/StatusesList.vue').default); */
Vue.component('display-get-status', require('./components/DisplayGetStatus.vue').default);

import auth from './Mixins/auth';

Vue.mixin(auth);

const app = new Vue({
    el: '#app'
});

Vue.config.devtools = true;
