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
                <div v-if="token"   class="post-actions" >
                    <textarea name="comment"
                              id="comment"
                              v-model="commentText"
                              class="comment-textarea"
                              :class="{ 'show-comment-textarea' : showComment   }"
                              placeholder="Share Your Thoughts..." rows="5" cols="100"></textarea>
                        <div class="comment-buttons">
                            <button @click="toggleShowComment" class="comment-button">Comment</button>
                            <button v-if="commentText!==''" @click="submitComment()" class="comment-button">Submit</button>
                        </div>
                </div>
                <div v-for="(comment,indexComment) in post.comments" class="post-comments" :key="indexComment">
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
                    <div v-if="token"   class="post-actions" >
                    <textarea name="reply"
                              id="reply"
                              v-model="replyText"
                              class="reply-textarea"
                              :class="{ 'show-reply-textarea' :  currentReply(indexComment)   }"
                              placeholder="Share Your Thoughts..." rows="5" cols="100"></textarea>
                        <div class="reply-buttons">
                            <button @click="markActiveReply(indexComment,comment);" class="comment-button">Reply</button>
                            <button v-if="currentReply(indexComment)" @click="submitReply()" class="comment-button">Submit</button>
                        </div>
                    </div>
                    <div v-for="(reply,indexReply) in comment.replies" class="post-comment-replies" :key="indexReply">
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
import {computed, ref} from "vue";


const store = useStore();
const route = useRoute();

store.dispatch('getPost', route.params.id);

const loader = computed(() => store.state.loading);
const post = computed(() =>store.state.posts.post);
const topics = computed(() => store.state.topics.topics);
const token = computed(() =>store.state.user.token);




const showComment = ref(false);
const commentText = ref('');
const replyText = ref('');
const replyToCommentId = ref(null);
const activeReply = ref(-1);
const activeComment = ref(-1);

function toggleShowComment(){
    showComment.value = !showComment.value;
    if (showComment) {
        activeReply.value = -1;
    }
}

function markActiveReply(index,comment) {
    commentText.value = '';
    replyText.value = '';
    showComment.value = false;
    activeReply.value = index;
    replyToCommentId.value = comment.id;

}

function currentReply(index) {
    return activeReply.value === index;
}

async function submitReply(){

    const data = {
        comment_id : replyToCommentId.value,
        content : replyText.value
    }
    await store.dispatch('postReply', data);
    await store.dispatch('getPost', route.params.id);

}

async function submitComment() {

     const data= {
            post_id :  this.post.id,
            content : commentText.value
     }

    await store.dispatch('postComment', data);
    await store.dispatch('getPost', route.params.id);
}

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
    gap: 30px;
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

.comment-button {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 15px 30px;
    background-color: rgb(44, 62, 80) ;
    color : #fff;
    border-radius: 5px;
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


.comment-textarea, .reply-textarea {
    display: none;
    border-radius: 5px;
    padding: 5px;
    width: 100%;
}

.reply-buttons, .comment-buttons {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    align-items: center;
    gap: 20px;
}
.show-comment-textarea {
    display: block;

}

.show-reply-textarea {
    display: block;

}

.comment-button {
    margin-top: 30px;
}
</style>
