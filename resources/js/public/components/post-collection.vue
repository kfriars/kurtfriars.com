<template>
    <div class="w-full grid grid-cols-1 md:grid-cols-3 md:col-gap-8">
        <post-card
            v-for="(post, idx) in posts"
            :key="'post-'+idx"
            :id="'post-'+idx"
            :post="post"
        ></post-card>
      </div>
</template>

<script>
export default {
    name: 'post-collection',

    props: {
        posts: {
            type: Array,
            required: true,
        }
    },

    data() {
        return {
            
        }
    }
}
</script>