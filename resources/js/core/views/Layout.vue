<template>
    <div class="layout container">
        <Header />
        <div class="layout__body">
            <aside class="sidebar">
                <Sidebar />
            </aside>
            <main class="main-content">
                <router-view />
            </main>
        </div>
    </div>
</template>

<script setup>
import Sidebar from "../../core/components/Sidebar.vue";
import Header from "../../core/components/Header.vue";
</script>

<style lang="scss" scoped>
@import '../../assets/base.scss';

.layout {
    display: flex;
    flex-direction: column;

    &__body {
        display: flex;
        border-radius: 10px;
        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
        background: $layoutBodyBackgroundColor;
        height: 575px;

        @media (max-width: 768px) {
            flex-direction: column;
            box-shadow: none;
            height: auto;
        }
    }
}

.sidebar {
    max-width: 291px;
    width: 100%;
    border-right: 1px solid $layoutBorderColor;

    @media (max-width: 768px) {
        max-width: 100%;
    }
}

.main-content {
    flex: 1;
}
</style>
