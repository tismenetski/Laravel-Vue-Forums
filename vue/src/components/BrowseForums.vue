<template>
    <div class="forums">
        <h3 class="browse_forums_title">Browse Forums</h3>
        <ul>
            <li v-for="(topic,index) in topics" :key="index">
                <router-link @click="getTopic($event, topic)" :to="{name: 'topic', params : {id:topic.id}}"><span><font-awesome-icon icon="comment"/></span>{{topic.name}}</router-link>
            </li>
        </ul>
    </div>
</template>

<script setup>
import {useStore} from "vuex";

const store = useStore();


const props = defineProps({
    'topics' : Object
})

function getTopic(event,topic) {

    const topicId = topic.id;
    console.log(topicId);
    store.dispatch('getTopic', topicId);
}

</script>

<style scoped>

.forums {
    border: 1px solid #000;
    flex : 0 0 25%;
    height: fit-content;
}

.forums ul {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.forums ul li {
    margin-top: 10px;
    width: 100%;
}

li span {
    margin-right: 10px;
    margin-left: 10px;
}

.browse_forums_title {
    text-align: center;
    border-bottom: 1px solid #000;
    font-size: 24px;
    font-weight: bold;
}

</style>
