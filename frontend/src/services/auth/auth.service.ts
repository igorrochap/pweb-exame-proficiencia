import type { Credentials } from "@/types/auth/Credentials";
import http from "../http";

export default {
    async login(payload: Credentials): Promise<void> {
        await http.post('/login', payload);
    },

    async fetchLoggedUser(): Promise<Response> {
        const { data } = await http.get('/auth/me');
        return data;
    },

    async logout(): Promise<void> { 
        await http.post('/logout');
    }
}