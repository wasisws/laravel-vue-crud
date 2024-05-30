<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <h4>EDIT SISWA</h4>
            <hr />

            <form @submit.prevent="update">
              <div class="form-group">
                <label for="nama" class="font-weight-bold">Nama Siswa</label>
                <input type="text" class="form-control" v-model="post.nama" placeholder="Masukkan nama siswa" />
              </div>

              <div class="form-group">
                <label for="alamat" class="font-weight-bold">Alamat</label>
                <input type="text" class="form-control" v-model="post.alamat" placeholder="Nama jalan dan nomor rumah" />
              </div>

              <div class="form-group">
                <label for="kota" class="font-weight-bold">Kota</label>
                <input type="text" class="form-control" v-model="post.kota"
                  placeholder="Masukkan nama kota tempat tinggal" />
              </div>

              <div class="form-group">
                <label for="provinsi" class="font-weight-bold">Provinsi</label>
                <input type="text" class="form-control" v-model="post.provinsi"
                  placeholder="Masukkan nama provinsi tempat tinggal" />
              </div>

              <div class="form-group">
                <label for="email" class="font-weight-bold">E-mail</label>
                <input type="text" class="form-control" v-model="post.email" placeholder="Masukkan alamat email siswa" />
              </div>

              <button type="button" class="btn btn-primary" @click="update">UPDATE</button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { reactive, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";
import axios from "axios";

export default {
  setup() {
    const route = useRoute();
    const postId = route.params.id;
    const post = reactive({
      nama: "",
      alamat: "",
      kota: "",
      provinsi: "",
      email: "",
    });

    const router = useRouter();

    const fetchData = async () => {
      try {
        const { data } = await axios.get(`http://localhost:8000/api/siswa/${postId}`);
        // Populate the 'post' reactive object with retrieved data
        Object.assign(post, data.data);
      } catch (error) {
        console.error("Error fetching data:", error);
      }
    };

    const update = async () => {
      try {
        await axios.put(`http://localhost:8000/api/siswa/${postId}`, {
          nama: post.nama,
          alamat: post.alamat,
          kota: post.kota,
          provinsi: post.provinsi,
          email: post.email,
        });

        // Fetch updated data
        fetchData();

        // Redirect to another route
        router.push({ name: "siswa.siswa" });
      } catch (error) {
        console.error("Error updating data:", error);
      }
    };

    // Fetch data on component mount
    onMounted(() => {
      fetchData();
    });

    return {
      post,
      router,
      update,
    };
  },
};
</script>

<style>
body {
  background: lightgray;
}
</style>
