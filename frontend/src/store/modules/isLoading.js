export default {
  state: {
    isLoading: false,
  },
  getters: {
    getIsLoading: (state) => {
      return state.isLoading;
    },
  },
  mutations: {
    toggleIsLoading: (state, config = null) => {
      config !== null && typeof config == "boolean"
        ? (state.isLoading = config)
        : (state.isLoading = !state.isLoading);
    },
    setIsLoading: (state, set = null) => {
      set !== null && typeof set == "boolean"
        ? (state.isLoading = set)
        : (state.isLoading = !state.isLoading);
    },
  },
  dispatch: {
    TOOGLE_IS_LOADING({ commit }) {
      commit("toggleIsLoading");
    },
  },
};
