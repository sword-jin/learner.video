var Vue = require('vue')
var VueRouter = require('vue-router')

import MainHeader from "./components/Header.vue"
import Siderbar from "./components/Siderbar.vue"
import DashBoard from "./views/DashBoard.vue"
import Users from "./views/Users.vue"
import Videos from "./views/Videos.vue"
import Subscribers from "./views/Subscribers.vue"
import Publish from "./views/Publish.vue"

Vue.use(require('vue-resource'))
Vue.use(VueRouter)

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value')

Vue.filter('date', function(value) {
    return value.substring(0, 10);
});

var App = Vue.extend({
    data() {
        return {
            auth: {}
        }
    },
    components: {
        MainHeader,

        Siderbar
    },
    ready: function() {
        this.$http.get('/admin/fetchAuth').then(function(response) {
            this.auth = response.data;
        });
        $('[data-toggle="tooltip"]').tooltip();
    }
})

var router = new VueRouter({})

router.map({
    '/': {
        name: 'dashboard',
        component: DashBoard
    },
    '/users': {
        name: 'users',
        component: Users
    },
    '/videos': {
        name: 'videos',
        component: Videos
    },
    '/subscribers': {
        name: 'subscribers',
        component: Subscribers
    },
    '/publish': {
        name: 'publish',
        component: Publish
    }
})

router.start(App, '#app')
