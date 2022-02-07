<template>
  <div class="container px-6 mx-auto">
    <FlashMessage
      message="loading..."
      v-if="loading && !totalProducts"
      key="loading"
    />
    <h3 v-if="totalProducts > 1" class="text-2xl font-medium text-gray-700">
      Our Best Product
    </h3>
    <span v-if="totalProducts > 1" class="mt-3 text-sm text-gray-500"
      >{{ totalProducts }}+ Products</span
    >
    <div v-if="totalProducts == 0">
      <h3 class="text-2xl font-medium text-gray-700">
        ⚠️ No Products available | Check you Api Connection
      </h3>
      <transition name="fade">
        <FlashMessage :error="error" v-if="error" key="error" />
      </transition>
    </div>

    <div
      class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
    >
      <ProductCard
        v-for="product in products"
        :key="product['@id']"
        :product="product"
      />
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import ProductCard from "@/components/ProductCard";
import FlashMessage from "@/components/FlashMessage";
export default {
  name: "Products",
  components: { ProductCard, FlashMessage },
  computed: {
    ...mapGetters("product", ["loading", "error", "products", "totalProducts"]),
  },
  created() {
    this.$store.dispatch("product/getProducts");
  },
};
</script>
