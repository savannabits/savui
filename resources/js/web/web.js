import './bootstrap';

// import 'vue-multiselect/dist/vue-multiselect.min.css';
import flatPickr from 'vue-flatpickr-component';
import VueQuillEditor from 'vue-quill-editor';
import Vue2Filters from "vue2-filters";
import Notifications from 'vue-notification';
import Multiselect from 'vue-multiselect';
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
import VueBootstrapTypeahead from "vue-bootstrap-typeahead"
import VueFormWizard from "vue-form-wizard";
Vue.component('multiselect', Multiselect);
Vue.component('typeahead', VueBootstrapTypeahead);
Vue.use(VeeValidate, {strict: true});
Vue.component('datetime', flatPickr);
Vue.use(VueFormWizard,{
    color: "blue"
})
Vue.use(BootstrapVue);
Vue.use(BootstrapVueIcons);
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
