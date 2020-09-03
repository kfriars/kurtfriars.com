<template>
    <recaptcha-button
        id="pdf-token"
        name="pdf_token"
        v-model="form.pdf_token"
        badge="inline"
        color="red"
        btn-text="<i class='far fa-file-pdf mr-2'></i> Download as PDF"
        :errors="form.errors"
        @click="download()"
    ></recaptcha-button>
</template>

<script>
export default {
    name: 'cv-download',

    data() {
        return {
            form: new Form({ pdf_token: null })
        };
    },

    methods: {
        download() {
            let href = route('cv.download', {
                token: this.form.pdf_token 
            }).url();

            var a = document.createElement('a');
            a.href = href;
            a.setAttribute('target', '_blank'); 
            a.click();
        }
    }
}
</script>

<style>

</style>