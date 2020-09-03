export default class {
    /**
     * Create a new Errors instance.
     */
    constructor() {
        this.messages = {}; 
        this.any = false;
        this.count = 0;
    }

    /**
     * Check if the field has an error message
     */
    has(field) {
        if (this.messages[field]) {
            return true;
        }

        return false;
    }

    /**
     * Get the error message for a field
     */
    get(field) {
        return this.messages[field];
    }

    /**
     * Get all error messages
     */
    all() {
        return Object.keys(this.messages).reduce((messages, field) => {
            if (field !== 'count') {
                messages.push(this.messages[field]);
            }

            return messages;
        }, []);
    }

    /**
     * Set an error
     *
     * @param {string} field
     * @param {string} error
     */
    set(field, error) {
        this.messages[field] = error;
        this.any = true;
        this.count += 1;
        this._triggerUpdate();
    }

    /**
     * Record the new errors.
     *
     * @param {object} errors
     */
    record(errors) {
        this.messages = {};
        this.any = true;
        this.count = 0;
        Object.keys(errors).forEach((field) => {
            this.count += 1;
            this.messages[field] = errors[field][0];
        });
    }

    /**
     * Clear one or all error fields.
     *
     * @param {string|null} field
     */
    clear(field) {
        if (this.messages[field]) {
            this.messages[field] = null;
            this._triggerUpdate();
            this.count -= 1;
            if (!this.count) {
                this.any = false;
            }
        }
    }

    /**
     * Reset all of the error messages
     */
    reset() {
        this.messages = {};
        this.any = false;
        this.count = 0;
    }

    /**
     * Turn all of the errors into an html representation
     */
    toHtml(){
        let msg = '';

        this.all().forEach((error) => {
            msg += error+'<br>';
        });

        return msg;
    }

    /**
     * Used for vue reactivity
     */
    _triggerUpdate() {
        this.messages =  Object.keys(this.messages).reduce((errors, field) => {
            errors[field] = this.messages[field];
            return errors;
        }, {});
    }
}
