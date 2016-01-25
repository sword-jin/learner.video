var Vue = require('vue')
var VueRouter = require('vue-router')

import DashBoard from "./components/DashBoard"

Vue.use(require('vue-resource'))
Vue.use(VueRouter)

var App = Vue.extend({
    http: {
        root: '/root',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
    }
})

var router = new VueRouter({})

router.map({
    '/': {
        component: DashBoard
    },
})

router.start(App, '#app')
