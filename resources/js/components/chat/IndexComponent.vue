<template>
    <div class="box">
        <list-component></list-component>

        <chat-component></chat-component>
    </div>
</template>

<script>
    import ListComponent from './ListComponent';
    import ChatComponent from './ChatComponent';

    export default {
        mounted() {

        },

        components: {
            ListComponent,
            ChatComponent,
        },
    }
</script>

<style>
    .box {
        display: flex;
        justify-content: space-between;
        
    }
</style>