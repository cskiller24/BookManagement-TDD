import axios from "axios";

export const axiosClient = axios.create({
  baseURL: "http://api.book-management.test:8000/api",
  withCredentials: true,
});

axiosClient.interceptors.request.use((config) => {
  config.headers["Accept"] = "application/json";
  return config;
});
