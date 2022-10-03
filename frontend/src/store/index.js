import { createStore } from "vuex";
import auth from "./modules/auth";
import errors from "./modules/errors";
import books from "./modules/books";

const store = createStore({
  modules: {
    auth,
    errors,
    books,
  },
});

export default store;
