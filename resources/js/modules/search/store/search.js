import { apolloClient } from '../../../apollo/client';
import { gql } from '@apollo/client/core';

const state = {
    user: null,
    users: [],
    userListLoading: false,
    profileLoading: false,
    error: null,
};

const getters = {
    user: (state) => state.user,
    users: (state) => state.users,
    userListLoading: (state) => state.userListLoading,
    profileLoading: (state) => state.profileLoading,
    error: (state) => state.error,
};

const actions = {
    async searchUsers({ commit }, searchTerm) {
        commit('SET_USER_LIST_LOADING', true);
        commit('SET_ERROR', null);

        const SEARCH_USERS = gql`
          query($search: String) {
            userSearch(search: $search, limit: 10) {
              id
              email
              name
              image_url
            }
          }
        `;

        try {
            const response = await apolloClient.query({
                query: SEARCH_USERS,
                variables: { search: searchTerm },
            });
            commit('SET_USERS', response.data.userSearch);
        } catch (error) {
            commit('SET_ERROR', error.message);
        } finally {
            commit('SET_USER_LIST_LOADING', false);
        }
    },

    async getUserById({ commit }, userId) {
        console.log('getUserById')
        commit('SET_PROFILE_LOADING', true);
        commit('SET_ERROR', null);

        const FETCH_USER = gql`
          query($id: [Int!]) {
            userSearch(id: $id) {
              id
              username
              name
              email
              about
              image_url
              phone
            }
          }
        `;

        try {
            const response = await apolloClient.query({
                query: FETCH_USER,
                variables: { id: Number(userId) },
            });
            commit('SET_USER', response.data.userSearch[0]);
        } catch (error) {
            commit('SET_ERROR', error.message);
        } finally {
            commit('SET_PROFILE_LOADING', false);
        }
    }
};

const mutations = {
    SET_USER(state, user) {
        state.user = user;
    },
    SET_USERS(state, users) {
        state.users = users;
    },
    SET_USER_LIST_LOADING(state, loading) {
        state.userListLoading = loading;
    },
    SET_PROFILE_LOADING(state, loading) {
        state.profileLoading = loading;
    },
    SET_ERROR(state, error) {
        state.error = error;
    },
    CLEAR_USER(state) {
        state.user = null;
    },
    CLEAR_USERS(state) {
        state.users = [];
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
