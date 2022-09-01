<template>
    <div class="category">
        <img v-bind:src="category.image_path">
        <h2 class="name">{{ category.name }}</h2>
        <br/>
        <h3 class="description">{{ category.description }}</h3>

        <div class="images">
            <div class="img-container">
                <div v-for="image in images">
                    <img v-bind:src="image.image_path" v-bind:alt="image.name">
                </div>
            </div>
            <div class="pagination">
                <span v-if="page > 1" @click="firstPage" class="first-page">&lt;&lt;</span>
                <span v-else class="first-page disabled">&lt;&lt;</span>

                <span v-if="page > 1" @click="prevPage" class="prev-page">&lt;</span>
                <span v-else class="prev-page disabled">&lt;</span>

                <!--<span class="current-page disabled">{{ page }}</span>-->
                <div v-for="(paginate, index) in paginate_array">
                    <span v-if="index == 0 && page > 3" @click="showOlder(paginate)">...</span>
                    <ul @click="closeAllUl" class="oldPage" v-if="oldest != null && index == 0 && page > 3 && oldestBool">
                        <li v-for="old_page in oldest" @click="goPage(old_page)">old_page {{ old_page }}</li>
                    </ul>

                    <span v-if="paginate >= 1 && paginate <= count_page && page == paginate" @click="goPage(paginate)" class="current-page active">{{ paginate }}</span>
                    <span v-else @click="goPage(paginate)" class="current-page">{{ paginate }}</span>

                    <span v-if="index == 4 && paginate < count_page" @click="showNewer(paginate+1)">...</span>
                    <ul @click="closeAllUl" class="newPage" v-if="newest != null && index == 4 && paginate < count_page && newestBool">
                        <li v-for="new_page in newest" @click="goPage(new_page)">new_page {{ new_page }}</li>
                    </ul>
                </div>

                <span v-if="page < count_page" @click="nextPage" class="next-page">></span>
                <span v-else class="next-page disabled">></span>

                <span v-if="page < count_page" @click="lastPage" class="last-page">>></span>
                <span v-else class="last-page disabled">>></span>
            </div>
        </div>

        <button class="last-button" @click="deleteCategory">Delete that category</button>
    </div>
</template>
<script>
 export default {
     data () {
         return {
             page: 1,
             max_count: null,
             count: 4,
             count_page: null,
             images: null,
             paginate_array: [
                 1, 2, 3, 4, 5
             ],
             oldest: [],
             oldestBool: false,
             newest: [],
             newestBool: false,
         }
     },
     mounted() {
         this.getCount();
         this.firstPage();
     },
     props: {
         category: {
             type: Object,
             require: true,
         },/*
         images: {
             type: Object,
             require: true,
         }*/
     },
     methods: {
        deleteCategory() {
            axios
                .post('/api/deleteCategory', {
                    category_id: this.category.id,
                })
                .then(response => {window.location.href='/'});

        },
        getCount() {
            axios
                .post('/api/getCount', {
                    category_id: this.category.id,
                })
                .then(response => {this.max_count = response.data})
                .then(response => {this.count_page = Math.ceil(this.max_count/this.count)});
        },
        firstPage() {
            this.oldestBool = false;
            this.newestBool = false;
            this.page = 1;
            this.getImages(this.page);
        },
        prevPage() {
            this.newestBool = false;
            this.oldestBool = false;
            this.page--;
            this.getImages(this.page);
        },
        nextPage() {
            this.newestBool = false;
            this.oldestBool = false;
            this.page++;
            this.getImages(this.page);
        },
        lastPage() {
            this.newestBool = false;
            this.oldestBool = false;
            this.page = this.count_page
            this.getImages(this.page);
        },
        goPage(param) {
            this.newestBool = false;
            this.oldestBool = false;
            this.page = param;
            this.getImages(this.page);
        },
        closeAllUl(){
             this.oldestBool = false;
             this.newestBool = false;
        },
        showOlder(end) {
            this.newestBool = false;
            this.oldest.length = 0;
            if (this.oldestBool == false) {
                for (let i = 1; i < end; i++) {
                    this.oldest[i - 1] = i;
                }
                this.oldestBool = true;
            } else {
                this.oldestBool = false;
            }
        },
        showNewer(start) {
            this.oldestBool = false;
            this.newest.length = 0;
            if (this.newestBool == false) {
                let j = 0;
                for (let i = start; i <= this.count_page; i++) {
                    this.newest[j] = i;
                    j++;
                }
                this.newestBool = true;
            } else {
                this.newestBool = false;
            }
        },
        getImages(page) {
            axios
                .post('/api/getPeaceImages', {
                    start: (page-1) * this.count,
                    count: this.count,
                    id: this.category.id,
                })
                .then(response => {this.images = response.data});

            this.getPaginateArray();
        },
        getPaginateArray() {
            if ((this.page == 1) || (this.page == 2)) {
                this.paginate_array = [
                  1, 2, 3, 4, 5
                ];
            } else if ((this.page == this.count_page - 1) || (this.page == this.count_page)) {
                this.paginate_array = [
                    this.count_page - 4, this.count_page - 3, this.count_page - 2, this.count_page - 1, this.count_page
                ];
            }  else {
                this.paginate_array = [
                    this.page - 2, this.page - 1, this.page, this.page + 1, this.page + 2
                ];
            }
        },
     }

 }
</script>
