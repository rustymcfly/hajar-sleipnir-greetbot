import {createApp} from 'vue'
import {createRouter, createWebHashHistory} from 'vue-router'

import App from './components/app'
import Home from "./components/page/Home";
import About from "./components/page/About";
import Knowledgebase from "./components/page/Knowledgebase";
import Login from "./components/page/Login";
import Logout from "./components/page/Logout";
import Commands from "./components/page/Commands";

const routes = [
    { path: '/', component: Home },
    { path: '/about', component: About },
    { path: '/knowledgebase', component: Knowledgebase },
    { path: '/login', component: Login },
    { path: '/logout', component: Logout },
    { path: '/commands', component: Commands },
];

const router = createRouter({
    history: createWebHashHistory(),
    linkExactActiveClass: 'active',
    linkActiveClass: '',
    routes
});

const app = createApp({
    data () {
        return {
            user: {
                auth: false
            }
        }
    },
    components: {App},
    template: '<app/>'
});

app.use(router);

app.mount( '#app');
