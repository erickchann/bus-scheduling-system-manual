<template>
    <div>
        <Nav></Nav>
        <div class="container">
            <div class="card mt-4">
                <div class="card-header">
                    Driver
                </div>
                <div class="card-body">
                    <router-link to="/create-driver" class="btn btn-primary">Add Driver</router-link>
                    <table class="table mt-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>ID Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="driver in drivers" :key="driver.id">
                                <td>{{ driver.id }}</td>
                                <td>{{ driver.name }}</td>
                                <td>{{ driver.age }}</td>
                                <td>{{ driver.id_number }}</td>
                                <td>
                                    <router-link :to="`edit-driver/${driver.id}`" class="btn btn-sm btn-info">Edit</router-link>
                                    <a @click.prevent="del(driver.id)" href="" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Nav from '@/components/Nav.vue'
import axios from 'axios'

export default {
    components: {
        Nav
    },
    data() {
        return {
            token: localStorage.getItem('token'),
            drivers: ''
        }
    },
    methods: {
        getDrivers() {
            axios.get(`drivers?token=${this.token}`)
                .then(res => {
                    this.drivers = res.data;
                })
                .catch(err => {
                    console.log(err.response.data.message);
                })
        },
        del(id) {
            axios.delete(`drivers/${id}?token=${this.token}`)
                .then(res => {
                    console.log(res.data);
                    this.getDrivers();
                })
                .catch(err => {
                    console.log(err.response.data.message);
                });
        }
    },
    created() {
        this.getDrivers();
    }
}

</script>