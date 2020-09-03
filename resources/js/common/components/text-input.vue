<template>
    <div :class="{ 'mb-0':errors.has(name), 'mb-6 md:mb-0':!errors.has(name) }" class="w-full">
        <label v-if="label.length" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
            {{ label }} <span v-if="required" class="text-blue-300 font-semibold">*</span>  
        </label>
        <input v-model="valueModel" :id="id" :name="name" :placeholder="placeholder" :class="{ 'border-gray-200 focus:border-gray-500': !errors.has(name), 'border-red-600 mb-3': errors.has(name), [bg]:true }" class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" type="text">
        <p class="text-gray-600 text-xs mt-1" v-if="!errors.has(name) && info.length" v-text="info"></p>
        <p class="text-red-600 text-xs mt-1" v-if="errors.has(name)" v-text="errors.get(name)"></p>
    </div>
</template>

<script>
export default {
    name: 'text-input',

    props: {
        label: {
            type: String,
            default: '',
        },
        value: {
            type: String,
            default: '',
        },
        id: {
            type: String,
            default: '',
        },
        placeholder: {
            type: String,
            default: '',
        },
        info: {
            type: String,
            default: '',
        },
        name: {
            type: String,
            default: '',
        },
        mode: {
            type: String,
            default: 'unfiltered',
        },
        required: {
            type: Boolean,
            default: false,
        },
        bg: {
            type: String,
            default: 'bg-gray-200'
        },
        errors: {
            type: Object,
            default: () => { return new Errors(); },
        },
    },

    data() {
        return {
        };
    },

    computed: {
        valueModel: {
            get() {
                return this.value;
            },
            set(value) {
                if (this.mode === 'kebab') {
                    value = Utils.toKebabCase(value);
                }

                this.$emit('input', value);

                this.errors.clear(this.name);
            },
        },
    },

    created() {
        this.valueModel = this.value;
    },
};
</script>
