<template>
    <div class="container">
        <loader v-if="loader"></loader>
        <div  v-else class="main">
            <h2 class="post-title">{{post.title}}</h2>
            <div class="posts-content">
                <div class="single-post">
                    <div class="post-votes">
                        <font-awesome-icon icon="caret-up" size="2x" />
                        <p class="post-votes-result">{{post.votes}}</p>
                        <font-awesome-icon icon="caret-down" size="2x" />
                    </div>
                        <div class="post-content">
                            <h4 class="post-header">#1    {{post.user.username}}</h4>
                            <div>{{post.content}}</div>
                        </div>
                </div>
                <div v-for="(comment,indexComment) in post.comments" class="post-comments">
                    <div class="single-comment">
                        <div class="comment-votes">
                            <font-awesome-icon icon="caret-up" size="2x" />
                            <p class="post-votes-result">{{comment.votes}}</p>
                            <font-awesome-icon icon="caret-down" size="2x" />
                        </div>
                        <div class="post-comment">
                            <h4 class="post-header">#{{indexComment+2}} {{comment.user.username}}</h4>
                            {{comment.content}}
                        </div>
                    </div>

                    <div v-for="(reply,indexReply) in comment.replies" class="post-comment-replies">
                        <div class="reply-votes">
                            <font-awesome-icon icon="caret-up" size="2x" />
                            <p class="post-votes-result">{{reply.votes}}</p>
                            <font-awesome-icon icon="caret-down" size="2x" />
                        </div>
                        <div class="post-reply">
                            <h4 class="post-header">#{{indexComment+2}}.{{indexReply+1}} {{reply.user.username}}</h4>
                            {{reply.content}}
                        </div>

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

.post-votes , .comment-votes, .reply-votes {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 10px 20px 10px 20px;
}

.post-votes , .comment-votes, .reply-votes p {
    min-width: 30px;
    text-align: center;
}

.single-post  {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 20px;
}

.single-comment {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-start;
    gap: 30px;
}

.post-comment-replies {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-start;
    margin-left: 40px;
    gap: 30px;
    margin-top: 20px;
}
</style>
