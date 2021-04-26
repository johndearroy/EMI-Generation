<template>
    <div class="flex h-screen bg-gray-200 font-roboto">

        <sidebar />

        <div class="flex-1 flex flex-col overflow-hidden">

            <app-header />

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container mx-auto px-6 py-8">
<!--                    <slot />-->
                </div>
            </main>
        </div>
    </div>
</template>
<script>
    import Sidebar from './layouts/sidebar.vue';
    import AppHeader from './layouts/header.vue';
    export default {
        components: {
            Sidebar,
            AppHeader
        },
        data() {
            return {
                message:'Hi, Dear'
            }
        }
    };
</script>
