<template>
    <div>
        <site-header></site-header>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <todo />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Todo from './pages/Todo'
    import SiteHeader from "./partials/SiteHeader";

    export default {
        components: {
            Todo, SiteHeader
        },
        mounted() {

            if (!this.$store.getters['authModule/isAuthenticated']) {
                this.$router.push({
                    path: '/login'
                });
            }
        },
    }
</script>
