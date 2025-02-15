require('./bootstrap');
window.Vue = require('vue').default;

//SweetAlert2
import Swal from 'sweetalert2';
window.Swal = Swal;

// Importa Vue y Vuetify
import vuetify from './vuetify';

//Vue select
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import Vue from 'vue';

//Vue signature pad
import VueSignaturePad from 'vue-signature-pad';

//Vue qrcode reader
import { QrcodeStream } from 'vue-qrcode-reader';
Vue.use(QrcodeStream);


Vue.component("v-select", vSelect);
Vue.use(VueSignaturePad);
Vue.component('invima-register', require('./components/InvimaRegister.vue').default);
Vue.component('input-component', require('./components/InputComponent.vue').default);
Vue.component('signature-pad', require('./components/SignaturePad.vue').default);
Vue.component('reception-medicines', require('./components/TechnicalReceptionMedicines.vue').default);
Vue.component('payment-component', require('./components/Doctors/PaymentComponent.vue').default);
Vue.component('cupsxitem-component', require('./components/Imaging/CupitemComponent.vue').default);
Vue.component('accommodation-component', require('./components/accommodation/accomodationComponent.vue').default);

//Medicines
Vue.component('medicine-modal', require('./components/Modals/MedicineModal.vue').default);

//Menú
Vue.component('cost-menu', require('./components/Menu/Cost.vue').default);
Vue.component('production-menu', require('./components/Menu/Production.vue').default);
Vue.component('resportsbi-menu', require('./components/Reports_bi/menu.vue').default);

//Endowment
Vue.component('addcard-component', require('./components/Card/addcardComponent.vue').default);

//Msurgery_procedures
Vue.component('msurgery-table', require('./components/msurgery_procedures/tableComponent.vue').default);

//reinduction
Vue.component('qr-scan', require('./components/reinduction/qrscanComponent.vue').default);
Vue.component('pending-component', require('./components/reinduction/presenter/pendingComponent.vue').default);
Vue.component('viewer-component', require('./components/reinduction/viewer/viewerComponent.vue').default);


const app = new Vue({
  vuetify,
  el: '#app',
});
