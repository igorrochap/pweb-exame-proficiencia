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
        },

        async confirm(message: string): Promise<boolean> {
            const confirmation = await Swal.fire({
                title: "Confirmação",
                icon: "question",
                text: message,
                showCancelButton: true,
                confirmButtonText: "Sim",
                cancelButtonText: "Não"
            });
            return confirmation.isConfirmed;
        }
    }
})