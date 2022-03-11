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
                topPosts : []
            },
            topics :{
                topics : [],
                topic : null
            }
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
                return axiosClient.get('/posts/top/top_posts')
                    .then(({data}) => {
                        commit('setTopPosts', data);
                        return data;
                    })
            },
            topics({commit}) {
                return axiosClient.get('/topics/topic/all')
                    .then(({data})=> {
                        commit('setTopics', data);
                        return data;
                    })
            },
            getTopic({commit}, id) {
                return axiosClient.get(`/topics/topic/${id}`)
                    .then(({data}) => {
                        commit('setTopic', data);
                        return data;
                    })
            }
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
            }
        },
        modules : {}
    }
)

export default store;
