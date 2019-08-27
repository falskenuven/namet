<template>
    <div>
        <h2>{{user.name}}</h2>
        <div>{{user.bio}}</div>
        <upload-component></upload-component>
    </div>
</template>

<script>
    import UploadComponent from './UploadComponent';

    export default {
        data() {
            return {
            }
        },

        props: ['user'],

        mounted() {
           
            // axios.post('/user/info', this.user)
            //     .then(res => {
            //        console.log('info', res.sata);
            // })
        },

        components: {
            UploadComponent
        }

    }
</script>
