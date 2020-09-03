<template>
    <div class="w-full flex flex-col items-stretch">
        <package-card
            v-for="(pkg, idx) in packages"
            :key="'package-'+idx"
            :id="'package-'+idx"
            :pkg="pkg"
        ></package-card>
      </div>
</template>

<script>
export default {
    name: 'package-collection',

    props: {
        packages: {
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