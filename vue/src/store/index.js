import {createStore} from "vuex";

const store = createStore(
    {
        state : {
            user : {
                data : {
                    name : 'Stas Tismenetski',
                    age: '35',
                    imageUrl : 'https://media.npr.org/assets/img/2014/08/07/monkey-selfie_custom-7117031c832fc3607ee5b26b9d5b03d10a1deaca.jpg'
                },
                token : null
            }
        },
        getters : {},
        actions : {},
        mutations : {},
        modules : {}
    }
)

export default store;
