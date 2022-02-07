<template>
  <div class="container px-6 mx-auto sm:mt-32">
    <FlashMessage message="loading..." v-if="loading" key="loading" />
    <div v-if="error">
      <h3 class="text-2xl font-medium text-gray-700">
        ⚠️ No Product Found | Check you Api Connection
      </h3>
      <transition name="fade">
        <FlashMessage :error="error" v-if="error" key="error" />
      </transition>
    </div>
    <div v-if="product" class="md:flex md:items-center">
      <div class="w-full h-64 md:w-1/2 lg:h-96">
        <img
          class="object-cover w-full h-full max-w-lg mx-auto rounded-md"
          :src="`${product.image}`"
          alt="image"
        />
      </div>
      <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
        <h3 class="text-lg text-gray-700 uppercase">{{ product.name }}</h3>
        <span class="mt-3 text-gray-500">${{ product.price }}</span>
        <span class="mt-2 text-gray-500" v-if="product.discount">
          | Discount {{ product.discount }}%</span
        >
        <span class="mt-2 text-gray-500" v-if="product.discount">
          | ${{ product.discounted_price }}</span
        >
        <hr class="my-3" />
        <div class="mt-2">
          <label class="text-sm text-gray-700" for="count">Description</label>
          <p>{{ product.description }}</p>
        </div>

        <div class="flex items-center justify-center mt-6">
          <Purchase :product_id="product.id" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import FlashMessage from "@/components/FlashMessage";
import Purchase from "@/components/Purchase";
export default {
  name: "Product",
  props: ["id"],
  components: { FlashMessage, Purchase },
  computed: {
    ...mapGetters("product", ["loading", "error", "product"]),
  },
  created() {
    this.$store.dispatch("product/getProduct", this.id);
  },
};
</script>
