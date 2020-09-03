/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('../common/bootstrap.js');
window.Vue = require('vue');

/**
 * Load all of our custom base libraries into the app
 */
const common = require.context('../common/lib', true, /\.js$/i);
common.keys().map((key) => {
    const name = key.split('/').pop().split('.')[0];
    window[name] = require('../common/lib/'+name+'.js').default;
});

// const lib = require.context('./lib', true, /\.js$/i);
// lib.keys().map((key) => {
//     const name = key.split('/').pop().split('.')[0];
//     window[name] = require('./lib/'+name+'.js').default;
// });

/** Date handling library */
// const dayjs = require('dayjs');
// const utc = require('dayjs/plugin/utc');
// const advancedFormat = require('dayjs/plugin/advancedFormat')
// dayjs.extend(advancedFormat)
// dayjs.extend(utc)
// window.dayjs = dayjs;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg)
 * ./components/ExampleComponent.vue -> <example-component></example-component>
 */
// const base = require.context('./components', true, /\.vue$/i);
// base.keys().map((key) => {
//     Vue.component(key.split('/').pop().split('.')[0], base(key).default);
// });

// const pages = require.context('./pages', true, /\.vue$/i);
// pages.keys().map((key) => {
//     Vue.component(key.split('/').pop().split('.')[0], pages(key).default);
// });

// const forms = require.context('./forms', true, /\.vue$/i);
// forms.keys().map((key) => {
//     Vue.component(key.split('/').pop().split('.')[0], forms(key).default);
// });

/**
 * The following block of code may be used to automatically register your
 * Vue directives. It will recursively scan this directory for the Vue
 * directives and automatically register them with their "basename".
 *
 * Eg)
 * ./directives/example-directive.js -> <div v-example-directive></div>
 */
// const directives = require.context('./directives', true, /\.js$/i);
// directives.keys().map((key) => {
//     Vue.directive(key.split('/').pop().split('.')[0], directives(key).default);
// });

/**
 * The following block of code may be used to automatically register your
 * Vue Mixins. It will recursively scan this directory for the Vue
 * mixins and automatically register them with their "basename".
 *
 * Eg)
 * ./mixins/example-mixin.js -> <div v-example-directive></div>
 */
const mixins = require.context('./mixins', true, /\.js$/i);
mixins.keys().map((key) => {
    Vue.mixin(mixins(key).default);
});

/**
 * The following block of code may be used to automatically register your
 * Vue Mixins. It will recursively scan this directory for the Vue
 * mixins and automatically register them with their "basename".
 *
 * Eg)
 * ./mixins/example-mixin.js -> <div v-example-directive></div>
 */
// const filters = require.context('./filters', true, /\.js$/i);
// filters.keys().map((key) => {
//     Vue.filter(key.split('/').pop().split('.')[0], filters(key).default);
// });

// Get some vendor vue files here
import { directive as onClickaway } from 'vue-clickaway';
Vue.directive('on-clickaway', onClickaway);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// eslint-disable-next-line
const app = new Vue({
    el: '#app',

    data() {
        return {
            state: state,
        };
    },

    mounted() {
        this.events.flushEvents();
        this.events.listen();
        this.events.publish('root-vue-mounted');
    }
});
