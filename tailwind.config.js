module.exports = {
    purge: false,
    theme: {
        extend: {
            spacing: {
                80: '20rem',
                96: '24rem',
                112: '28rem',
                128: '32rem',
                144: '36rem',
                160: '40rem',
                176: '44rem',
                192: '48rem',
            },
            fontFamily: {
                'sans': ['Nunito Sans', 'Sans-Serif'],
            },
            fontSize: {
                '2xs': '0.63rem',
                '3xs': '0.5rem',
            },
            borderWidth: {
                '3': '3px',
            }
        },
    },
    variants: {
        margin: ['responsive', 'first', 'last']
    }
}
