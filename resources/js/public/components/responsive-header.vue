<template>
  <header :class="{ 'w-16': !expanded, 'w-64': expanded }" class="fixed sm:static h-full bg-gray-200 shadow-md sm:h-auto sm:w-full sm:bg-white sm:flex sm:justify-center sm:border-b-4 sm:border-gray-900">
        <div v-on-clickaway="hideMenu" class="h-full flex flex-col justify-between items-stretch sm:hidden">
            <template v-if="!expanded">
                <img class="m-4 w-8" :src="url('images/logo/graphic-black.png')">
            </template>
            <div v-if="expanded" class="flex flex-col justify-start items-stretch">
                <div class="flex justify-start">
                    <img class="m-6 w-10" :src="url('images/logo/graphic-black.png')">
                    <p class="text-md font-semibold mt-8 uppercase">Kurt Friars</p>
                </div>
                <div class="ml-4 flex flex-col justify-start items-start">
                    <page-link :dot="true" :underline="false" class="mb-2" label="Home" :href="route('public.home').url()"></page-link>
                    <page-link :dot="true" :underline="false" class="mb-2" label="CV" :href="route('public.cv').url()"></page-link>
                    <page-link :dot="true" :underline="false" class="mb-2" label="Packages" :href="route('public.packages').url()"></page-link>
                </div>
            </div>
            <i v-if="!expanded" @click="showMenu()" class="fa fa-bars text-2xl mx-auto mb-4 text-gray-700 sm:hidden"></i>
            <i v-if="expanded" @click="hideMenu()" class="fa fa-times text-2xl ml-6 mb-4 text-gray-700 sm:hidden"></i>
        </div>

        <div class="hidden w-screen-responsive sm:flex justify-between items-stretch">
            <img class="m-4 sm:w-12 md:w-18 w-8" :src="url('images/logo/logo-black.png')">

            <div class="hidden sm:flex flex-col justify-end">
                <div class="pl-2 md:pl-10 py-2 uppercase flex justify-between">
                    <page-link label="Home" :href="route('public.home').url()"></page-link>
                    <page-link label="CV" :href="route('public.cv').url()"></page-link>
                    <page-link label="Packages" :href="route('public.packages').url()"></page-link>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    name: 'responsive-header',

    data() {
        return {
            expanded: false,
        };
    },

    methods: {
        hideMenu() {
            this.expanded = false;
        },

        showMenu() {
            this.expanded = true;
        },
    }
}
</script>

<style>

</style>