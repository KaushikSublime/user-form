import Vue from "vue";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import { BootstrapVue } from "bootstrap-vue";
import axios from "axios";
import VueAxios from "vue-axios";

require("./bootstrap");

window.Vue = require("vue");
import Vuelidate from "vuelidate";

Vue.component("add-user", require("./pages/user/AddUser.vue").default);
Vue.prototype.$appUrl = "http://127.0.0.1:8001/api/";

Vue.use(BootstrapVue);
Vue.use(VueAxios, axios);
Vue.use(Vuelidate);

const app = new Vue({
    el: "#app"
});
