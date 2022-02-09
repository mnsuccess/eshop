import axios from "axios";
import authHeader from "./auth-header";

const API_URL = process.env.VUE_APP_API_URL;

export default {
  requestPurchaseProduct(id) {
    return axios.post(
      API_URL + "/purchase",
      { product_id: id },
      { headers: authHeader() }
    );
  },
};
