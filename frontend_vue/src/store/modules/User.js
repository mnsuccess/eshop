import { getError } from "@/utils/helpers";
import UserService from "@/services/UserService";
import router from "@/router";

export const namespaced = true;

const token = localStorage.getItem("user-token");

/**
 * Vuex Initial State
 */
export const state = {
  accessToken: token,
  user: null,
  loading: false,
  error: null,
};

/**
 * Vuex Mutattions
 */
export const mutations = {
  SET_USER(state, user) {
    state.user = user;
  },
  SET_LOADING(state, loading) {
    state.loading = loading;
  },
  SET_ERROR(state, error) {
    state.error = error;
  },
};

/**
 * Vuex Getters
 */
export const getters = {
  authUser: (state) => {
    return state.user;
  },
  loading: (state) => {
    return state.loading;
  },
  error: (state) => {
    return state.error;
  },
  loggedIn: (state) => {
    return !!state.user;
  },
  hasToken: () => {
    const storageItem = localStorage.getItem("user-token");
    if (!storageItem) return false;
    if (storageItem) return true;
  },
};

/**
 * Vuex ACTIONS
 */
export const actions = {
  userRegister({ commit }, user) {
    commit("SET_LOADING", true);
    UserService.requestRegister(user)
      .then((response) => {
        commit("SET_USER", response.data.data);
        localStorage.setItem("user-token", response.data.token);
        commit("SET_LOADING", false);
        router.push({ path: "/wallet" });
        router.go();
      })
      .catch((error) => {
        router.go();
        commit("SET_LOADING", false);
        commit("SET_ERROR", getError(error));
      });
  },

  userLogin({ commit }, user) {
    commit("SET_LOADING", true);
    UserService.requestLogin(user)
      .then((response) => {
        commit("SET_USER", response.data.data);
        localStorage.setItem("user-token", response.data.token);
        commit("SET_LOADING", false);
        router.push({ path: "/wallet" });
        router.go();
      })
      .catch((error) => {
        router.go();
        commit("SET_LOADING", false);
        commit("SET_ERROR", getError(error));
      });
  },

  userLogout({ commit }) {
    commit("SET_LOADING", true);
    UserService.requestLogout()
      .then(() => {
        commit("SET_USER", null);
        localStorage.removeItem("user-token");
        if (router.currentRoute.name !== "login")
          router.push({ path: "/login" });
        router.go();
      })
      .catch((error) => {
        commit("SET_ERROR", getError(error));
      });
  },

  async getUser({ commit }) {
    commit("SET_LOADING", true);
    try {
      const response = await UserService.fetchUserProfile(token);
      commit("SET_USER", response.data.data);
      commit("SET_LOADING", false);
      return response.data.data;
    } catch (error) {
      commit("SET_LOADING", false);
      commit("SET_USER", null);
      commit("SET_ERROR", getError(error));
    }
  },
};
