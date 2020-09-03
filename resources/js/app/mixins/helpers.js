export default {
    methods: {
        route: window.route,
        env: window.env,
        url: window.url,
    },

    computed: {
        inProduction() {
            return window.APP_ENV && window.APP_ENV === 'production';
        },
    },
    
    data() {
        return {
            events: window.EventBus,
            dayjs: window.dayjs,
        };
    },
}