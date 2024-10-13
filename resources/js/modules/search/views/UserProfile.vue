<template>
    <div class="user-profile-wrapper">
        <div v-if="error" class="error-text">{{error}}</div>
        <div class="user-profile" v-if="user">
            <div class="user-profile__image">
                <img
                    v-show="imageLoadingStatus === false"
                    class="user-profile__image--size user-profile__image-image"
                    :src="user.image_url"
                    :alt="user.name"
                    @error="imageError()"
                    @load="imageLoaded()"
                />
                <img
                    v-show="imageLoadingStatus !== false"
                    class="user-profile__image--size user-profile__image-placeholder"
                    src="../../../../js/assets/images/user_image_empty.png"
                    alt="Нет фото"
                >
            </div>
            <div class="user-profile__user-info">
                <h4 class="user-profile__user-info-title">{{user.name}}</h4>
                <p class="user-profile__user-info--line user-profile__user-info-email">
                    <span>{{$t('email_label')}}:</span>
                    {{user?.email}}
                </p>
                <p class="user-profile__user-info--line user-profile__user-info-phone">
                    <span>{{$t('phone_label')}}:</span>
                    {{user?.phone}}
                </p>
                <div class="user-profile__user-info-about">
                    <div>{{$t('about_me_label')}}:</div>
                    <p class="user-profile__user-info-about--text">{{user?.about}}</p>
                </div>
            </div>
        </div>
        <div v-else-if="loading" class="user-profile-information loader">{{$t('loading_label')}}</div>
        <div v-else-if="!loading && !error" class="user-profile-information placeholder">{{$t('profile_placeholder')}}</div>
    </div>

</template>

<script setup>
import {computed, onMounted, ref} from 'vue';
import {onBeforeRouteUpdate, useRoute} from 'vue-router';
import {useStore} from "vuex";

const route = useRoute();
const store = useStore();

const user = computed(() => store.getters['search/user'] || null);
let loading = computed(() => store.getters['search/profileLoading']);
const error = computed(() => store.getters['search/userError']);

const imageLoadingStatus = ref({});

const fetchUser = async (id) => {
    try {
        await store.dispatch('search/getUserById', id);
    } catch (err) {
        error.value = err.message;
    } finally {
        loading.value = false;
    }
};

const imageLoaded = () => {
    imageLoadingStatus.value = false
};

const imageError = (event) => {
    event.target.src = '../../../../js/assets/images/user_image_empty_thumb.png';
};

onMounted(() => {
    if (route.params.id) {
        fetchUser(route.params.id);
    }
});

onBeforeRouteUpdate((to, from, next) => {
    if (to.params.id !== from.params.id) {
        fetchUser(to.params.id);
    }
    next();
});
</script>

<style scoped lang="scss">
.user-profile-wrapper {
    height: 100%;
    padding: 30px 30px 30px 20px;
}

.user-profile {
    display: flex;
    justify-content: space-between;

    &__image {
       flex-basis: 49%;

        &--size {
            max-width: 424px;

            @media (max-width: 768px) {
                max-width: 100%;
            }
        }

        &-placeholder {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    }

    &__user-info {
        flex-basis: 49%;

        &-title {
            margin-bottom: 10px;
        }

        &-email {
            margin-bottom: 10px;
        }

        &-phone {
            margin-bottom: 20px;
        }

        &-about {
            &--text {
                overflow-y: scroll;
                max-height: 200px;
            }
            div {
                font-size: 16px;
                font-weight: 600;
                color: $colorBlack;
                margin-bottom: 25px;
            }
        }

        &--line {

            span {
                font-size: 16px;
                font-weight: 600;
                color: $colorBlack;
            }
        }
    }

    @media (max-width: 768px) {
        flex-direction: column;
    }
}

.user-profile-information {
    text-align: center;
    color: #888;
    height: calc(100% - 60px);
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
