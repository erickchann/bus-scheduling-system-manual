<template>
    <div>
        <Nav></Nav>
        <div class="container">
            <div class="card mt-4">
                <div class="card-header">
                    Create Bus
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="form-group">
                            <label for="plate-number">Plate Number</label>
                            <input type="text" class="form-control" id="plate-number" name="plate_number"
                                placeholder="Enter plate number" v-model="formData.plate_number">
                        </div>
                        <div class="form-group">
                            <label for="brand">Brand</label>
                            <select id="brand" class="form-control" name="brand" v-model="formData.brand">
                                <option value="mercedes">Mercedes</option>
                                <option value="fuso">Fuso</option>
                                <option value="scania">Scania</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="seat">Seat</label>
                            <input type="text" class="form-control" id="seat" name="seat"
                                placeholder="Enter seat capacity" v-model="formData.seat">
                        </div>
                        <div class="form-group">
                            <label for="price-per-day">Price per day</label>
                            <input type="text" class="form-control" id="price-per-day" name="price_per_day"
                                placeholder="Enter price per day" v-model="formData.price_per_day">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Bus</button>
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
            formData : {
                "plate_number" : '',
                "brand" : 'mercedes',
                "seat" : '',
                "price_per_day" : '',
            }
        }
    },
    methods: {
        create() {
            axios.post(`buses?token=${this.token}`, this.formData)
                .then(res => {
                    console.log(res.data);
                })
                .catch(err => {
                    console.log(err.response.data.message);
                });
        }
    }
}
</script>