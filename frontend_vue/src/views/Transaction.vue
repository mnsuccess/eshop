<template>
  <div
    class="container flex flex-wrap items-center justify-around w-full mx-auto sm:mt-20"
  >
    <div class="flex flex-col">
      <balance />
      <TopUp class="mt-4" />
    </div>
    <ListTransaction flex-1 />
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import ListTransaction from "@/components/ListTransaction";
import Balance from "@/components/Balance";
import TopUp from "@/components/TopUp";
export default {
  name: "Product",
  components: { ListTransaction, Balance, TopUp },
  computed: {
    ...mapGetters("user", ["loading", "error", "authUser"]),
    ...mapGetters("transaction", ["loading", "error", "transactions"]),
  },
  created() {
    this.$store.dispatch("user/getUser");
    this.$store.dispatch("transaction/getTransactions");
  },
};
</script>
