<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <h2 class="text-center mb-4">Register</h2>

            <form @submit.prevent="saveData">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" v-model="siswa.name" id="name" class="form-control" placeholder="Enter your name" />
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" v-model="siswa.email" id="email" class="form-control" placeholder="Enter your email" />
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" v-model="siswa.password" id="password" class="form-control" placeholder="Enter your password" />
              </div>

              <div class="form-group">
                <label for="role">Role:</label>
                <select v-model="siswa.role" name="role" class="form-control" id="role" required>
                  <option value="user">User</option>
                  <option value="admin">Admin</option>
                </select>
              </div>

              <button type="submit" class="btn btn-success btn-block mt-3">Register</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Register",
  data() {
    return {
      result: {},
      siswa: {
        name: "",
        email: "",
        password: "",
        role: "user", // Default role is "user"
      },
    };
  },
  created() { },
  mounted() {
    console.log("mounted() called.......");
  },
  methods: {
    saveData() {
      axios
        .post("http://127.0.0.1:8000/api/register", this.siswa)
        .then(({ data }) => {
          console.log(data);
          try {
            alert("Registration successful");
            console.log(data);
            this.$router.push({ name: "auth.login" });
          } catch (err) {
            alert("Registration failed");
          }
        });
    },
  },
};
</script>
