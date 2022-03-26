<template>
    <div class="container">
        <h2 class="title">Recent Discussions on Stas Forums</h2>
        <loader v-if="loader"></loader>
        <div v-else class="main-content">
            <router-link :to="{ name : 'createPost' , params : {id : topic.id}}">Create Post</router-link>
            <div class="posts">
                <table>
                    <table-head/>
                    <tbody v-for="(post,index) in topic.posts" :key="index">
                    <post-item :post="post"></post-item>
                    </tbody>
                </table>
            </div>
            <browse-forums :topics="topics"></browse-forums>

        </div>
    </div>
</template>

<script setup>
import {useStore} from "vuex";
import {useRoute} from "vue-router";
import {ref,computed} from "vue";
import PostItem from '../components/PostItem.vue';
import TableHead from '../components/TableHead.vue';
import BrowseForums from '../components/BrowseForums.vue';
import Loader from '../components/Loader.vue';
const store= useStore();
const route = useRoute();



// go get the topic with the posts
store.dispatch('getTopic',route.params.id);
store.dispatch('topics');



const loader = computed(() => store.state.loading);
const topic = computed(() =>store.state.topics.topic);
const topics = computed(() => store.state.topics.topics);



</script>

<style scoped>

.container {
    margin: 0 auto;
}

.main-content {
    padding-top: 100px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}

table {
    width: 100%;
}

.title {
    border: 2px #3f3f3f solid;
    padding: 20px;
    background-color: #a0aec0;
    font-size: 32px;
    font-weight: 700;
    border-radius: 20px;
    margin-top: 30px;
}

tbody tr:nth-child(even) {
    background: #f7fafc;
}

.posts {
    flex : 0 0 65%;
}


</style>
