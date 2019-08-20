<template>
    <div>
        <post-component></post-component>
        <user-component></user-component>
        <block-component></block-component>
    </div>
</template>

<script>
    import PostComponent from './PostComponent';
    import UserComponent from './UserComponent';
    import BlockComponent from './BlockComponent';

    export default {
        mounted() {

        },

        components: {
            PostComponent,
            UserComponent,
            BlockComponent,
        },
    }
</script>
