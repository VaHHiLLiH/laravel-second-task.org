<template>
    <div class="heading-panel">
        <div class="logo">
            <!--<img src="https://via.placeholder.com/640x480.png/000066?text=aut" alt="logo">-->
            <img src="https://via.placeholder.com/480x300.png/00cc22?text=Autist" alt="logo">
        </div>
        <a class="menu-item" href="#">Главная</a>
        <a class="menu-item" href="#">Категории</a>
        <a class="menu-item" href="#">Изображения</a>
        <!-- Сделать инпут с поиском категорий, например -->
        <div class="phone-number">
            <p class="number">8 (800)-555-35-35</p>
            <div class="lil-line"></div>
            <p class="order">Сделать заказ</p>
        </div>
        <div class="all-search">
            <input @keyup="findCategories" type="text" class="searching" v-model="name_filter "><img @click="clearingSearch" class="remove-search" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTm8z-Gv7NFQfpe476m7l9Pp9NPIU8MPVvvk3JSVURI-g&s" alt="clearing search">
            <div v-if="categories != null" class="popup-menu">
                <ul v-for="category in categories">
                    <li><a v-bind:href="'/category/' + category.id">{{ category.name }}</a></li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                categories: null,
                name_filter: null,
            }
        },
        methods: {
            findCategories()
            {
                axios.post('/api/findCategories', {
                    name_filter: this.name_filter,
                }).then(response => (this.categories = response.data));
            },
            clearingSearch()
            {
                this.categories = null;
                this.name_filter = null;
            },
        }
    }
</script>
