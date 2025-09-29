<script setup lang="ts">
import router from '@/router';
import { useAlertStore } from '@/stores/alert.store';
import { useUserStore } from '@/stores/auth/user.store';
import type { Credentials } from '@/types/auth/Credentials';
import { reactive } from 'vue';

const userStore = useUserStore();
const alertStore = useAlertStore();

const credentials = reactive<Credentials>({
  email: '',
  password: ''
});

async function login() {
  try {
    await userStore.login(credentials);
    router.push('/');
  } catch (error) {
    await alertStore.info(error.response.data.message || 'Erro ao efetuar login');
  }
}
</script>

<template>
  <v-container class="fill-height" fluid>
    <v-row align="center" justify="center">
      <v-col cols="12" sm="8" md="4">
        <v-card class="elevation-12">
          <v-form @submit.prevent="login">
            <v-toolbar color="primary" dark flat>
              <v-toolbar-title>Login</v-toolbar-title>
            </v-toolbar>
            <v-card-text>
              <v-text-field label="Email" name="email" prepend-icon="mdi-account" type="text"
                v-model="credentials.email"></v-text-field>
              <v-text-field id="password" label="Senha" name="password" prepend-icon="mdi-lock" type="password"
                v-model="credentials.password"></v-text-field>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn type="submit" color="primary">Login</v-btn>
            </v-card-actions>
          </v-form>
          <v-card-text class="text-center pt-0">
            <span>Não possui uma conta? </span>
            <v-btn variant="text" color="primary" to="/signup" id="signup-link">Crie agora</v-btn>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<style scoped>
.fill-height {
  min-height: 100vh;
}

#signup-link {
  text-transform:none;
  min-width:unset;
  padding:0 4px;
}
</style>
