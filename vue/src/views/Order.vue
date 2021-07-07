<template>
    <div>
        <Nav></Nav>
        <div class="container">
            <div class="card mt-4">
                <div class="card-header">
                    Order
                </div>
                <div class="card-body">
                    <router-link to="/create-order" class="btn btn-primary">Add Order</router-link>
                    <table class="table mt-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Bus Plate Number</th>
                                <th>Driver Name</th>
                                <th>Contact Name</th>
                                <th>Contact Phone</th>
                                <th>Start Rent Date</th>
                                <th>Total Rent Days</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="order in orders" :key="order.id">
                                <td>{{ order.id }}</td>
                                <td>{{ order.bus }}</td>
                                <td>{{ order.driver }}</td>
                                <td>{{ order.contact_name }}</td>
                                <td>{{ order.contact_phone }}</td>
                                <td>{{ order.start_rent_date }}</td>
                                <td>{{ order.total_rent_days }}</td>
                                <td>
                                    <a @click.prevent="del(order.id)" href="" class="btn btn-sm btn-danger">Delete</a>
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
            orders: ''
        }
    },
    methods: {
        getOrders() {
            axios.get(`orders?token=${this.token}`)
                .then(res => {
                    this.orders = res.data;
                })
                .catch(err => {
                    console.log(err.response.data.message);
                })
        },
        del(id) {
            axios.delete(`orders/${id}?token=${this.token}`)
                .then(res => {
                    console.log(res.data);
                    this.getOrders();
                })
                .catch(err => {
                    console.log(err.response.data.message);
                });
        }
    },
    created() {
        this.getOrders();
    }
}

</script>