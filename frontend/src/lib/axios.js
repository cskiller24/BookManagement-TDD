import addErrors from "@/helpers/addErrors";
import axios from "axios";

export const axiosClient = axios.create({
  baseURL: "http://api.book-management.test:8000/api",
  withCredentials: true,
});

axiosClient.interceptors.request.use((request) => {
  request.headers["Accept"] = "application/json";
  return request;
});
