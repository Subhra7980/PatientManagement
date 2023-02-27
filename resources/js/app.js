require('./bootstrap');
import { createApp } from 'vue';
import routes from './routes';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const login = createApp({});
login.use(routes).mount('#login');

const dashboard = createApp({});
dashboard.use(routes).mount('#dashboard');

login.use(VueSweetalert2); 
dashboard.use(VueSweetalert2);
