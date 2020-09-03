<template>
    <div v-if="visible" class="fixed bottom-0 inset-x-0 px-4 pb-4 sm:inset-0 sm:flex sm:items-center sm:justify-center">
        
        <transition
            enter-class="transform opacity-0"
            enter-to-class="transform opacity-100"
            enter-active-class="transition ease-out duration-300"
            leave-class="transform opacity-100"
            leave-to-class="transform opacity-0"
            leave-active-class="transition ease-in duration-200"
        >
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
        </transition>

        <transition
            enter-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            enter-to-class="opacity-100 translate-y-0 sm:scale-100"
            enter-active-class="transition ease-out duration-300"
            leave-class="opacity-100 translate-y-0 sm:scale-100"
            leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            leave-active-class="transition ease-in duration-200"
        >
            <div v-on-clickaway="hide" :class="widthClasses" class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all" role="dialog">
                <slot>Default content!</slot>
            </div>
        </transition>
    </div>  
</template>

<script>
export default {
    name: 'responsive-modal',
    
    props: {
        id: {
            type: String,
            required: true,
        },

        startOpen: {
            type: Boolean,
            default: false,
        },

        widthClasses: {
            type: Array,
            default: () => { return [ 'sm:max-w-lg', 'sm:w-full' ]},
        }
    },

    data() {
        return {
            visible: false,
        };
    },

    methods: {
        show() {
            $('body').addClass('overflow-hidden');
            this.visible = true;
        },

        hide() {
            $('body').removeClass('overflow-hidden');
            this.visible = false;
        }
    },

    created() {
        this.visible = this.startOpen;

        if (this.visible) {
            $('body').addClass('overflow-hidden');
        }
    },

    mounted() {
        this.events.subscribe('show-'+this.id, () => {
            this.show();
        });

        this.events.subscribe('hide-'+this.id, () => {
            this.hide();
        });
    }
}
</script>

<style>

</style>