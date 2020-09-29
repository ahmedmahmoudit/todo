import axios from 'axios'

export default {
    getUserTasks(id) {
        return axios.get('api/v1/user/tasks',{
            headers: {
                "Authorization": `Bearer ${this.$store.state.authModule.accessToken}`
            }
        })
    },
    storeTask(task) {
        return axios.post('/tasks/store/', task)
    },
    updateTaskStatus(task){
        return axios.post('/api/v1/task/update', task)
    },
    removeTask(task){
        return axios.post('/api/v1/task/remove', task)
    }
}
