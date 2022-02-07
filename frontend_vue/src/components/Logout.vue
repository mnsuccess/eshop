<template>
  <div class="flex justify-center mt-4 lg:mt-6">
    <a
      @click="logout"
      class="inline-flex items-center px-12 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
      >Logout</a
    >
  </div>
</template>

<script>
export default {
  name: "Logout",
  methods: {
    logout() {
      this.$store.dispatch("user/userLogout");
    },
  },
};
</script>
