<template>
    <button type="submit" class="btn btn-secondary btn-sm">
        <span class="fa fa-heart"></span>
        <span v-text="favoritesCount"></span>
    </button>
</template>

<script>
export default{

    data(){
        return {
            favoritesCount: 10,
        }
    },

}
</script>
