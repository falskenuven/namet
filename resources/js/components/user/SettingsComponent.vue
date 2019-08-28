<template>
    <div>
        <h2>{{user.name}}</h2>
        <textarea v-model="user.bio" class="form-control" placeholder="bio..."></textarea>
        <input type="text" class="form-control" placeholder="location..." v-model="user.location">
        <a role="button" class="btn btn-primary" @click="update">Update</a>
        <upload-component></upload-component>
        <div v-if="role == 1">
            <a class="btn btn-primary" role="button" @click="refuse">refuse to be the admin</a>
        </div>
        <div>
            <a class="btn btn-danger" role="button" @click="deleteUser">Delete Profile</a>
        </div>
    </div>
</template>

<script>
    import UploadComponent from './UploadComponent';

    export default {
        data() {
            return {
                role: 2
            }
        },

        props: ['user'],

        components: {
            UploadComponent
        },

        mounted() {
            this.role =this.user.role;
        },

        methods: {
            update() {
                // console.log('save', this.user);
                axios.post('/settings/update', this.user)
                    .then(res => {
                       this.$noty.success('Your profile has been updated');
                });
            },

            refuse() {
                console.log('refuse');
                axios.get('/settings/refuse')
                    .then(res => {
                       this.$noty.success('Your profile has been updated');
                       this.role = 2;
                });
            },

            deleteUser() {
                console.log('delete user', this.user.id);
                axios.get(`/user/delete/${this.user.id}`)
                    .then((res => {
                        window.location.replace('/login');
                        this.$noty.success('Success');
                    }));
            }
        },


    }
</script>

<style>
    textarea {
        resize: none;
    }
</style>