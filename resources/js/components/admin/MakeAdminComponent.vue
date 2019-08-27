<template>
    <div>
        <h2>Find and make Admin User</h2>
        <input type="text" v-model="name" @input="changeName" class="form-control">
        
        <div v-for="user in users">
            {{user.id}} | <a :href="user.profileLink">{{user.name}}</a>
            <a role="button" class="btn btn-primary" @click="makeAdmin(user.id)">Make Admin</a>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: '',
                users: {},
            }
        },

        methods: {
            changeName(event) {
                if(event.target.value.trim().length  != 0) { 

                    axios.post('/user/find', {search: event.target.value})
                        .then((res => {
                            this.users = res.data;
                        }));
                } else {
                    this.users = {};
                }
            },

            makeAdmin(id) {
                axios.post(`/user/make/admin/`, {id: id})
                    .then((res => {
                        this.name = '';
                        this.users = {};
                        this.$noty.success('Success');
                    }));
            }
        }
    }
</script>
