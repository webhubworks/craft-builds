import Translator from "./Translator";
import Vue from 'vue'
import {createInertiaApp} from '@inertiajs/inertia-vue'
import {InertiaProgress} from '@inertiajs/progress'
import VueTailwind from 'vue-tailwind'
import VueTailwindSettings from './VueTailwind';
import VueApexCharts from 'vue-apexcharts'

require('./bootstrap')

Vue.mixin({
    methods: {
        $t(key, replace = {}) {
            return Translator(this.$page.props.i18n.lines, key, replace)
        },
    },
})
Vue.use(VueApexCharts)

Vue.component('apexchart', VueApexCharts)
Vue.use(VueTailwind, VueTailwindSettings)

InertiaProgress.init()

createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({el, app, props}) {
        new Vue({
            render: h => h(app, props),
        }).$mount(el)
    },
})
