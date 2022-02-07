import axios from "axios";
import authHeader from "./auth-header";

const API_URL = process.env.VUE_APP_API_URL;

export default {
  requestLogin(user) {
    return axios.post(API_URL + "/users/login", user);
  },
  requestRegister(user) {
    return axios.post(API_URL + "/users/register", user);
  },
  requestLogout() {
    return axios.post(API_URL + "/users/logout", {}, { headers: authHeader() });
  },
  fetchUserProfile() {
    return axios.get(API_URL + "/users/profile", { headers: authHeader() });
  },
};
