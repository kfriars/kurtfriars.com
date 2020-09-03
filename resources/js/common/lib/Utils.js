export default {
    deepClone(source) {
        // If the source isn't an Object or Array, throw an error.
        if (!(source instanceof Object) || source instanceof Date || source instanceof String) {
            throw 'Only Objects or Arrays are supported.'
        }
        
        if (source.hasOwnProperty('_isVue') && source._isVue) {
            target = {};
            
            Object.keys(source).forEach(key => {
                if (!target.hasOwnProperty(key)) {
                    const original = source[key];
                    // cloneDeep can fail when cloning Vue instances
                    // cloneDeep checks that the instance has a Symbol
                    // which errors in Vue < 2.17 (https://github.com/vuejs/vue/pull/7878)
                    try {
                        target[key] = typeof original === 'object'
                            ? _.cloneDeep(original)
                            : original;
                    } catch (e) {
                        target[key] = original;
                    }
                }
            })

            return target;
        } else {
            var target = _.clone(source);
        }

        for (let prop in source) {
            // Make sure the property isn't on the protoype
            if (source instanceof Object && !(source instanceof Array) && !(source.hasOwnProperty(prop))) {
                continue;
            }

            // If the current property is an Array or Object, recursively clone it, else copy it's value
            if (source[prop] instanceof Object && !(source[prop] instanceof Date) && !(source[prop] instanceof String)) {
                target[prop] = this.deepClone(target[prop]);
            }
        }

        return target;
    },

    deepUpdate(target, source) {
        // If the source isn't an Object or Array, throw an error.
        if (!(source instanceof Object) || source instanceof Date || source instanceof String) {
            throw 'Only Objects or Arrays are supported.'
        }

        for (let prop in source) {
            // Make sure the property isn't on the protoype
            if (source instanceof Object && !(source instanceof Array) && !(source.hasOwnProperty(prop))) {
                continue;
            }

            // If the current property is an Array or Object, recursively clone it, else copy it's value
            if (source[prop] instanceof Object && !(source[prop] instanceof Date) && !(source[prop] instanceof String)) {
                if (source[prop] instanceof Array && source[prop] !== target[prop]) {
                    target[prop].length = 0;
                    source[prop].forEach((value) => {
                        target[prop].push(value);
                    }); 
                } else {
                    this.deepUpdate(target[prop], source[prop]);
                }
            } else {
                target[prop] = source[prop];
            }
        }
    },

    uniqueId() {
        return Date.now() + Math.random().toString().slice(2);
    },

    toKebabCase(str) {
        return str &&
               str.match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g)
                  .map(x => x.toLowerCase())
                  .join('-');
    }
}