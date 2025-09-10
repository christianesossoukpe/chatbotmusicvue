<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <form @submit.prevent="submit" class="bg-white p-6 rounded shadow-md w-96">
      <h1 class="text-2xl mb-4">S'inscrire</h1>

      <div class="mb-4">
        <label class="block mb-1">Nom</label>
        <input v-model="form.name" type="text" class="border p-2 w-full rounded" required />
      </div>

      <div class="mb-4">
        <label class="block mb-1">Email</label>
        <input v-model="form.email" type="email" class="border p-2 w-full rounded" required />
      </div>

      <div class="mb-4">
        <label class="block mb-1">Mot de passe</label>
        <input v-model="form.password" type="password" class="border p-2 w-full rounded" required />
      </div>

      <div class="mb-4">
        <label class="block mb-1">Confirmer le mot de passe</label>
        <input v-model="form.password_confirmation" type="password" class="border p-2 w-full rounded" required />
      </div>

      <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded w-full">
        S'inscrire
      </button>

       <!-- Lien vers la page Register -->
      <p class="mt-4 text-center text-sm">
       Vous avez de compte ?
        <a @click.prevent="goLogin" href="#" class="text-blue-500 hover:underline">
          Se connecter
        </a>
      </p>
    </form>
  </div>
</template>

<script setup>
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const form = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
});

function submit() {
  Inertia.post('/register', form);
}
function goLogin() {
  Inertia.visit('/login');
}
</script>
