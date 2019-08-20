<template>
    <div>
        <h2>Find and delete User</h2>
        <input type="text" v-model="name" @input="changeName">
        
        <div v-for="user in users">
            {{user.id}} | <a :href="user.profileLink">{{user.name}}</a>
            <a role="button" class="btn btn-danger" @click="delUser(user.id)">del</a>
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

            delUser(id) {
                axios.get(`/user/delete/${id}`)
                    .then((res => {
                        this.name = '';
                        this.users = {};
                    }));
            }
        }
    }
</script>
