<template>
  <header class="bg-white">
    <div class="container py-3 mx-auto">
      <div class="flex items-center justify-around w-full">
        <div class="text-2xl font-semibold text-gray-700 md:text-center">
          <router-link
            to="/"
            class="mt-3 text-gray-600 no-underline hover:nO-underline sm:mx-3 sm:mt-0"
            >eShop
          </router-link>
        </div>
        <nav class="mt-4 sm:flex sm:justify-center sm:items-center">
          <div class="flex flex-col sm:flex-row">
            <router-link
              to="/"
              class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0"
              >Products
            </router-link>
            <router-link
              v-if="!hasToken"
              class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0"
              to="/register"
              >Register
            </router-link>
            <router-link
              v-if="!hasToken"
              class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0"
              to="/login"
              >Login
            </router-link>
            <router-link
              class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0"
              to="/profile"
              v-if="hasToken"
              >Profile
            </router-link>
            <div
              v-if="hasToken"
              class="mt-3 text-gray-600 hover:no-underline sm:mx-3 sm:mt-0"
            >
              <router-link
                to="/wallet"
                class="inline-flex items-center px-12 py-2 text-sm font-medium text-center text-white no-underline bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                onClick=""
                >My Wallet</router-link
              >
            </div>
          </div>
        </nav>
      </div>
    </div>
  </header>
</template>
<script>
import { mapGetters } from "vuex";

export default {
  name: "Navigation",
  computed: {
    ...mapGetters("user", ["authUser", "hasToken"]),
  },
};
</script>
