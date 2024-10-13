<template>
    <div class="user-list">
        <h4 class="user-list__title">{{$t('search_result_title')}}</h4>

        <div v-if="userListLoading" class="user-list__loader">{{$t('loading_label')}}</div>
        <p v-if="error" class="user-list__error-text error-text">{{ error }}</p>
        <p v-if="!error && users.length === 0 && !userListLoading" class="user-list__empty">{{$t('search_result_empty')}}</p>

        <div class="user-list__search-result" v-else>

            <ul v-if="!error" class="user-list__items">
                <li
                    v-for="user in users"
                    :key="user.id"
                    @click="selectUser(user.id)"
                    :class="['user-list__item', { 'user-list__item--selected': user.id === selectedUserId }]"
                >
                    <div
                        class="user-list__item-image-wrapper"
                    >
                        <img
                            v-show="imageLoadingStatus[user.id] === false"
                            class="user-list__item-image"
                            :src="user.image_url"
                            :alt="user.name"
                            @error="imageError($event, user.id)"
                            @load="imageLoaded(user.id)"
                        />
                        <img
                            v-show="imageLoadingStatus[user.id] === true"
                            class="user-list__item-image-placeholder"
                            src="../../../../js/assets/images/user_image_empty_thumb.png"
                            alt="user_image_empty_thumb"
                        >
                    </div>
                    <div class="user-list__item-body">
                        <div class="user-list__item-name">{{ user.name }}</div>
                        <p class="user-list__item-email">{{ user.email }}</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import {computed, reactive, ref, watch} from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

const store = useStore();
const router = useRouter();

const users = computed(() => store.getters['search/users']);
const userListLoading = computed(() => store.getters['search/userListLoading']);
const error = computed(() => store.getters['search/searchError']);

const imageLoadingStatus = reactive({});
const selectedUserId = ref(null);

watch(
    () => users.value,
    (newUsers) => {
        newUsers.forEach((user) => {
            if (!(user.id in imageLoadingStatus)) {
                imageLoadingStatus[user.id] = true;
            }
        });
    },
    { immediate: true }
);

const imageLoaded = (userId) => {
    imageLoadingStatus[userId] = false
};

const imageError = (event) => {
    event.target.src = '../../../../js/assets/images/user_image_empty_thumb.png';
};

const selectUser = (userId) => {
    selectedUserId.value = userId;
    router.push({ name: 'UserProfile', params: { id: userId } });
};
</script>

<style scoped lang="scss">
.user-list {

    &__search-result {
        margin-top: 18px;
        padding: 5px 5px 0 5px;
        max-height: 375px;
        overflow-y: scroll;

        scrollbar-width: thin;
        scrollbar-color: #E0E0E0 transparent;

        &::-webkit-scrollbar {
            width: 6px;
        }

        &::-webkit-scrollbar-track {
            background: transparent;
        }

        &::-webkit-scrollbar-thumb {
            background-color: $darkGrey;
            border-radius: 10px;
        }

        &::-webkit-scrollbar-thumb:hover {
            background-color: $darkGrey;
        }
    }

    &__items {
        display: flex;
        flex-direction: column;
        list-style: none;
        padding: 0 6px 0 0;
        margin: 0;
    }

    &__item {
        display: flex;
        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        margin-bottom: 18px;
        min-height: 70px;
        cursor: pointer;
        border: 1px solid transparent;
        &:hover {
            background-color: $userListItemHoverColor;
        }
        &-body {
            padding-left: 15px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-bottom-right-radius: 10px;
            border-top-right-radius: 10px;
        }
        &-name {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 140px;

            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        &-email {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 140px;
        }
        &-image-loading.user-list__item-image-placeholder {
            display: none;
        }
        &-image-wrapper {
            width: 70px;
            height: 70px;
            background: white;
            border-bottom-left-radius: 10px;
            border-top-left-radius: 10px;
            img {
                width: 100%;
                height: 100%;

                border-bottom-left-radius: 10px;
                border-top-left-radius: 10px;
            }
        }
        &--selected {
            background-color: $darkGrey !important;
            border: 1px solid $darkGrey;
            box-shadow: none;
        }
    }

    &__title {
        margin-left: 5px;
    }

    &__empty {
        margin: 10px 0 0 5px;
    }

    &__loader {
        text-align: center;
        margin: 0 0 0 5px;
    }

    &__error-text {
        margin: 10px 0 0 5px;
    }

}
</style>
