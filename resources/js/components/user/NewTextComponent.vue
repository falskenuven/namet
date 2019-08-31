<template>
    <div class="disCenter">
        <a role="button" class="btn btn-primary" href="/post/create">Створити пост</a>
        <div class="decor justify-center">
        </div>
    </div>
</template>

<script>
    export default {

    }
</script>

<style>
    .decor {
        background-image: url("/image/vz.png");
        background-size: contain;
        width: 20vw;
        height: 20vw;
        background-position: center;
        background-repeat: no-repeat;
    }
    .disCenter {
        display: flex;
        justify-content: center;
        flex-direction: column;
    }
    .disCenter a {
        margin: 2em 0;
    }
</style>