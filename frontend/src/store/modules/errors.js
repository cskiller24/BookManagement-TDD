import { filter } from "lodash";
export default {
  state: {
    errors: [],
  },
  getters: {
    getError: (state) => (name) => {
      return filter(state.errors, (error) => error.name == name);
    },
    hasError: (state) => (name) => {
      return filter(state.errors, (error) => error.name == name).length != 0;
    },
  },
  mutations: {
    addError: (state, payload) => {
      state.errors.push({
        name: payload.name,
        message: payload.message,
        is_flashed: false,
      });
    },
    deleteError: (state, payload) => {
      state.errors = filter(
        state.errors,
        (error) => error.name !== payload.name
      );
    },
  },
  actions: {
    getErrors({ state }) {
      return state.errors;
    },
    getErrorByName({ state }, payload) {
      return filter(state.errors, (o) => o.name === payload);
    },
    flashErrorByName({ state }, payload) {
      let error = filter(state.errors, (o) => o.name === payload);
      state.errors = filter(state.errors, (o) => o.name !== payload);
      return error;
    },
    deleteErrors({ state }) {
      state.errors = [];
    },
  },
};
