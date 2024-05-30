<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <h2 class="text-center">Login</h2>

            <form @submit.prevent="LoginData">
              <div class="form-group">
                <label>Email</label>
                <input
                  type="email"
                  v-model="siswa.email"
                  class="form-control"
                  placeholder="Email" />
              </div>

              <div class="form-group">
                <label>Password</label>
                <input
                  type="password"
                  v-model="siswa.password"
                  class="form-control"
                  placeholder="Password" />
              </div>

              <button type="submit" class="btn btn-primary btn-block mt-3">
                Login
              </button>
            </form>

            <p class="mt-3 text-center">
              Belum punya akun?
              <router-link to="/register">Daftar di sini</router-link>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Login",
  data() {
    return {
      siswa: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    LoginData() {
      axios.post("http://127.0.0.1:8000/api/login", this.siswa)
        .then(({ data }) => {
          try {
            // Login berhasil
            if (data.status) {
              // Berhasil login, tentukan alur berdasarkan role
              if (data.role === "admin") {
                console.log(data)
                // Pengguna dengan peran admin, arahkan ke halaman siswa
                this.$router.push({ name: "siswa.siswa" });
              } else if (data.role === "user") {
                // Pengguna dengan peran user, arahkan ke halaman user
                this.$router.push({ name: "siswa.user" });
              } else {
                // Jika peran tidak sesuai, mungkin ada kesalahan
                alert("Invalid role. Please contact administrator.");
              }
            } else {
              // Jika status login adalah false, tampilkan pesan kegagalan
              alert("Login failed. Please check your credentials.");
            }
          } catch (err) {
            alert("Error, please try again");
          }
        })
        .catch((error) => {
          console.error("Error during login:", error);
          alert("Error during login. Please try again.");
        });
    },
  },
};
</script>
