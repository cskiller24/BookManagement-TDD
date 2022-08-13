import { axiosClient } from "@/lib/axios.js";
import status from "@/helpers/status";
import router from "@/router";
import addErrors from "@/helpers/addErrors";

export default {
  state: {
    user: null,
  },
  getters: {
    getIsLoggedIn: (state) => {
      return state.user !== null;
    },
    getIsVerified: (state) => {
      return state.user?.is_verified;
    },
  },
  mutations: {
    setUser: (state, payload) => {
      state.user = payload;
    },
  },
  actions: {
    async AUTH_REGISTER({ commit }, payload) {
      commit("toggleIsLoading", true);

      await axiosClient
        .post("/register", payload)
        .then((res) => {
          if (res.status === status.HTTP_CREATED) {
            commit("setUser", res.data.data);

            res.data.data.is_verified === true
              ? router.push({ name: "Home" })
              : router.push({ name: "EmailVerify" });
          }
        })
        .catch((err) => {
          if (err.response.status === status.HTTP_UNPROCESSABLE_ENTITY) {
            addErrors(payload.pageName, err.response.data.errors);
          }
        });
      commit("toggleIsLoading", false);
    },
    async AUTH_LOGIN({ commit, state }, payload) {
      commit("setIsLoading", true);
      await axiosClient
        .post("login", { email: payload.email, password: payload.password })
        .then((res) => {
          if (res.status === status.HTTP_OK) {
            commit("setUser", res.data.data);

            res.data.data.is_verified === true
              ? router.push({ name: "Home" })
              : router.push({ name: "EmailVerify" });
          }
        })
        .catch((err) => {
          if (err.response.status === status.HTTP_UNPROCESSABLE_ENTITY) {
            addErrors(payload.pageName, err.response.data.errors);
          }
        });
      commit("setIsLoading", false);
    },
    async AUTH_RESEND_EMAIL(store, payload) {
      await axiosClient.post("/email/verify/resend").then((res) => {
        if (res.status === 200) {
        }
      });
    },
  },
};

function resolveAfter2Seconds() {
  return new Promise((resolve) => {
    setTimeout(() => {
      resolve("resolved");
    }, 2000);
  });
}
