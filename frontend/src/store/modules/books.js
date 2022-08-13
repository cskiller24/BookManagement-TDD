import { axiosClient } from "@/lib/axios";

export default {
  state: {
    books: null,
  },
  getters: {},
  mutations: {},
  actions: {
    async BOOKS_GET({ commit }, params) {
      commit("setIsLoading", true);
      await axiosClient
        .get("/books", { params: params })
        .then((res) => commit("BOOKS_ADD", res.data.data))
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
