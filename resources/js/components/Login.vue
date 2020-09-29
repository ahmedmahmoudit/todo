<template>
    <div class="container register">
        <div class="row">
            <div class="col-md-3 register-left">
                <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                <h3>Welcome</h3>
                <p>You are 30 seconds away from starting make todo list!</p>
            </div>
            <div class="col-md-9 register-right">
                <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Register</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Login</h3>
                        <form @submit.prevent="submitLogin">
                            <div class="row register-form">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input v-model="loginCredentials.email" id="email" type="email" class="form-control" placeholder="Your Email *" value="" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input v-model="loginCredentials.password" id="password" type="password" class="form-control" placeholder="Password *" value="" />
                                    </div>
                                    <input type="submit" id="submitLogin" class="btnRegister btnLoginSubmit" value="Login"/>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <h3  class="register-heading">Register</h3>
                        <form @submit.prevent="submitRegister">
                            <div class="row register-form">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Full Name *" v-model="registerCredentials.name" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email *" v-model="registerCredentials.email" value="" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password *" v-model="registerCredentials.password" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Confirm Password *" v-model="registerCredentials.password_confirmation" value="" />
                                    </div>
                                    <input type="submit" class="btnRegister"  value="Register"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import { mapActions } from 'vuex';

    export default {

        data() {
            return {
                loginCredentials: {
                    email: '',
                    password: '',
                },
                registerCredentials: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                }
            };
        },
        methods: {
            ...mapActions('authModule', [
                'login', 'register'
            ]),
            submitLogin() {
                this.login({ ...this.loginCredentials })
                    .then(() => {
                        this.$router.push({
                            path: '/home'
                        });
                    })
                    .catch((errors) => {
                        // Handle Errors
                        this.$swal({
                            icon: 'error',
                            title: 'Oops...',
                            text: errors.data.message,
                        });
                    });
            },
            submitRegister(){
                this.register({ ...this.registerCredentials })
                    .then(() => {
                        this.loginCredentials = {
                            email: this.registerCredentials.email,
                            password: this.registerCredentials.password,
                        };
                        this.submitLogin();
                    })
                    .catch((errors) => {
                        // Handle Errors
                        this.$swal({
                            icon: 'error',
                            title: 'Oops...',
                            text: errors.data.message,
                        });
                    });
            }
        }
    }
</script>
