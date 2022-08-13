import axios from "axios";

export const axiosClient = axios.create({
  baseURL: "http://app.bookmanagement.test",
  withCredentials: true,
});
