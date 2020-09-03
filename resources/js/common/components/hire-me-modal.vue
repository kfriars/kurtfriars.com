<template>
    <responsive-modal id="hire-me-modal">
        <div class="p-8">
            <template v-if="!success">
                <h6 class="text-responsive font-semibold mb-4"><i class="far fa-envelope-open mr-2"></i> Send Me a Message</h6>
                <p class="mb-6">Looking forward to hearing from you! Please enter your email address below and I will get back to you soon.</p>
                <div class="mb-4">
                    <text-input
                        id="prospect-email"
                        label="Email Address"
                        name="email"
                        :required="true"
                        v-model="form.email"
                        :errors="form.errors"
                    ></text-input>
                </div>
                <text-area
                    id="prospect-message"
                    label="Message"
                    name="message"
                    v-model="form.message"
                    :errors="form.errors"
                    :max="1000"
                ></text-area>
                <div class="mt-4 flex justify-end">
                    <button @click="hideModal()" type="button" class="mr-4 btn border border-gray-300 bg-white text-gray-700 hover:text-gray-500 focus:outline-none focus:border-orange-300 focus:shadow-outline-orange">
                        Cancel
                    </button>
                    <recaptcha-button
                        name="recaptcha_token"
                        v-model="form.recaptcha_token"
                        badge="inline"
                        color="orange"
                        btn-text="Send"
                        :errors="form.errors"
                        @click="submit()"
                    ></recaptcha-button>
                </div>
            </template>
            <template v-if="success">
                <h6 class="text-responsive font-semibold mb-4"><i class="far fa-paper-plane mr-2"></i> Message Sent!</h6>
                <p class="mb-4">I have received your email address and message. I will get back to you shortly!</p>
                <div class="flex justify-end">
                    <button @click="hideModal()" type="button" class="btn bg-green-500 text-white">
                        Close
                    </button>
                </div>
            </template>
        </div>
    </responsive-modal>
</template>

<script>
export default {
    name: 'hire-me-modal',

    data() {
        return {
            success: false,
            form: new Form({
                email: '',
                message: '',
                recaptcha_token: null
            }),
        };
    },

    methods: {
        hideModal() {
            this.events.publish('hide-hire-me-modal');
        },

        submit() {
            this.form.post(this.route('prospect.store')).then((response) => {
                this.success = true;
            })
        }
    }
}
</script>

<style>

</style>