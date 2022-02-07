import axios from "axios";
import authHeader from "./auth-header";

const API_URL = process.env.VUE_APP_API_URL;

export default {
  fetchTransactions() {
    return axios.get(API_URL + "/transaction", { headers: authHeader() });
  },
  requestPurchaseProduct(id) {
    return axios.post(
      API_URL + "/transaction/purchase",
      { product_id: id },
      { headers: authHeader() }
    );
  },
  requestTopUpWallet(value) {
    return axios.post(
      API_URL + "/transaction/topup",
      { amount: value },
      { headers: authHeader() }
    );
  },
};
