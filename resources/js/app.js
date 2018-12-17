
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
	// 0. If using a module system (e.g. via vue-cli), import Vue and VueRouter
	// and then call `Vue.use(VueRouter)`.

window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform';

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import VueRouter from 'vue-router'

Vue.use(VueRouter)

	// 1. Define route components.
	// These can be imported from other files

	// 2. Define some routes
	// Each route should map to a component. The "component" can
	// either be an actual component constructor created via
	// `Vue.extend()`, or just a component options object.
	// We'll talk about nested routes later.

let routes = [
  { path: '/dashboard', component: require('./components/Dashboard.vue') },
  { path: '/profile', component: require('./components/Profile.vue') },
  { path: '/users', component: require('./components/Users.vue') }
]

	// 3. Create the router instance and pass the `routes` option
	// You can pass in additional options here, but let's
	// keep it simple for now.
const router = new VueRouter({
  mode: 'history',
  routes // short for `routes: routes`
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

	 // 4. Create and mount the root instance.
	// Make sure to inject the router with the router option to make the
	// whole app router-aware.

const app = new Vue({
    el: '#app',
    router
});
