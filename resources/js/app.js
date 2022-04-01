require('./bootstrap');

import { createApp } from 'vue'

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


const app = createApp({});
app.component('statements', require('./components/StatementComponent.vue').default);
app.mount('#statements');
