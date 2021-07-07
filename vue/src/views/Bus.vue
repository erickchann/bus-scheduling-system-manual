<template>
    <div>
        <Nav></Nav>
        <div class="container">
            <div class="card mt-4">
                <div class="card-header">
                    Bus
                </div>
                <div class="card-body">
                    <router-link to="/create-bus" class="btn btn-primary">Add Bus</router-link>
                    <table class="table mt-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Plate Number</th>
                                <th>Brand</th>
                                <th>Seat</th>
                                <th>Price Per Day</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="bus in buses" :key="bus.id">
                                <td>{{ bus.id }}</td>
                                <td>{{ bus.plate_number }}</td>
                                <td>{{ bus.brand }}</td>
                                <td>{{ bus.seat }}</td>
                                <td>{{ bus.price_per_day }}</td>
                                <td>
                                    <router-link :to="`edit-bus/${bus.id}`" class="btn btn-sm btn-info">Edit</router-link>
                                    <a @click.prevent="del(bus.id)" href="" class="btn btn-sm btn-danger">Delete</a>
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
            buses: ''
        }
    },
    methods: {
        getBuses() {
            axios.get(`buses?token=${this.token}`)
                .then(res => {
                    this.buses = res.data;
                })
                .catch(err => {
                    console.log(err.response.data.message);
                })
        },
        del(id) {
            axios.delete(`buses/${id}?token=${this.token}`)
                .then(res => {
                    console.log(res.data);
                    this.getBuses();
                })
                .catch(err => {
                    console.log(err.response.data.message);
                });
        }
    },
    created() {
        this.getBuses();
    }
}

</script>