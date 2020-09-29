<template>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">LOGO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">My Todo <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" @click="submitLogout" v-if="isAuthenticated">Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login" v-if="!isAuthenticated">Login</a>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    import { mapActions } from 'vuex';
    import { mapGetters } from 'vuex';

    export default {
        name: 'siteHeader',

        computed: {
            ...mapGetters('authModule', [
                'isAuthenticated',
            ])
        },

        methods: {
            ...mapActions('authModule', [
                'logout',
            ]),
            submitLogout() {
                console.log('logout');
                this.logout()
                    .then(() => {
                        this.$router.push({
                            path: '/login'
                        });
                    })
                    .catch((errors) => {
                        // Handle Errors
                        console.log(errors);
                    });
            }
        }
    }
</script>
