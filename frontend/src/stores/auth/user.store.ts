import authService from "@/services/auth/auth.service";
import type { Credentials } from "@/types/auth/Credentials";
import { defineStore } from "pinia";

export const useUserStore = defineStore('user', {
    state: () => ({
        user: null
    }),

    actions: {
        async login(payload: Credentials) {
            await authService.login(payload);
        }
    }
});