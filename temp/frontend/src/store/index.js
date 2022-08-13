import { axiosClient } from "@/lib/axios";
import { createStore } from "vuex";

export default createStore({
  state: {
    user: null,
    books: [],
    genres: [],
  },
  getters: {},
  mutations: {},
  actions: {
    login(context, payload) {
      return axiosClient.post("/login", payload).then((res) => {
        console.log(res);
      });
    },
  },
  modules: {},
});
