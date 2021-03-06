import { getError } from "@/utils/helpers";
import TransactionService from "@/services/TransactionService";

export const namespaced = true;

export const state = {
  transactions: [],
  loading: false,
  error: null,
  success: null,
  message: null,
};

export const mutations = {
  SET_TRANSACTIONS(state, transactions) {
    state.transactions = transactions;
  },
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
  transactions: (state) => {
    return state.transactions;
  },
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
  getTransactions({ commit }) {
    commit("SET_LOADING", true);
    TransactionService.fetchTransactions()
      .then((response) => {
        commit("SET_SUCCESS", response.data.success);
        commit("SET_MESSAGE", response.data.message);
        commit("SET_TRANSACTIONS", response.data.data);
        commit("SET_LOADING", false);
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
