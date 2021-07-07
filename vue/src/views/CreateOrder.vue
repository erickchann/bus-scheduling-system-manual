<template>
    <div>
        <Nav></Nav>
        <div class="container">
            <div class="card mt-4">
                <div class="card-header">
                    Create Order
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="form-group">
                            <label for="bus">Bus</label>
                            <select id="bus" class="form-control" name="bus_id" v-model="formData.bus_id">
                                <option value="" hidden>Select Bus</option>
                                <option v-for="bus in buses" :key="bus.id" :value="bus.id">{{ bus.plate_number }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="driver">Driver</label>
                            <select id="driver" class="form-control" name="driver_id" v-model="formData.driver_id">
                                <option value="" hidden>Select Driver</option>
                                <option v-for="driver in drivers" :key="driver.id" :value="driver.id">{{ driver.name }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contact-name">Contact Name</label>
                            <input type="text" class="form-control" id="contact-name" name="contact_name"
                                placeholder="Enter contact name" v-model="formData.contact_name">
                        </div>
                        <div class="form-group">
                            <label for="contact-phone">Contact Phone</label>
                            <input type="text" class="form-control" id="contact-phone" name="contact_phone"
                                placeholder="Enter contact phone" v-model="formData.contact_phone">
                        </div>
                        <div class="form-group">
                            <label for="start">Start Rent Date</label>
                            <input type="date" class="form-control" id="start" name="start_rent_date"
                                placeholder="Enter start rent date" v-model="formData.start_rent_date">
                        </div>
                        <div class="form-group">
                            <label for="total">Total Rent Days</label>
                            <input type="text" class="form-control" id="total" name="total_rent_days"
                                placeholder="Enter total rent days" v-model="formData.total_rent_days">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Order</button>
                    </form>
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
            drivers: '',
            buses: '',
            formData : {
                "bus_id" : '',
                "driver_id" : '',
                "contact_name" : '',
                "contact_phone" : '',
                "start_rent_date" : '',
                "total_rent_days" : ''
            }
        }
    },
    methods: {
        create() {
            axios.post(`orders?token=${this.token}`, this.formData)
                .then(res => {
                    console.log(res.data);
                })
                .catch(err => {
                    console.log(err.response.data.message);
                });
        },
        getBuses() {
            axios.get(`buses?token=${this.token}`)
                .then(res => {
                    this.buses = res.data;
                })
                .catch(err => {
                    console.log(err.response.data.message);
                })
        },
        getDrivers() {
            axios.get(`drivers?token=${this.token}`)
                .then(res => {
                    this.drivers = res.data;
                })
                .catch(err => {
                    console.log(err.response.data.message);
                })
        }
    },
    created() {
        this.getBuses();
        this.getDrivers();
    }
}
</script>