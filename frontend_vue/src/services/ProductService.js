import axios from "axios";
import authHeader from "./auth-header";

const API_URL = process.env.VUE_APP_API_URL;

export default {
  fetchProducts() {
    return axios.get(API_URL + "/products", { headers: authHeader() });
  },
  fetchProduct(id) {
    return axios.get(API_URL + "/products/" + id, { headers: authHeader() });
  },
};
