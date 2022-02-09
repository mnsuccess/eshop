<template>
  <div class="flex flex-col-reverse items-center">
    <div class="flex mt-2 space-x-4">
      <img
        v-if="loading"
        class="w-8 h-8"
        src="https://i.imgur.com/JfPpwOA.gif"
      />
      <button
        v-if="!loading"
        @click="purchase"
        class="px-8 py-2 text-sm font-medium text-white bg-indigo-600 rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500"
      >
        Purchase Now
      </button>
    </div>
    <FlashMessage :error="error" />
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import FlashMessage from "@/components/FlashMessage";
export default {
  name: "Purchase",
  props: ["product_id"],
  components: {
    FlashMessage,
  },
  computed: {
    ...mapGetters("purchase", ["loading", "error"]),
  },
  created() {
    this.$store.dispatch("purchase/reset");
  },
  methods: {
    purchase() {
      this.$store.dispatch("purchase/purchaseProduct", this.product_id);
      this.amount = "";
    },
  },
};
</script>
