<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <form @submit.prevent="submit" class="bg-white p-6 rounded shadow-md w-96">
      <h1 class="text-2xl mb-4">Connexion</h1>

      <div class="mb-4">
        <label class="block mb-1">Email</label>
        <input v-model="form.email" type="email" class="border p-2 w-full rounded" required />
      </div>

      <div class="mb-4">
        <label class="block mb-1">Mot de passe</label>
        <input v-model="form.password" type="password" class="border p-2 w-full rounded" required />
      </div>

      <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded w-full">
        Se connecter
      </button>

      <!-- Lien vers la page Register -->
      <p class="mt-4 text-center text-sm">
        Pas de compte ?
        <a @click.prevent="goRegister" href="#" class="text-blue-500 hover:underline">
          S'inscrire
        </a>
      </p>
    </form>
  </div>
</template>

<script setup>
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const form = reactive({
  email: '',
  password: ''
});

function submit() {
  Inertia.post('/login', form);
}

 // Fonction pour naviguer vers la page Register
function goRegister() {
  Inertia.visit('/register');
}
</script>
