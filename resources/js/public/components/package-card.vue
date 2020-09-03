<template>
    <div class="max-w-5xl px-10 my-4 py-6 bg-white rounded-lg shadow-md">
        <div class="mt-2">
            <h4 class="text-responsive text-gray-800 font-bold mb-2 sm:mb-2" v-text="pkg.title"></h4>
            <a class="text-base text-gray-800 font-bold hover:underline" :href="pkg.repo" target="_blank"><i class="fab fa-github"></i> {{ pkg.ref }}</a>
            <p class="mt-2 text-gray-700" v-text="pkg.description"></p>
        </div>
        <div class="my-3">
            <div class="flex flex-wrap justify-center md:justify-start">
                <a 
                    v-for="(shield, idx) in pkg.shields"
                    :key="id+'-shield-'+idx"
                    target="_blank"
                    :href="shield.click_url"
                    class="mr-2 sm:mr-1 my-1 last:mr-0"
                >
                    <img :src="shield.shield_url" :title="shield.alt" style="max-width:100%;">
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'package-card',

    props: {
        id: {
            type: String,
            required: true,
        },
        pkg: {
            type: Object,
            required: true,
        }
    },

    data() {
        return {
            
        }
    }
}
</script>