<template>
    <div class="container">
        <loader v-if="loader"></loader>
        <div  v-else class="main">
<!--            <pre>{{post}}</pre>-->
            <h2 class="post-title">{{post.title}}</h2>
            <div class="posts-content">
                <div class="post-content">
                    <h4 class="post-header">#1    {{post.user.username}}</h4>
                    <div>{{post.content}}</div>
                </div>
                <div v-for="(comment,indexComment) in post.comments" class="post-comments">
                    <div class="post-comment">
                        <h4 class="post-header">#{{indexComment+2}} {{comment.user.username}}</h4>
                        {{comment.content}}
                    </div>
                    <div v-for="(reply,indexReply) in comment.replies" class="post-comment-replies">
                        <h4 class="post-header">#{{indexComment+2}}.{{indexReply+1}} {{reply.user.username}}</h4>
                        {{reply.content}}
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script setup>
import Loader from '../components/Loader.vue';
import {useStore} from "vuex";
import {useRoute} from "vue-router";
import {computed} from "vue";


const store = useStore();
const route = useRoute();

store.dispatch('getPost', route.params.id);

const loader = computed(() => store.state.loading);
const post = computed(() =>store.state.posts.post);
const topics = computed(() => store.state.topics.topics);



</script>

<style scoped>

.main {
    padding: 20px;
    margin-top: 100px;
}

.container {
    margin: 0 auto;
    background-color: #e2e8f0;
}

.post-title {
    font-size: 36px;
    border-bottom: 1px solid #3f3f3f;
}

.posts-content{
    display: flex;
    flex-direction: column;
    gap: 100px;
    margin-top: 40px;
}

.post-header {
    color : dodgerblue;
}

.post-comment , .post-comment-replies {
    margin-top: 40px;
}

.post-comment-replies {
    margin-left: 20px;
}
</style>
