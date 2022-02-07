import Vue from "vue";
import Vuex from "vuex";
import * as user from "@/store/modules/User";
import * as product from "@/store/modules/Product";
import * as transaction from "@/store/modules/Transaction";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {},
  mutations: {},
  actions: {},
  modules: {
    user,
    product,
    transaction,
  },
});
