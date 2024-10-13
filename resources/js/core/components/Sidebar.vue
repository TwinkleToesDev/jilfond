<template>
    <div class="sidebar-content">
        <SearchInput />
        <UserList />
    </div>
</template>

<script setup>

import SearchInput from "../../modules/search/components/SearchInput.vue";
import UserList from "../../modules/search/components/UserList.vue";
</script>

<style scoped lang="scss">
.sidebar-content {
    padding: 27px 15px;
}
</style>
