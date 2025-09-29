import authService from "@/services/auth/auth.service";
import type { Credentials } from "@/types/auth/Credentials";
import { defineStore } from "pinia";

export const useUserStore = defineStore('user', {
    state: () => ({
        user: null
    }),

    actions: {
        async login(payload: Credentials): Promise<void> {
            await authService.login(payload);
        },

        async logout() {

        },

        async fetchUser() {
            if (!this.user) {
                this.user = await authService.fetchLoggedUser();
            }
            return this.user;
        }
    }
});