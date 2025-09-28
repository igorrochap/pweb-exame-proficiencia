import type { Credentials } from "@/types/auth/Credentials";
import http from "../http";

export default {
    async login(payload: Credentials): Promise<void> {
        await http.post('/login', payload);
    }
}