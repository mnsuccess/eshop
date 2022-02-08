<template>
  <div
    class="max-w-md bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700"
  >
    <div class="flex flex-col items-center p-20 pb-10 mt-2">
      <img
        v-if="loading"
        class="w-8 h-8 my-2"
        src="https://i.imgur.com/JfPpwOA.gif"
      />
      <FlashMessage :error="error" />
      <div class="relative mt-2 mb-2">
        <input
          v-if="!loading"
          v-model="amount"
          name="amount"
          type="number"
          id="amount"
          placeholder="Amount"
          autofocus
          class="w-full px-3 pt-5 pb-2 border border-gray-300 rounded focus:border-blue-700 focus:ring-1 focus:ring-blue-700 focus:outline-none input active:outline-none"
        />
      </div>
      <div class="flex justify-center mt-4 lg:mt-6">
        <a
          @click="topup"
          class="inline-flex items-center px-12 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          >TopUp</a
        >
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import FlashMessage from "@/components/FlashMessage";
export default {
  name: "TopUp",
  components: {
    FlashMessage,
  },
  data() {
    return {
      amount: 0,
    };
  },
  computed: {
    ...mapGetters("transaction", ["loading", "error"]),
  },
  created() {
    this.$store.dispatch("transaction/resetError");
  },
  methods: {
    topup() {
      this.$store.dispatch("transaction/topupWallet", this.amount);
      this.amount = "";
    },
  },
};
</script>
