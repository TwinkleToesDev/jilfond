<template>
    <header class="header">
        <div class="header__logo">
            <LogoIcon />
        </div>
        <div class="header__user">
            <button class="header-user-button">{{$t('user_button_label')}}</button>
        </div>
    </header>
</template>

<script setup>

import LogoIcon from "./header/LogoIcon.vue";
</script>

<style scoped lang="scss">
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 26px 0;
}
.header-user-button {
    background: none;
    border: none;
    font-size: 16px;
    font-weight: 400;
    line-height: 19.5px;
    text-align: left;
    color: $textColor;
    cursor: pointer;
}
</style>
