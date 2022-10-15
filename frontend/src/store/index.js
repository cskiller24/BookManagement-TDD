import { createStore } from "vuex";
import auth from "./modules/auth";
import errors from "./modules/errors";
import books from "./modules/books";
import genres from "./modules/genres";

const store = createStore({
  modules: {
    auth,
    errors,
    books,
    genres,
  },
});

export default store;
