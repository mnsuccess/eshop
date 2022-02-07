<template>
  <button
    @click="purchase"
    class="px-8 py-2 text-sm font-medium text-white bg-indigo-600 rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500"
  >
    Purchase Now
  </button>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "Purchase",
  props: ["product_id"],
  computed: {
    ...mapGetters("transaction", ["loading", "error"]),
  },
  methods: {
    purchase() {
      this.$store.dispatch("transaction/purchaseProduct", this.product_id);
      this.amount = "";
    },
  },
};
</script>
