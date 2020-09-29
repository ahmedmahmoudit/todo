import TaskService from "../../services/TaskService";

const getDefaultState = () => {
    return {
        tasks: [],
    }
};

export const state = getDefaultState();

export const mutations = {
    ADD_TASK(state, item){
        state.tasks.push(item);
    },
    UPDATE_ITEM(state, item){
        let currentItem = this.getters.getTask(item);
        currentItem = item;
    },
    REMOVE_ITEM(state, item){
        state.tasks.splice(state.tasks.indexOf(item), 1);
    },
    CLEAR_ITEMS(state){
        Object.assign(state, getDefaultState());
    }
};

export const actions = {
    createNewTask({ commit }, item) {
        commit('ADD_TASK', item);
    },
    updateItem({ commit }, item) {
        commit('UPDATE_ITEM', item);
    },
    removeItem({ commit }, item) {
        commit('REMOVE_ITEM', item);
    },
    clearCart({ commit }) {
        commit('CLEAR_ITEMS');
    }
};
export const getters = {
    getTask: state => item => {
        return state.tasks.find(task => (task.id === item.id) )
    }
};
