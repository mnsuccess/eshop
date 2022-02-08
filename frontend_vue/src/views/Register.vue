<template>
  <div class="relative flex flex-col items-center justify-center md:mt-32">
    <div
      class="p-10 bg-white rounded shadow-none md:border md:border-gray-300 md:shadow-lg"
    >
      <div class="flex flex-col items-center space-y-3">
        <span class="text-2xl leading-normal font-semi-bold">Sign Up</span>
        <p class="leading-normal">Create your eShop Account</p>
        <img v-if="loading" src="https://i.imgur.com/JfPpwOA.gif" />
      </div>
      <FlashMessage :error="error" />
      <form action="javascript:void(0)" @submit="registerUser" class="my-10">
        <div class="relative mb-2">
          <input
            v-model="user.name"
            name="name"
            type="text"
            id="name"
            placeholder="Name"
            autofocus
            class="w-full px-3 pt-5 pb-2 border border-gray-300 rounded focus:border-blue-700 focus:ring-1 focus:ring-blue-700 focus:outline-none input active:outline-none"
          />
        </div>
        <div class="relative mb-2">
          <input
            v-model="user.email"
            name="email"
            type="text"
            id="email"
            placeholder="Email"
            autofocus
            class="w-full px-3 pt-5 pb-2 border border-gray-300 rounded focus:border-blue-700 focus:ring-1 focus:ring-blue-700 focus:outline-none input active:outline-none"
          />
        </div>
        <div class="relative mt-6 mb-2">
          <input
            v-model="user.password"
            name="password"
            type="password"
            id="password"
            placeholder="Password"
            autofocus
            class="w-full px-3 pt-5 pb-2 border border-gray-300 rounded focus:border-blue-700 focus:ring-1 focus:ring-blue-700 focus:outline-none input active:outline-none"
          />
        </div>
        <div class="relative mt-6 mb-2">
          <input
            v-model="user.confirmation_password"
            name="confirmation_password"
            type="password"
            id="confirmation_password"
            placeholder="Password Confirmation"
            autofocus
            class="w-full px-3 pt-5 pb-2 border border-gray-300 rounded focus:border-blue-700 focus:ring-1 focus:ring-blue-700 focus:outline-none input active:outline-none"
          />
        </div>
        <div class="mt-8">
          <div class="flex items-center justify-between text-sm">
            <router-link
              to="/login"
              class="px-2 py-2 -ml-2 font-bold text-blue-500 rounded hover:bg-blue-50 hover:text-blue-700"
              >I have an account
            </router-link>
            <button
              class="px-12 py-2 text-white bg-blue-500 rounded btn hover:bg-blue-600"
            >
              Sign Up
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import FlashMessage from "@/components/FlashMessage";
export default {
  name: "Register",
  components: {
    FlashMessage,
  },
  computed: {
    ...mapGetters("user", [
      "loading",
      "error",
      "registerError",
      "registerSuccess",
    ]),
  },
  created() {
    this.$store.dispatch("user/resetError");
  },
  data() {
    return {
      user: {
        name: "",
        email: "",
        password: "",
        confirmation_password: "",
      },
    };
  },
  methods: {
    registerUser() {
      const payload = {
        name: this.user.name,
        email: this.user.email,
        password: this.user.password,
        password_confirmation: this.user.confirmation_password,
      };
      this.$store.dispatch("user/userRegister", payload);
    },
  },
};
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
  font-family: "Open Sans", sans-serif;
}
.input {
  transition: border 0.2s ease-in-out;
  min-width: 280px;
}
.input:focus + .label,
.input:active + .label,
.input.filled + .label {
  font-size: 0.75rem;
  transition: all 0.2s ease-out;
  top: -0.9rem;
  background-color: #fff;
  color: #1a73e8;
  padding: 0 5px 0 5px;
  margin: 0 5px 0 5px;
}
</style>
