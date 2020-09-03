export default new (class {
    constructor() {
        this.vue = new Vue();
        this.events = {};

        this.queueMode = true;
        this.queued = [];
    }

    subscribe(event, callback) {
        this.vue.$on(event, callback);
    }

    publish(event, arg) {
        if (this.queueMode) {
            this.queued.push([event, arg]);
            return;
        }

        this.vue.$emit(event, arg);

        return;
    }

    flushEvents() {
        this.queued.forEach(([event, arg]) => {
            this.publish(event, arg);
        });

        this.queued.length = 0;
    }

    listen() {
        this.queueMode = false;
    }

    queue() {
        this.queueMode = true;
    }
});
