<template>
    <a :href="href" :class="activeClasses" class="px-2 mr-3 md:mr-6 cursor-pointer border-blue-400 text-sm md:text-md tracking-tightest font-semibold">
        <span v-if="dot && active" class="mr-1 text-blue-400">•</span> {{ label }}
    </a>
</template>

<script>
export default {
    name: 'page-link',

    props: {
        label: {
            type: String,
            required: true,
        },

        href: {
            type: String,
            required: true,
        },

        underline: {
            type: Boolean,
            default: true,
        },

        dot: {
            type: Boolean,
            default: false,
        }
    },

    computed: {
        active() {
            return window.location.href === this.href;
        },

        activeClasses() {
            if (this.underline && this.active) {
                return [ 'border-b-3' ];
            }

            return [ 'hover:underline' ];
        },
    },
}
</script>

<style>

</style>