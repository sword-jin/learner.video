var Vue = require('vue')
var VueRouter = require('vue-router')

import MainHeader from "./components/Header.vue"
import Siderbar from "./components/Siderbar.vue"
import DashBoard from "./views/DashBoard.vue"
import Users from "./views/Users.vue"
import Categories from "./views/Categories.vue"
import Series from "./views/Series.vue"
import Videos from "./views/Videos.vue"
import Blogs from "./views/Blogs.vue"
import CreateBlog from "./views/CreateBlog.vue"
import EditBlog from "./views/EditBlog.vue"
import Subscribers from "./views/Subscribers.vue"
import Links from "./views/Links.vue"

Vue.use(require('vue-resource'))
Vue.use(VueRouter)

// close the warning.
Vue.config.debug = false
Vue.config.silent = true

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value')

Vue.filter('date', value => value.substring(0, 10))

Vue.filter('timeForHuman', value => {
    if (value < 60) {
        return value + '秒';
    } else if (value >= 60 && value < 3600) {
        let minutes = Math.floor(value / 60);
        let seconds = value - minutes * 60;

        return minutes + '分' + seconds + '秒';
    } else if (value < 3600 * 24) {
        let hours = Math.floor(value / 3600);
        let minutes = Math.floor((value - hours * 3600) / 60);
        let seconds = value - hours * 3600 - minutes * 60;

        return hours + '时' + minutes + '分' + seconds + '秒';
    }
})

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
    '/categories': {
        name: 'categories',
        component: Categories
    },
    '/series': {
        name: 'series',
        component: Series
    },
    '/videos': {
        name: 'videos',
        component: Videos
    },
    '/blogs': {
        name: 'blogs',
        component: Blogs
    },
    '/blogs/create': {
        name: 'blog.create',
        component: CreateBlog
    },
    '/blogs/edit/:id': {
        name: 'blog.edit',
        component: EditBlog
    },
    '/subscribers': {
        name: 'subscribers',
        component: Subscribers
    },
    '/links': {
        name: 'links',
        component: Links
    }
})

router.start(App, '#app')
