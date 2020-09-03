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

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg)
 * ./components/ExampleComponent.vue -> <example-component></example-component>
 */
const components = require.context('../common/components', true, /\.vue$/i);
components.keys().map((key) => {
    Vue.component(key.split('/').pop().split('.')[0], components(key).default);
});

const base = require.context('./components', true, /\.vue$/i);
base.keys().map((key) => {
    Vue.component(key.split('/').pop().split('.')[0], base(key).default);
});

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
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import { directive as onClickaway } from 'vue-clickaway';
Vue.directive('on-clickaway', onClickaway);

 // eslint-disable-next-line
const app = new Vue({
    el: '#public',

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
