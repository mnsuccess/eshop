<template>
  <div class="flex justify-center">
    <div
      class="max-w-md bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700"
    >
      <div v-if="authUser" class="flex flex-col items-center p-10 pb-10">
        <img
          class="w-24 h-24 mb-3 rounded-full shadow-lg"
          src="https://icon-library.com/images/user-icon-image/user-icon-image-13.jpg"
          alt="User image"
        />
        <h3 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">
          {{ authUser.name }}
        </h3>
        <span class="text-sm text-gray-500 dark:text-gray-400">{{
          authUser.email
        }}</span>
        <Logout />
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import Logout from "@/components/Logout";
export default {
  name: "Profile",
  components: { Logout },
  computed: {
    ...mapGetters("user", ["loading", "error", "authUser"]),
  },
  created() {
    this.$store.dispatch("user/getUser");
  },
  methods: {
    logout() {
      this.$store.dispatch("user/userLogout");
    },
  },
};
</script>
