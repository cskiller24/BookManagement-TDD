import addErrors from "@/helpers/addErrors";
import status from "@/helpers/status";
import { axiosClient } from "@/lib/axios";

export default {
  state: {
    books: [],
    book: [],
  },
  getters: {
    getIsEmptyBooks: (state) => {
      return state.books === null || state.books === [];
    },
    getBooks: (state) => {
      return state.books;
    },
    getBook: (state) => {
      return state.book;
    },
  },
  mutations: {
    setBooks: (state, payload) => {
      state.books = payload;
    },
    setBook: (state, payload) => {
      state.book = payload;
    },
    addBook: (state, payload) => {
      state.books.push(payload);
    },
    updateBook: (state, payload) => {
      books = state.books.map((book) => {
        book.id === payload.id ? { ...book, payload } : book;
      });

      state.books = books;
    },
    deleteBook: (state, payload) => {
      books = state.books.filter((book) => book.id !== payload.id);

      state.books = books;
    },
  },
  actions: {
    async BOOKS_GET({ commit }, payload) {
      await axiosClient
        .get("/books", payload)
        .then((res) => {
          commit("setBooks", res.data.data);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    async BOOK_GET({ commit }, payload) {
      await axiosClient
        .get(`/books/${payload.id}`)
        .then((res) => commit("setBook", res.data.data))
        .catch((err) => {
          console.log(err);
        });
    },
    async BOOK_CREATE({ commit }, payload) {
      await axiosClient
        .post("/books", payload)
        .then((res) => commit("addBook", res.data.data))
        .catch((err) => {
          if (err.response.status === status.HTTP_UNPROCESSABLE_ENTITY) {
            addErrors(payload.pageName, err.response.data.errors);
          }
        });
    },
  },
};
