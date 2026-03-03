<template>
  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <!-- <img
        src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
        alt="Your Company"
        class="mx-auto h-10 w-auto"
      /> -->
      <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-black">
        Sign up to your account
      </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" @submit.prevent="register">
        <!-- Name Fields -->
        <div class="flex gap-2 justify-start">
          <!-- First Name -->
          <div class="flex flex-col w-full">
            <label for="first_name" class="block text-sm/6 font-medium text-black">First Name <span
                class="text-red-700">*</span></label>
            <div class="mt-2">
              <input v-model="firstName" id="first_name" type="text" name="first_name" autocomplete="given-name"
                class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-black outline-1 -outline-offset-1 outline-black placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
            </div>
            <div v-if="errorMessages.first_name" class="text-red-500">
              {{ errorMessages.first_name[0] }}
            </div>
          </div>

          <!-- Last Name -->
          <div class="flex flex-col w-full">
            <label for="last_name" class="block text-sm/6 font-medium text-black">Last Name <span
                class="text-red-700">*</span></label>
            <div class="mt-2">
              <input v-model="lastName" id="last_name" type="text" name="last_name" autocomplete="family-name"
                class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-black outline-1 -outline-offset-1 outline-black placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
            </div>
            <div v-if="errorMessages.last_name" class="text-red-500">
              {{ errorMessages.last_name[0] }}
            </div>
          </div>
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm/6 font-medium text-black">Email address <span
              class="text-red-700">*</span></label>
          <div class="mt-2">
            <input v-model="email" id="email" type="email" name="email" autocomplete="email"
              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-black outline-1 -outline-offset-1 outline-black placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
          </div>
          <div v-if="errorMessages.email" class="text-red-500">{{ errorMessages.email[0] }}</div>
        </div>

        <!-- CNIC -->
        <div>
          <label for="cnic" class="block text-sm/6 font-medium text-black">CNIC <span
              class="text-red-700">*</span></label>
          <div class="mt-2">
            <input v-model="cnic" id="cnic" type="text" name="cnic" autocomplete="off"
              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-black outline-1 -outline-offset-1 outline-black placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
          </div>
          <div v-if="errorMessages.cnic" class="text-red-500">{{ errorMessages.cnic[0] }}</div>
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm/6 font-medium text-black">Password <span
              class="text-red-700">*</span></label>
          <div class="mt-2">
            <input v-model="password" id="password" type="password" name="password" autocomplete="new-password" placeholder="Ab@123#4"
              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-black outline-1 -outline-offset-1 outline-black placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
          </div>
          <div v-if="errorMessages.password" class="text-red-500">
            {{ errorMessages.password[0] }}
          </div>
        </div>

        <!-- Confirm Password -->
        <div>
          <label for="password_confirmation" class="block text-sm/6 font-medium text-black">Confirm Password <span
              class="text-red-700">*</span></label>
          <div class="mt-2">
            <input v-model="passwordConfirmed" id="password_confirmation" type="password" name="password_confirmation"
              autocomplete="new-password"
              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-black outline-1 -outline-offset-1 outline-black placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
          </div>
          <div v-if="errorMessages.password_confirmation" class="text-red-500">
            {{ errorMessages.password_confirmation[0] }}
          </div>
        </div>

        <!-- Gender -->
        <div>
          <label for="gender" class="block text-sm/6 font-medium text-black">Gender <span
              class="text-red-700">*</span></label>
          <div class="mt-2">
            <select v-model="gender" id="gender" name="gender"
              class="w-full rounded-md bg-white py-1.5 px-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-black focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
              <option value="">Select Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div v-if="errorMessages.gender" class="text-red-500">{{ errorMessages.gender[0] }}</div>
        </div>

        <!-- Submit -->
        <div>
          <button type="submit"
            class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-black hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
            Sign up
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import api from '../../axios.js'
import { useRouter } from 'vue-router'
const isLoading = ref(false)
const firstName = ref('')
const lastName = ref('')
const email = ref('')
const password = ref('')
const passwordConfirmed = ref('')
const cnic = ref('')
const gender = ref('')
const errorMessages = ref({})
const router = useRouter()

const register = async () => {
  errorMessages.value = {}
  isLoading.value = true
  try {
    // CSRF cookie
    await api.get('/sanctum/csrf-cookie')

    // Register
    const response = await api.post('/register', {
      first_name: firstName.value,
      last_name: lastName.value,
      email: email.value,
      cnic: cnic.value,
      gender: gender.value,
      password: password.value,
      password_confirmation: passwordConfirmed.value,
    })

    console.log('Registration successful', response)
    router.push(response.data.redirect)
  } catch (error) {
    if (error.response?.data?.errors) {
      errorMessages.value = error.response.data.errors
    } else {
      console.error('Unexpected error:', error.response.data)
    }
  }
}
</script>
