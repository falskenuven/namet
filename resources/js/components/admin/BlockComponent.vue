<template>
    <div>
        <h2>Find and block User</h2>
        <notifications group="foo" />
        <input type="text" v-model="name" @input="changeName">

        <div v-for="user in users">
            {{user.id}} | <a :href="user.profileLink">{{user.name}}</a>
    
            <input type="date" v-model="user.disabled" >
            <a role="button" class="btn btn-primary" @click="blockUser(user.id, user.disabled)">block</a>

            <div v-if="user.disabled">
                <a role="button" class="btn btn-primary" @click="clear(user.id)">Clear</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        components:{},

        data() {
            return {
                name: '',
                users: {},
                time: '',
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

            blockUser(id, disabled) {               
                axios.post(`/admin/block`, {id: id, time: disabled})
                    .then((res => {
                        this.$notify({
                            group: 'foo',
                            title: 'Important message',
                            text: 'Successfully blocked'
                        });

                        this.name = '';
                        this.users = {};
                    }));
            },

            clear(id) {
                axios.post(`/admin/clear`, {id: id})
                    .then((res => {
                        this.name = '';
                        this.users = {};
                    }));
            }
        }
    }
</script>
