<template>
  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <!-- <img
        src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
        alt="Your Company"
        class="mx-auto h-10 w-auto"
      /> -->
      <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-black">
        Sign in to your account
      </h2>
    </div>
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <div v-if="errorMessage" class="text-black text-center bg-red-500 border border-red-500 mb-2">
        {{ errorMessage }}
      </div>
      <form action="#" method="POST" class="space-y-6" @submit.prevent="login">
        <div>
          <label for="email" class="block text-sm/6 font-medium text-black">Email address <span class="text-red-700">*</span></label>
          <div class="mt-2">
            <input
              v-model="email"
              id="email"
              type="email"
              name="email"
              autocomplete="email"
              class="block w-full rounded-md  px-3 py-1.5 text-base text-black outline-1 -outline-offset-1 outline-black placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
            />
          </div>
          <div v-if="errorMessages.email" class="text-red-500">{{ errorMessages.email[0] }}</div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm/6 font-medium text-black">Password <span class="text-red-700">*</span></label>
            <div class="text-sm">
              <a href="#" class="font-semibold text-indigo-400 hover:text-indigo-300"
                >Forgot password?</a
              >
            </div>
          </div>
          <div class="mt-2">
            <input
              v-model="password"
              id="password"
              type="password"
              name="password"
              autocomplete="current-password"
              class="block w-full rounded-md  px-3 py-1.5 text-base text-black outline-1 -outline-offset-1 outline-black placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
            />
          </div>
          <div v-if="errorMessages.password" class="text-red-500">
            {{ errorMessages.password[0] }}
          </div>
        </div>

        <div>
          <button
            type="submit"
            class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-black hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
          >
            Sign in
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
<script setup>
import { ref } from 'vue'
import api from '../../axios.js'
import {useRouter} from 'vue-router'

const email = ref('')
const password = ref('')
const errorMessage = ref('')
const errorMessages = ref({})
const router = useRouter()

const login = async () => {
  errorMessage.value = ''
  errorMessages.value = {}

  try {
    // Get CSRF cookie (using SAME api instance)
    await api.get('/sanctum/csrf-cookie')

    // Login request
    const response = await api.post('/login', {
      email: email.value,
      password: password.value,
    })
    console.log('Login successful', response)
    router.push(response.data.redirect)
  } catch (error) {
    if (error.response?.status == 401) {
      console.error('Login failed:', error.response?.data.message || error)
      errorMessage.value = error.response?.data.message
    } else {
      console.error('Login failed:', error.response.data.errors || error)
      errorMessages.value = error.response.data.errors
    }
  }
}
</script>
