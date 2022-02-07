<template>
  <div
    class="max-w-full p-20 mt-2 bg-white border rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700"
  >
    <div class="flex items-center justify-between mb-4">
      <h3 class="text-xl font-bold leading-none text-gray-900 dark:text-white">
        My Transactions
      </h3>
    </div>
    <div class="flow-root overflow-hidden overflow-y-auto h-96">
      <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
        <li
          v-for="transaction in transactions"
          :key="transaction.id"
          class="py-3 sm:py-4"
        >
          <div class="flex items-center space-x-4">
            <div class="flex-shrink-0">
              <img
                class="w-8 h-8 rounded-full"
                src="https://icon-library.com/images/wallet-with-money-icon-10_80695.png"
                alt="wallet"
              />
            </div>
            <div class="flex-1 min-w-0">
              <p
                class="text-sm font-medium text-gray-900 truncate dark:text-white"
              >
                {{ transaction.action }}
              </p>
              <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                {{ transaction.note }}
              </p>
            </div>
            <div
              class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white"
            >
              ${{ transaction.amount }}
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "ListTransaction",
  computed: {
    ...mapGetters("transaction", ["loading", "error", "transactions"]),
  },
  created() {
    this.$store.dispatch("transaction/getTransactions");
  },
};
</script>
