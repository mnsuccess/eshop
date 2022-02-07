<template>
  <div
    class="max-w-md bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700"
  >
    <div class="flex flex-col items-center p-20 pb-10">
      <img
        class="w-24 h-24 mb-3 rounded-full shadow-lg"
        src="https://icon-library.com/images/wallet-with-money-icon-10_80695.png"
        alt="Wallet"
      />
      <h3
        v-if="authUser"
        class="mb-1 text-xl font-medium text-gray-900 dark:text-white"
      >
        $ {{ authUser.wallet.balance }}
      </h3>
      <span class="text-sm text-gray-500 dark:text-gray-400">Balance</span>
      <div class="flex justify-center mt-4 lg:mt-6"></div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "Balance",
  computed: {
    ...mapGetters("user", ["loading", "error", "authUser"]),
  },
  created() {
    this.$store.dispatch("user/getUser");
  },
};
</script>
