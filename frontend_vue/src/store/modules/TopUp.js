import { getError } from "@/utils/helpers";
import TopUpService from "@/services/TopUpService";

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
  topupWallet({ commit, dispatch }, amount) {
    commit("SET_LOADING", true);
    commit("SET_ERROR", null);
    TopUpService.requestTopUpWallet(amount)
      .then((response) => {
        commit("SET_SUCCESS", response.data.success);
        commit("SET_MESSAGE", response.data.message);
        dispatch("transaction/getTransactions", {}, { root: true });
        commit("SET_LOADING", false);
        dispatch("user/getUser", {}, { root: true });
      })
      .catch((error) => {
        commit("SET_LOADING", false);
        commit("SET_ERROR", getError(error));
      });
  },
  reset({ commit }) {
    commit("SET_ERROR", null);
    commit("SET_SUCCESS", null);
    commit("SET_MESSAGE", null);
  },
};
