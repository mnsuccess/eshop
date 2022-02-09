import axios from "axios";
import authHeader from "./auth-header";

const API_URL = process.env.VUE_APP_API_URL;

export default {
  fetchTransactions() {
    return axios.get(API_URL + "/transactions", { headers: authHeader() });
  },
};
