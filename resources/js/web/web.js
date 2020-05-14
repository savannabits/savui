import './bootstrap';

// import 'vue-multiselect/dist/vue-multiselect.min.css';
import VueQuillEditor from 'vue-quill-editor';
import Vue2Filters from "vue2-filters";
import Notifications from 'vue-notification';
import VeeValidate from 'vee-validate';
import 'flatpickr/dist/flatpickr.css';
import VueCookie from 'vue-cookie';
import { Admin } from 'craftable';
import VModal from 'vue-js-modal';
import BootstrapVue, {BootstrapVueIcons} from "bootstrap-vue";
import Vue from 'vue';
import Loading from "vue-loading-overlay"
import VueObserveVisibilityPlugin from "vue-observe-visibility";
import 'vue-loading-overlay/dist/vue-loading.css';
import './app-components/bootstrap';
import './index';

import 'craftable/dist/ui';
import VueFormWizard from "vue-form-wizard";
import VueTailwind from "vue-tailwind";
Vue.component('multiselect', ()=>import(/*webpackChunkName: 'vue-multiselect'*/ "vue-multiselect"));
Vue.component('typeahead', () => import(/*webpackChunkName: 'typeahead'*/ "vue-bootstrap-typeahead"));
Vue.use(VeeValidate, {strict: true});
Vue.component('datetime', () => import(/* webpackChunkName: 'flatpickr-datetime'*/ "vue-flatpickr-component")) ;
Vue.use(VueFormWizard,{
    color: "blue"
})
Vue.use(BootstrapVue);
Vue.use(BootstrapVueIcons);
Vue.use(VueTailwind);
Vue.use(VModal, { dialog: true, dynamic: true, injectModalsContainer: true });
Vue.use(VueQuillEditor);
Vue.use(Notifications);
Vue.use(VueCookie);
Vue.use(Vue2Filters);
Vue.use(Loading,{
    // props
    color: 'green',
    loader: 'dots'
});
Vue.use(VueObserveVisibilityPlugin);
new Vue({
    mixins: [Admin],
});
