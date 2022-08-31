require('./bootstrap');

import { createApp } from 'vue';
import Welcome from './components/Welcome';
import HeadMenu from './components/Header';
import Categories from './components/Categories';
import Images from './components/Images';
import Category from './components/category';

const app = createApp({});

app.component('welcome', Welcome);
app.component('head-menu', HeadMenu);
app.component('categories', Categories);
app.component('images', Images);
app.component('category', Category);

app.mount('#app');
