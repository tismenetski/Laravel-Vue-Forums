<template>
<div class="container">
    <h2 class="title">Recent Discussions on Stas Forums</h2>
    <div class="main-content">
        <div class="top_posts">
            <table>
                <table-head/>
                <tbody v-for="(post,index) in topPosts" :key="index">
                    <post-item :post="post"></post-item>
                </tbody>
            </table>
        </div>
        <div class="forums">
<!--            <h3 class="browse_forums_title">Browse Forums</h3>-->
        <ul>
            <li v-for="(topic,index) in topics" :key="index">
                <router-link :to="{name: 'topic', params : {id:topic.id}}">{{topic.name}}</router-link>
            </li>
        </ul>
        </div>
    </div>
</div>
</template>

<script setup>
import {useStore} from "vuex";
import {useRouter} from "vue-router";
import {ref,computed} from "vue";
import PostItem from '../components/PostItem.vue';
import TableHead from '../components/TableHead.vue';
const store = useStore();

const router =useRouter();

store.dispatch('topPosts');
store.dispatch('topics');
const topPosts = computed(() => store.state.posts.topPosts);
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
    justify-content: space-evenly;
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

.top_posts {
    flex : 0 0 65%;
}
</style>
