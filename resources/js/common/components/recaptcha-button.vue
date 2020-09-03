<template>
    <div :class="{ 'mb-0':errors.has(name), 'mb-6 md:mb-0':!errors.has(name) }">
        <template v-if="this.inProduction">
            <vue-recaptcha
                :key="id+'-recaptcha-'+errors.count" 
                :id="id"
                :sitekey="SITE_KEY"
                :size="size"
                :badge="badge"
                :tabindex="tabindex"
                @verify="onVerify"
                @expired="onExpired"
                @render="onRender"
                @error="onError"
                :loadRecaptchaScript="true"
            >
                <button v-if="!verifying" v-html="btnText" @click="verifying = true" :disabled="disableButton" :class="{ ['bg-'+color+'-500']: !disableButton, ['hover:bg-'+color+'-700']: !disableButton, 'bg-gray-300':disableButton, [ classes ]:true }" class="btn text-white"></button>
                <button v-if="verifying" v-text="verifyingText" :class="['bg-'+color+'-300', classes ]" class="loading btn text-white"></button>
            </vue-recaptcha>
        </template>
        <template v-if="!this.inProduction">
            <button v-if="!verifying" v-html="btnText" @click="testVerify()" :disabled="disableButton" :class="{ ['bg-'+color+'-500']: !disableButton, ['hover:bg-'+color+'-700']: !disableButton, 'bg-gray-300':disableButton, [ classes ]:true }" class="btn text-white"></button>
            <button v-if="verifying" v-text="verifyingText" :class="['bg-'+color+'-300', classes ]" class="loading btn text-white"></button>
        </template>
        <p class="text-red-600 text-xs mt-2 ml-4" v-if="errors.has(name)" v-html="errors.get(name)"></p>
    </div>
</template>

<script>
import VueRecaptcha from 'vue-recaptcha';

export default {
    name: 'recaptcha-button',

    components: {
        VueRecaptcha
    },

    props: {
        id: {
            type: String,
            default: 'user-verify',
        },
        name: {
            type: String,
            required: true,
        },
        value: {
            required: true,
            validator: (prop) => {
                return typeof prop === 'string' || prop === null;
            },
        },
        color: {
            type: String,
            default: 'blue',
        },
        classes: {
            type: String,
            default: '',
        },
        theme: {
            type: String,
            default: 'light',
            validator: (prop) => {
                return (prop === 'light') || (prop === 'dark');
            },
        },
        badge: {
            type: String,
            required: false,
        },
        size: {
            type: String,
            default: 'invisible',
            validator: (prop) => {
                return (prop === 'normal') || (prop === 'compact') || (prop === 'invisible');
            },
        },
        tabindex: {
            type: String,
            required: false,
        },
        btnText: {
            type: String,
            default: 'Submit',
        },
        verifyingText: {
            type: String,
            default: 'Verifying',
        },
        errors: {
            type: Object,
            default: () => { return new Errors(); },
        }
    },

    data() {
        return {
            verifying: false,
        };
    },

    methods: {
        onVerify(token) {
            this.verifying = false;
            this.$emit('input', token);
            this.$emit('click');
        },
        
        onExpired(expired) {
            this.verifying = false;
            this.$emit('input', null);
        },

        onRender(id) {
            this.verifying = false;
            if (id === this.id) {
                // This component has rendered into the dom
            }
        },

        testVerify() {
            this.verifying = true;
            
            setTimeout(() => {
                this.$emit('input', 'test-recaptcha-token');
                this.$emit('click');
                this.verifying = false;
            }, 1000);
        },

        onError(error) {
            this.verifying = false;
            this.errors.set(this.name, error);
            Notification.error({
                text: trans('js.recaptcha.timeout'),
            });
        },
    },

    computed: {
        SITE_KEY() {
            return env('RECAPTCHA_V2_INVISIBLE_SITE_KEY');
        },

        disableButton() {
            return this.errors.count > 1 || (this.errors.count === 1 && !this.errors.has(this.name));
        }
    },
}
</script>

<style>
    /* loading dots */
    .loading:after {
        content: ' .';
        animation: dots 1s steps(5, end) infinite;
    }

    @keyframes dots {
        0%, 20% {
        color: rgba(0,0,0,0);
        text-shadow:
            .25em 0 0 rgba(0,0,0,0),
            .5em 0 0 rgba(0,0,0,0);
        }
        40% {
            color: white;
            text-shadow:
            .25em 0 0 rgba(0,0,0,0),
            .5em 0 0 rgba(0,0,0,0);
        }
        60% {
            text-shadow:
            .25em 0 0 white,
            .5em 0 0 rgba(0,0,0,0);
        }
        80%, 100% {
            text-shadow:
            .25em 0 0 white,
            .5em 0 0 white;
        }
    }

    .grecaptcha-badge[data-style=inline] {
        display: none;
    }
</style>