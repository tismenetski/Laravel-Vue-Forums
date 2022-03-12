<template>
    <tr>
        <td><span v-if="post.pinned===1"> <font-awesome-icon icon="thumbtack" size="1x"/> </span>{{post.title}}</td>
        <td>{{post.user.username}}</td>
        <td>08.03.2022</td>
        <td>{{post.comments_count}}</td>
        <td>{{post.views}}</td>
    </tr>
</template>

<script setup>
const props = defineProps({
    post : Object
})


</script>

<style scoped>

table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}

td {
    text-align: center;
}

td span {
    margin-right: 10px;
    color : red;
}


tr td:nth-child(1) {
    font-size: 20px;
    font-weight: bold;
}
</style>
