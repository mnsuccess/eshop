import { getError } from "@/utils/helpers";
import router from "@/router";
import PurchaseService from "@/services/PurchaseService";

export const namespaced = true;

export const state = {
  loading: false,
  error: null,
  success: null,
  message: null,
};

export const mutations = {
  SET_LOADING(state, loading) {
    state.loading = loading;
  },
  SET_ERROR(state, error) {
    state.error = error;
  },
  SET_SUCCESS(state, success) {
    state.success = success;
  },
  SET_MESSAGE(state, message) {
    state.message = message;
  },
};

export const getters = {
  loading: (state) => {
    return state.loading;
  },
  error: (state) => {
    return state.error;
  },
  success: (state) => {
    return state.success;
  },
  message: (state) => {
    return state.message;
  },
};

export const actions = {
  purchaseProduct({ commit, state }, product_id) {
    commit("SET_LOADING", true);
    commit("SET_ERROR", null);
    PurchaseService.requestPurchaseProduct(product_id)
      .then((response) => {
        commit("SET_SUCCESS", response.data.success);
        commit("SET_MESSAGE", response.data.message);
        commit("SET_LOADING", false);
        router.push({ path: "/wallet" });
      })
      .catch((error) => {
        commit("SET_LOADING", false);
        commit("SET_ERROR", getError(error));
        if (state.error === "Unauthenticated.") {
          router.push({ path: "/login" });
        }
      });
  },
  reset({ commit }) {
    commit("SET_ERROR", null);
    commit("SET_SUCCESS", null);
    commit("SET_MESSAGE", null);
  },
};
