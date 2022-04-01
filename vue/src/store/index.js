import {createStore} from "vuex";
import axiosClient from "../axios";
const store = createStore(
    {
        state : {
            user : {
                data : {
                    name : 'Stas Tismenetski',
                    age: '35',
                    imageUrl : 'https://media.npr.org/assets/img/2014/08/07/monkey-selfie_custom-7117031c832fc3607ee5b26b9d5b03d10a1deaca.jpg'
                },
                token : sessionStorage.getItem('TOKEN')
            },
            posts : {
                topPosts : [],
                post : null
            },
            topics :{
                topics : [],
                topic : null
            },
            loading : false,
        },
        getters : {},
        actions : {
            register({commit}, user) {
                return axiosClient.post('/register', user)
                    .then(({data}) => {
                        commit('setUser', data);
                        return data;
                    })
            },
            login({commit}, user) {
                return axiosClient.post('/login', user)
                    .then(({data}) => {
                        commit('setUser', data);
                        return data;
                    })
            },
            topPosts({commit}) {
                commit('startLoader');
                return axiosClient.get('/posts/top/top_posts')
                    .then(({data}) => {

                        commit('setTopPosts', data);
                        commit('stopLoader');
                        return data;
                    })
            },
            topics({commit}) {
                commit('startLoader');
                return axiosClient.get('/topics/topic/all')
                    .then(({data})=> {
                        commit('setTopics', data);
                        commit('stopLoader');
                        return data;
                    })
            },
            getTopic({commit}, id) {
                commit('startLoader');
                return axiosClient.get(`/topics/topic/${id}`)
                    .then(({data}) => {
                        commit('setTopic', data);
                        commit('stopLoader');
                        return data;
                    })
            },
            getPost({commit}, id) {
                commit('startLoader');
                return axiosClient.get(`/posts/post/${id}`)
                    .then(({data}) =>{
                        commit('setPost' , data);
                        commit('stopLoader');
                        return data;
                    })
            },
            postComment({commit}, data) {
                commit('startLoader');
                return axiosClient.post('/comments',data)
                    .then(({data}) => {
                        commit('stopLoader');
                        return data;
                    })
            },
            postReply({commit}, data) {
                commit('startLoader');
                return axiosClient.post('/replies',data)
                    .then(({data}) => {
                        commit('stopLoader');
                        return data;
                    })
            },
            postPost({commit}, data) {
                commit('startLoader');
                return axiosClient.post('/posts',data)
                    .then(({data}) => {
                        commit('stopLoader');
                        return data;
                    })
            },
            upvotePost({commit}, data) {
                commit('startLoader');
                return axiosClient.post('/posts/vote', data)
                    .then(({data})=> {
                    commit('stopLoader');
                    return data;
                })

            },
            downvotePost({commit}, data) {
                commit('startLoader');
                return axiosClient.post('/posts/vote', data)
                    .then(({data})=> {
                        commit('stopLoader');
                        return data;
                    })

            },
            upvoteReply({commit}, data) {
                commit('startLoader');
                return axiosClient.post('/replies/vote', data)
                    .then(({data})=> {
                        commit('stopLoader');
                        return data;
                    })

            },
            downvoteReply({commit}, data) {
                commit('startLoader');
                return axiosClient.post('/replies/vote', data)
                    .then(({data})=> {
                        commit('stopLoader');
                        return data;
                    })

            },
            upvoteComment({commit}, data) {
                commit('startLoader');
                return axiosClient.post('/comments/vote', data)
                    .then(({data})=> {
                        commit('stopLoader');
                        return data;
                    })

            },
            downvoteComment({commit}, data) {
                commit('startLoader');
                return axiosClient.post('/comments/vote', data)
                    .then(({data})=> {
                        commit('stopLoader');
                        return data;
                    })

            },
        },
        mutations : {
            setUser : (state,userData) => {
                state.user.token = userData.token;
                state.user.data = userData.user;
                sessionStorage.setItem('TOKEN' , userData.token);
            },
            setTopPosts(state,postsData){
                state.posts.topPosts = postsData;
            },
            setTopics(state,topicData) {
                state.topics.topics = topicData;
            },
            setTopic(state,topicData) {
                state.topics.topic = topicData;
            },
            startLoader(state) {
                state.loading = true;
            },
            stopLoader(state) {
                state.loading = false;
            },
            setPost(state,postData) {
                state.posts.post = postData;
            }

        },
        modules : {}
    }
)

export default store;
