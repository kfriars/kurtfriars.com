export default class {
    /**
     * Create a new Form instance.
     *
     * @param {object} data
     */
    constructor(data = {}, resetOnSuccess = true) {
        // copy the data in 
        this.originalData = Utils.deepClone(data);
        this.resetOnSuccess = resetOnSuccess;

        for (let field in data) {
            this[field] = data[field];
        }

        this.errors = new Errors();
    }

    populate(data) {
        let form = this;

        Object.keys(data).forEach(function (key, index) {
            if (form.has(key)) {
                form[key] = data[key];
            }
        });
    }

    /**
     * Fetch all relevant data for the form.
     */
    has(field) {
        return this.originalData.hasOwnProperty(field);
    }

    /**
     * Fetch all relevant data for the form.
     */
    data() {
        let data = {};
        let form = this;

        Object.keys(this.originalData).forEach(function (property) {
            data[property] = form[property];
        });

        return data;
    }

    /**
     * Reset the form fields.
     */
    reset() {
        let form = this;
        let original = this.originalData;

        Object.keys(this.originalData).forEach(function (field, index) {
            form[field] = original[field];
        });

        this.errors.clear();
    }

    /**
     * Allows us to change the form without newing up a new object
     */
    update(newData) {
        Utils.deepUpdate(this, newData);
        this.errors.clear();
    }

    /**
     * Send a GET request to the given URL.
     * 
     * @param {string} url
     */
    get(url, callback = false) {
        if (callback && typeof callback === "function") {
            return this.submit('get', url, callback(this.data()));
        } else {
            return this.submit('get', url, this.data());
        }
    }

    /**
     * Send a POST request to the given URL.
     * .
     * @param {string} url
     */
    post(url, callback = false) {
        if (callback && typeof callback === "function") {
            return this.submit('post', url, callback(this.data()));
        } else {
            return this.submit('post', url, this.data());
        }
    }

    /**
     * Send a POST request to the given URL.
     * .
     * @param {string} url
     */
    postWithFiles(url, callback = false) {
        let config = { headers : { 'Content-Type': 'multipart/form-data' }, withCredentials: true };
        let form = new FormData();
        let data = null;

        if (callback && typeof callback === "function") {
            data = callback(this.data());
        } else {
            data = this.data();
        }
        
        Object.keys(data).forEach((field) => {
            if (data[field] && data[field].hasOwnProperty('file')) {
                let file = data[field].file;
                form.append(field, file);
            } else if (data[field] !== null) {
                form.append(field, data[field]);
            }
        });

        return new Promise((resolve, reject) => {
            axios.post(url, form, config)
            .then((response) => {
                this.onSuccess(response.data);
                resolve(response.data);
            })
            .catch(this.handleErrors(reject));
        });
    }

    /**
     * Send a PUT request to the given URL.
     * .
     * @param {string} url
     */
    put(url, callback = false) {
        if (callback && typeof callback === "function") {
            return this.submit('put', url, callback(this.data()));
        } else {
            return this.submit('put', url, this.data());
        }
    }

    /**
     * Send a PATCH request to the given URL.
     * .
     * @param {string} url
     */
    patch(url, callback = false) {
        if (callback && typeof callback === "function") {
            return this.submit('patch', url, callback(this.data()));
        } else {
            return this.submit('patch', url, this.data());
        }
    }

    /**
     * Send a DELETE request to the given URL.
     * .
     * @param {string} url
     */
    delete(url, callback = false) {
        if (callback && typeof callback === "function") {
            return this.submit('delete', url, callback(this.data()));
        } else {
            return this.submit('delete', url, this.data());
        }
    }

    /**
     * Submit the form.
     *
     * @param {string} requestType
     * @param {string} url
     */
    submit(requestType, url, data) {
        return new Promise((resolve, reject) => {
            axios({
                url: url,
                method: requestType,
                data: data,
                withCredentials: true,
            })
            .then((response) => {
                this.onSuccess(response.data);
                resolve(response);
            })
            .catch(this.handleErrors(reject));
        });
    }

    /** Handle errors from submitting a form */
    handleErrors(reject) {
        return (error) => {
            if (error.hasOwnProperty('response')) {
                /*
                * The request was made and the server responded with a
                * status code that falls out of the range of 2xx
                */
                if (error.response.status === 422) {
                    // 422 Basic Validation Errors should display from errors 
                    this.handle422(error.response.data);
                } else if (error.response.status === 400) {
                    // 400 Error response should alert the user on fail 
                    this.handle400(error.response.data);
                } else {
                    // Handle all other error responses from the server
                    this.handleGeneric(reject, error.response.data);
                }

            } else if (error.hasOwnProperty('request')) {
                /*
                * The request was made but no response was received, `error.request`
                * is an instance of XMLHttpRequest in the browser and an instance
                * of http.ClientRequest in Node.js
                */
                Notification.error({
                    html: 'There was an error making a request to our servers. If this problem persists, please file a bug <a href="/bugs" class="text-blue-500 underline cursor-pointer">here</a> to have the issue solved.',
                });
                reject(error);

            } else {
                // Something happened in setting up the request and triggered an Error
                if (error.hasOwnProperty('message')) {
                    Notification.error({
                        text: error.message, 
                    });
                }
                reject(error);
            }
        }
    }

    /**
     * Handle basic form validation errors returned from the server
     * 
     * 422 Should is for errors that should only be displayed on fields 
     */
    handle422(error) {
        if (error.hasOwnProperty('errors')) {
            this.errors.record(error.errors);

        } else if (error.hasOwnProperty('message')) {
            Notification.error({
                text: error.message,
            });
        }
    }

    /**
     * Handle form validation errors returned from the server
     * 
     * 400 Validation errors should generate an alert to the user
     */
    handle400(error) {
        if (error.hasOwnProperty('errors')) {
            this.errors.record(error.errors);

            Notification.error({
                html: this.errors.toHtml(),
            });

        } else if (error.hasOwnProperty('message')) {
            this.errors.record(error.errors);
            
            Notification.error({
                text: error.message,
            });
        }
    }

    /**
     * Handle all other response errors from the server
     */
    handleGeneric(reject, error) {
        if (error.hasOwnProperty('message')) {
            Notification.error({
                text: error.message,
            });
        }

        reject(error);
    }

    /**
     * Handle a successful form submission.
     *
     * @param {object} data
     */
    onSuccess(data) {
        if (this.resetOnSuccess) {
            this.reset();
        }
    }
}
