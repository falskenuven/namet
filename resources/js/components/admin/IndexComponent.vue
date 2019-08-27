<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <post-component></post-component>
                <user-component></user-component>
            </div>
            <div class="col-md-6">
                 <block-component></block-component> 
                 <make-admin-component></make-admin-component>  
            </div>
        </div>
    </div>
</template>

<script>
    import PostComponent from './PostComponent';
    import UserComponent from './UserComponent';
    import BlockComponent from './BlockComponent';
    import MakeAdminComponent from './MakeAdminComponent';

    export default {
        mounted() {

        },

        components: {
            PostComponent,
            UserComponent,
            BlockComponent,
            MakeAdminComponent,
        },
    }
</script>
MakeAdminComponent