<template>
    <div>
        <Nav></Nav>
        <div class="container">
            <div class="card mt-4">
                <div class="card-header">
                    Edit Driver
                </div>
                <div class="card-body">
                    <form @submit.prevent="edit">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter name" v-model="formData.name">
                        </div>
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="text" class="form-control" id="age" name="age"
                                placeholder="Enter name" v-model="formData.age">
                        </div>
                        <div class="form-group">
                            <label for="id-number">ID Number</label>
                            <input type="text" class="form-control" id="id-number" name="id_number"
                                placeholder="Enter id number" v-model="formData.id_number">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Driver</button>
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
            id: this.$route.params.id,
            formData : {
                "name" : '',
                "age" : '',
                "id_number" : ''
            }
        }
    },
    methods: {
        edit() {
            axios.put(`drivers/${this.id}?token=${this.token}`, this.formData)
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