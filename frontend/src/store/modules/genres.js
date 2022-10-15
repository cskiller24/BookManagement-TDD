import status from "@/helpers/status";
import { axiosClient } from "@/lib/axios";
import { filter } from "lodash";

export default {
  state: {
    genres: [],
  },
  getters: {
    getGenres: (state) => {
      return state.genres;
    },
    getGenre:
      (state) =>
      ({ id }) => {
        filter(state.genres, (genre) => id === genre.id);
      },
  },
  mutations: {
    setGenre: (state, payload) => {
      state.genres = payload;
    },
  },
  actions: {
    async GENRES_GET({ commit }, payload) {
      axiosClient
        .get("genres", payload)
        .then((res) => {
          if (res.status === status.HTTP_OK) {
            commit("setGenre", res.data.data);
          }
        })
        .then(() => {});
    },
  },
};
