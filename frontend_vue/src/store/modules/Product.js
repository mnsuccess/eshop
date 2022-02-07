import { getError } from "@/utils/helpers";
import ProductService from "@/services/ProductService";

export const namespaced = true;

export const state = {
  products: [],
  product: null,
  loading: false,
  error: null,
};

export const mutations = {
  SET_PRODUCTS(state, products) {
    state.products = products;
  },
  SET_PRODUCT(state, product) {
    state.product = product;
  },
  SET_LOADING(state, loading) {
    state.loading = loading;
  },
  SET_ERROR(state, error) {
    state.error = error;
  },
};

export const getters = {
  products: (state) => {
    return state.products;
  },
  product: (state) => {
    return state.product;
  },
  totalProducts: (state) => {
    return state.products.length;
  },
  loading: (state) => {
    return state.loading;
  },
  error: (state) => {
    return state.error;
  },
};

export const actions = {
  getProducts({ commit }) {
    commit("SET_LOADING", true);
    ProductService.fetchProducts()
      .then((response) => {
        commit("SET_PRODUCTS", response.data[0].products);
        commit("SET_LOADING", false);
      })
      .catch((error) => {
        commit("SET_LOADING", false);
        commit("SET_ERROR", getError(error));
      });
  },
  getProduct({ commit }, id) {
    commit("SET_LOADING", true);
    ProductService.fetchProduct(id)
      .then((response) => {
        commit("SET_PRODUCT", response.data[0].product);
        commit("SET_LOADING", false);
      })
      .catch((error) => {
        commit("SET_LOADING", false);
        commit("SET_ERROR", getError(error));
      });
  },
};
