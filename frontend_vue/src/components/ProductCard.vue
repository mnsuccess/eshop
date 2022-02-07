<template>
  <div class="w-full max-w-sm mx-auto overflow-hidden rounded-md shadow-md">
    <div
      class="flex items-end justify-end w-full h-56 bg-cover"
      :style="{ 'background-image': `url(${product.image})` }"
    >
      <button
        class="p-2 mx-5 -mb-4 text-white bg-blue-600 rounded-full hover:bg-blue-500 focus:outline-none focus:bg-blue-500"
      >
        <router-link :to="{ name: 'product', params: { id: product.id } }">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path
              d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
            ></path>
          </svg>
        </router-link>
      </button>
    </div>
    <div class="px-5 py-3">
      <h3 class="text-gray-700 uppercase">{{ product.name }}</h3>
      <span class="mt-2 text-gray-500">${{ product.price }}</span>
      <span class="mt-2 text-gray-500" v-if="product.discount">
        | Discount {{ product.discount }}%</span
      >
      <span class="mt-2 text-gray-500" v-if="product.discount">
        | ${{ product.discounted_price }}</span
      >
    </div>
  </div>
</template>
<script>
export default {
  name: "ProductCard",
  props: {
    product: {
      type: Object,
      required: true,
    },
  },
};
</script>
