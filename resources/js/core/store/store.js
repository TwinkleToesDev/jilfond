import { createStore } from 'vuex';
import search from '../../modules/search/store/search';

export default createStore({
    modules: {
        search,
    },
});
