<template>
    <div>
        <h2>{{user.name}}</h2>
        <div v-if="isBlock">Your account is unavailable until  {{user.disabled}}</div>
    </div>
</template>

<script>
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
         computed: {
            isBlock: function () {
                let today = new Date();
                let dd = today.getDate();
                let mm = today.getMonth() + 1;
                var yyyy = today.getFullYear();

                if (dd < 10) {
                  dd = '0' + dd;
                } 
                if (mm < 10) {
                  mm = '0' + mm;
                } 
                let date = yyyy + '-' + mm + '-' + dd;
                return this.user.disabled > date;
            }
        }

    }
</script>
