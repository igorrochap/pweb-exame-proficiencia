import axios from "axios";

const baseURL = import.meta.env.VITE_API_URL || "http://localhost:8000/api";

const http = axios.create({
    baseURL,
    withCredentials: true,
});

http.interceptors.response.use(
  (response: any) => response,
  (error: any) =>
    Promise.reject((error.response && error.response.data) || "Wrong Services")
);

export default http;