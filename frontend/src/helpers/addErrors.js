import store from "@/store";
import { forIn } from "lodash";

export default function (name, errors) {
  forIn(errors, (key, value) => {
    store.commit("addError", { name: name, message: key[0] });
  });
}
