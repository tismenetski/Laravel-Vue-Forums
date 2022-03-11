<template>
<div class="container">
    <h2 class="topic_title">
        Recent Posts on {{topic.name}}
    </h2>

    <div class="topic_content">
        <table>
            <thead>
            <tr>
                <th scope="col">Post Title</th>
                <th scope="col">Author</th>
                <th scope="col">Last Comment</th>
                <th scope="col">Comments</th>
                <th scope="col">Views</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(post,index) in topic.posts" :key="index">
                <td>{{post.title}}</td>
                <td>{{post.user_id}}</td>
                <td>08.03.2022</td>
                <td>{{post.number_of_comments}}</td>
                <td>20</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</template>

<script setup>
import {useStore} from "vuex";
import {useRoute} from "vue-router";
import {ref,computed} from "vue";

const store= useStore();
const route = useRoute();


// go get the topic with the posts
store.dispatch('getTopic',route.params.id);

const topic = computed(() =>store.state.topics.topic);



</script>

<style scoped>

</style>
