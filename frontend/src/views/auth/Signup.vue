<script setup lang="ts">
import { reactive, ref } from 'vue';
import router from '@/router';
import type { SignupInput } from '@/types/auth/Signup';
import { useAlertStore } from '@/stores/alert.store';
import authService from '@/services/auth/auth.service';

const alertStore = useAlertStore();

const signup = reactive<SignupInput>({
    name: '',
    email: '',
    password: '',
});

const passwordConfirmation = ref('');
const showPassword = ref(false);
const showConfirmPassword = ref(false);

async function submit() {
    if (signup.password !== passwordConfirmation.value) {
        await alertStore.info('As senhas não coincidem');
        return;
    }
    try {
        await authService.signup(signup);
        await alertStore.success('Cadastro realizado com sucesso! Faça login para continuar.');
        router.push('/login');
    } catch (error) {
        await alertStore.error('Erro ao cadastrar. Tente novamente.');
    }
}
</script>

<template>
    <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
            <v-col cols="12" sm="8" md="4">
                <v-card class="elevation-12">
                    <v-form @submit.prevent="submit">
                        <v-toolbar color="primary" dark flat>
                            <v-toolbar-title>Cadastro</v-toolbar-title>
                        </v-toolbar>
                        <v-card-text>
                            <v-text-field label="Nome" v-model="signup.name" prepend-icon="mdi-account" required />
                            <v-text-field label="Email" v-model="signup.email" prepend-icon="mdi-email" type="email"
                                required />
                            <v-text-field 
                                label="Senha" 
                                v-model="signup.password" 
                                prepend-icon="mdi-lock"
                                :type="showPassword ? 'text' : 'password'"
                                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                @click:append="showPassword = !showPassword" 
                                required />
                            <v-text-field 
                                label="Confirme a senha" 
                                v-model="passwordConfirmation"
                                prepend-icon="mdi-lock-check" 
                                :type="showConfirmPassword ? 'text' : 'password'"
                                :append-icon="showConfirmPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                @click:append="showConfirmPassword = !showConfirmPassword" 
                                required />
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn type="submit" color="primary">Cadastrar</v-btn>
                        </v-card-actions>
                    </v-form>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<style scoped>
.fill-height {
    min-height: 100vh;
}
</style>
