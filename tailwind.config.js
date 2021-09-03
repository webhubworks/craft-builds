module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        'node_modules/vue-tailwind/dist/*.js',
    ],
    mode: 'jit',
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            fontFamily: {
                'sans': ['Inter', 'Helvetica', 'Arial', 'sans-serif']
            },
            colors: {
                body: '#EBEBEB',
                black: '#121212',
                primary: '#F9FF00',
                muted: '#EBEBEB'
            },
        },
        container: {
            center: true,
        },
    },
    variants: {
        extend: {
            textColor: ['group-hover'],
            backgroundColor: ['group-hover'],
            opacity: ['disabled'],
            cursor: ['disabled'],
        },
    },
    plugins: [],
}
