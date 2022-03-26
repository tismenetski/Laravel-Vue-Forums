<template>
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
</template>

<script setup>
const props = defineProps({
    comment : Object,
    indexComment : Number
})


</script>

<style scoped>

.comment-votes {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 10px 20px 10px 20px;
    min-width: 30px;
    text-align: center;

}

.single-comment {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-start;
    gap: 30px;
}

.post-header {
    color : dodgerblue;
}

</style>
