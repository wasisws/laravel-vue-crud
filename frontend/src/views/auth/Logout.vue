// logout.vue

<template>
  <div>
    <p>Logging out...</p>
  </div>
</template>

<script>
export default {
  created() {
    // Implement your logout logic here (e.g., clearing session, etc.)
    // After logout, redirect to the login page
    this.logout();
  },
  methods: {
    logout() {
      // Add your logout logic here (clearing session, etc.)
      // For example, you can use localStorage.clear() to clear session data
      localStorage.clear();

      // Redirect to the login page
      this.$router.push({ name: 'auth.login' });
    },
  },
};
</script>
