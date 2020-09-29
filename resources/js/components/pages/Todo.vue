<template>
    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-lg-12">
                    <div class="card px-3">
                        <div class="card-body">
                            <h4 class="card-title">Awesome Todo list</h4>
                            <form @submit.prevent="addTask">
                                <div class="add-items d-flex">
                                    <input v-model="task" type="text" class="form-control todo-list-input" placeholder="What do you need to do today?">
                                    <select name="categories" v-model="category" class="form-control" style="height: 50px;width: 20%;" required>
                                        <option v-for="category in categories" :value="category.id"> {{category.name}} </option>
                                    </select>
                                    <button type="submit" class="add btn btn-primary font-weight-bold todo-list-add-btn">Add</button> </div>
                                <div class="list-wrapper">
                                    <ul class="d-flex flex-column-reverse todo-list">
                                        <li v-for="task in tasks" :class="{completed: task.status}">
                                            <div class="form-check" @click="updateTaskStatus(task)">
                                                <label class="form-check-label">
                                                    <input class="checkbox" type="checkbox" v-model="task.status">
                                                        {{task.task}}
                                                    <i class="input-helper"></i></label>
                                            </div>
                                            <font-awesome-icon class="remove" @click="removeTask(task)" icon="times" />
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                task:'',
                category: 1,
                categories: [],
                tasks: []
            };
        },
        mounted() {
            if (this.$store.getters['authModule/isAuthenticated']) {
                axios.get(
                    '/api/v1/tasks',
                    {headers: {
                            "Authorization" : `Bearer ${this.$store.state.authModule.accessToken}`
                        }
                    }
                ).then((response) => {
                    this.tasks = response.data;
                });

                axios.get(
                    '/api/v1/categories',
                    {headers: {
                            "Authorization" : `Bearer ${this.$store.state.authModule.accessToken}`
                        }
                    }
                ).then((response) => {
                    this.categories = response.data;
                });
            }else{
                this.$router.push({
                    path: '/login'
                });
            }
        },
        methods: {
            addTask(){
                //update API
                axios.post(
                    '/api/v1/tasks/store', {task: this.task, category_id: this.category},
                    {headers: {
                            "Authorization" : `Bearer ${this.$store.state.authModule.accessToken}`
                        }
                    }
                ).catch((errors) => {
                    // Handle Errors
                    this.$swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: errors.data.message,
                    });
                });

                this.tasks.push({
                    task: this.task,
                    status: false
                });

                this.task = '';
            },
            updateTaskStatus(task){
                axios.patch(
                    '/api/v1/tasks/update', {status: 1, id: task.id},
                    {headers: {
                            "Authorization" : `Bearer ${this.$store.state.authModule.accessToken}`
                        }
                    }
                ).catch((errors) => {
                    // Handle Errors
                    this.$swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: errors.data.message,
                    });
                });
            },
            removeTask(task){

                //update API
                axios.post(
                    '/api/v1/tasks/destroy', {id: task.id},
                    {headers: {
                            "Authorization" : `Bearer ${this.$store.state.authModule.accessToken}`
                        }
                    }
                ).catch((errors) => {
                    // Handle Errors
                    this.$swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: errors.data.message,
                    });
                });

                //update Vue
                const taskIndex = this.tasks.indexOf(task);
                this.tasks.splice(taskIndex, 1);
            }
        }
    }
</script>
