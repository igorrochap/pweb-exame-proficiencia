import type { Credentials } from "@/types/auth/Credentials";
import http from "../http";
import type { SignupInput } from "@/types/auth/Signup";

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
    },

    async signup(payload: SignupInput) {
        await http.post('/users', payload);
    }
}