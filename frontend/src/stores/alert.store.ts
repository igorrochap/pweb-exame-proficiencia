import { defineStore } from "pinia";
import Swal from "sweetalert2";

export const useAlertStore = defineStore("alert", {
    actions: {
        async success(message: string) {
            await Swal.fire({
                title: "Sucesso",
                icon: "success",
                text: message
            });
        },
        
        async error(message: string) {
            await Swal.fire({
                title: "Erro",
                icon: "error",
                text: message
            })
        },

        async info(message: string) {
            await Swal.fire({
                icon: "info",
                text: message
            })
        }
    }
})