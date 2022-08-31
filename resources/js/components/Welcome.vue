<template>
    <ul>
        <li v-for="user in users">{{ user }}</li>
    </ul>
    <button @click="loadMoreUsers">Upload more users</button>
</template>
<script>
export default {
    data() {
        return {
            users: ['John', 'Andrew'],
        }
    },
    methods: {
        loadMoreUsers() {
            axios
                .post('/api/categories', {
                    start: 2,
                    count: 3,
                })
                .then(response => (this.info = response.data.bpi));
        }
    }
}
</script>
