<template>
    <div class="search-input">
        <h4 class="search-input__title">{{$t('search_title')}}</h4>
        <Input
            modelValue="searchTerm"
            v-model="searchTerm"
            @input="onSearch"
            :placeholder="$t('search_input_placeholder')"
        />
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import { useStore } from 'vuex';
import Input from "../../../core/components/base/Input.vue";

const searchTerm = ref('');
const store = useStore();

const onSearch = () => {
    if (searchTerm.value.trim() === '') {
        store.commit('search/CLEAR_USER');
        store.commit('search/CLEAR_USERS');
    } else {
        store.dispatch('search/searchUsers', searchTerm.value);
    }
};

watch(searchTerm, (newValue) => {
    if (newValue.trim() === '') {
        store.commit('search/CLEAR_USERS');
    }
});
</script>

<style scoped lang="scss">
.search-input {
    max-width: 240px;
    margin-bottom: 22px;
    margin-left: 5px;

    @media (max-width: 768px) {
        max-width: 100%;
    }

    &__title {
        margin-bottom: 22px;
    }
}
</style>
