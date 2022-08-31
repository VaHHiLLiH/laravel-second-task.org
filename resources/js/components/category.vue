<template>
    <div class="category">
        <img v-bind:src="category.image_path">
        <p>{{ category.name }}</p>
        <br/>
        <p>{{ category.description }}</p>
        <button>Delete that category</button>
    </div>
</template>
<script>
 export default {
     props: {
         category: {
             type: Object,
             require: true,
         }
     }
 }
</script>
