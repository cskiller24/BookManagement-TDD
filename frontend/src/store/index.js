import { createStore } from "vuex";
import auth from "./modules/auth";
import errors from "./modules/errors";
import isLoading from "./modules/isLoading";
import books from "./modules/books";

const store = createStore({
  modules: {
    auth,
    errors,
    isLoading,
    books,
  },
});

export default store;
