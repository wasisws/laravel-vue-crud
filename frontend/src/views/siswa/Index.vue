<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>DATA SISWA</h4>
                        <hr />

                        <!-- Tambahkan tombol logout -->
                        <router-link :to="{ name: 'auth.logout' }" class="btn btn-md btn-danger">
                        LOGOUT
                        </router-link>

                        <!-- Input Pencarian -->
                        <div class="form-group mt-3">
                        <input type="text" class="form-control" placeholder="Cari siswa..." v-model="searchTerm" @input="performSearch" />
                        </div>

                        <table class="table table-striped table-bordered mt-4">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Kota</th>
                                    <th scope="col">Provinsi</th>
                                    <th scope="col">E-mail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(siswa, index) in filteredSiswa" :key="index">
                                    <td>{{ siswa.id }}</td>
                                    <td>{{ siswa.nama }}</td>
                                    <td>{{ siswa.alamat }}</td>
                                    <td>{{ siswa.kota }}</td>
                                    <td>{{ siswa.provinsi }}</td>
                                    <td>{{ siswa.email }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Navigasi halaman -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li :class="{ disabled: posts.current_page === 1 }">
                                    <button @click="fetchData(posts.current_page - 1)" class="page-link"
                                        aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </button>
                                </li>
                                <li v-for="page in posts.last_page" :key="page"
                                    :class="{ active: page === posts.current_page }">
                                    <button @click="fetchData(page)" class="page-link">{{ page }}</button>
                                </li>
                                <li :class="{ disabled: posts.current_page === posts.last_page }">
                                    <button @click="fetchData(posts.current_page + 1)" class="page-link" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </button>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
import axios from "axios";
import { onMounted, ref, watch, computed } from "vue";

export default {
    setup() {
        // Deklarasi variabel dan fungsi
        let posts = ref({
            data: [],
            current_page: 1,
            last_page: 1,
        });

        let searchTerm = ref("");

        const fetchData = async (page = 1) => {
            try {
                const response = await axios.get(`http://localhost:8000/api/siswa?page=${page}&search=${searchTerm.value}`);
                posts.value = response.data.data;
            } catch (error) {
                console.log(error.response.data);
            }
        };

        const performSearch = () => {
            fetchData(); // Tanpa parameter page untuk mengambil dari halaman pertama
        };

        // Menambahkan filter berdasarkan nama, kota, dan provinsi
        const filterSiswa = (siswa) => {
            const keyword = searchTerm.value.toLowerCase();
            return (
                siswa.nama.toLowerCase().includes(keyword) ||
                siswa.kota.toLowerCase().includes(keyword) ||
                siswa.provinsi.toLowerCase().includes(keyword)
            );
        };

        watch(searchTerm, () => {
            fetchData(); // Saat searchTerm berubah, ambil data dari halaman pertama
        });

        onMounted(() => {
            fetchData(); // Ambil data dari halaman pertama saat komponen dimuat
        });

        return {
            posts,
            searchTerm,
            performSearch,
            filteredSiswa: computed(() => {
                return posts.value.data.filter((siswa) => filterSiswa(siswa));
            }),
            fetchData,
        };
    },
};
</script>

  
<style>
body {
    background: lightgray;
}
</style>
  