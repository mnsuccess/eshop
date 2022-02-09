import axios from "axios";
import authHeader from "./auth-header";

const API_URL = process.env.VUE_APP_API_URL;

export default {
  requestTopUpWallet(value) {
    return axios.post(
      API_URL + "/topup",
      { amount: value },
      { headers: authHeader() }
    );
  },
};
