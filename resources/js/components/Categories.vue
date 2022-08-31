<template>
    <div class="categories">
        <div v-for="categories1 in categories">
            <div v-for="category in categories1" class="category">
                <a v-bind:href="'/category/' + category.id">
                    <p>{{ category.name }}</p>
                    <p>{{ category.description }}</p>
                </a>
            </div>
        </div>
    </div>
    <!--<template v-if="categoryLimit > this.page * this.fullCount + this.fullCount">-->
        <button v-if="categoryLimit > this.page * this.fullCount + this.fullCount" @click="loadMoreCategories">Show More</button>
        <!--</template>-->
        <!--<template v-else>-->
            <button v-else disabled>Show More</button>
        <!--</template>-->
    </template>
    <script>
    export default {
        data() {
            return {
                page: 0,
                fullCount: 3,//возможно это надо было брать из конфига????????????????
                categories: [],
                categoryLimit: null,
            }
        },
        mounted() {
            this.getFirstCategory();
            this.getCategoryLimit()
        },
        methods: {
            loadMoreCategories() {
                this.page++;
                axios
                    .post('/api/categories', {
                        start: this.page * this.fullCount,
                        count: this.fullCount,
                    })
                    .then(response => (this.categories[this.page] = response.data));
                console.log(this.categories);
            },
            getFirstCategory() {
                axios
                    .post('/api/categories', {
                        start: this.page * this.fullCount,
                        count: this.fullCount,
                    })
                    .then(response => (this.categories[this.page] = response.data));
            },
            getCategoryLimit() {
                axios
                    .post('/api/categoryLimit')
                    .then(response => (this.categoryLimit = response.data));
            }
        }
    }
    </script>
