<template>
  <div class="mt-5 w-[75%] mx-auto">
    <form @submit.prevent="submitForm" enctype="multipart/form-data">
      <h3 class="mb-4 text-2xl font-semibold">
        <Bullet1 />
        Add New Job
      </h3>

      <p class="mb-4">Please provide the job / position details:</p>

      <!-- Job Code -->
      <div class="mb-4">
        <label for="job_code" class="block text-sm font-medium text-gray-700">
          Job Code <Mandatory />
        </label>
        <input
          v-model="jobCode"
          id="job_code"
          name="job_code"
          type="text"
          minlength="4"
          maxlength="15"
          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        />
      </div>

      <!-- Title -->
      <div class="mb-4">
        <label for="title" class="block text-sm font-medium text-gray-700">
          Title <Mandatory />
        </label>
        <input
          v-model="title"
          id="title"
          name="title"
          type="text"
          minlength="5"
          maxlength="250"
          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        />
      </div>

      <!-- Cities (City 1, City 2, City 3) -->
      <!-- <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="mb-4">
          <label for="city_1" class="block text-sm font-medium text-gray-700">
            City / Location #1 <Mandatory />
          </label>
          <div class="relative">
            <input
              v-model="city"
              id="city"
              name="city"
              type="text"
              minlength="3"
              maxlength="30"
              class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            />
            <span class="absolute left-3 top-3 text-gray-500">
              <i class="fa-solid fa-building"></i>
            </span>
          </div>
        </div>

        <div class="mb-4">
          <label for="city_2" class="block text-sm font-medium text-gray-700">
            City / Location #2
          </label>
          <div class="relative">
            <input
              v-model="city2"
              id="city_2"
              name="city_2"
              type="text"
              minlength="3"
              maxlength="30"
              class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            />
            <span class="absolute left-3 top-3 text-gray-500">
              <i class="fa-solid fa-building"></i>
            </span>
          </div>
        </div>

        <div class="mb-4">
          <label for="city_3" class="block text-sm font-medium text-gray-700">
            City / Location #3
          </label>
          <div class="relative">
            <input
              v-model="city3"
              id="city_3"
              name="city_3"
              type="text"
              minlength="3"
              maxlength="30"
              class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            />
            <span class="absolute left-3 top-3 text-gray-500">
              <i class="fa-solid fa-building"></i>
            </span>
          </div>
        </div>
      </div> -->

      <!-- Cities Section -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">
          Cities / Locations <Mandatory />
        </label>

        <div v-for="(city, index) in cities" :key="index" class="flex items-center space-x-2 mb-2">
          <div class="relative flex-1">
            <input
              v-model="cities[index]"
              type="text"
              minlength="3"
              maxlength="30"
              class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              :placeholder="'City / Location #' + (index + 1)"
            />
            <span class="absolute left-3 top-3 text-gray-500">
              <i class="fa-solid fa-building"></i>
            </span>
          </div>

          <!-- Remove button -->
          <button
            type="button"
            @click="removeCity(index)"
            class="px-2 py-1 bg-red-500 text-white rounded"
          >
            ✕
          </button>
        </div>

        <!-- Add City Button -->
        <button
          type="button"
          @click="addCity"
          class="mt-2 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700"
        >
          + Add City
        </button>
      </div>
      <!-- Publication Date -->
      <div class="mb-4">
        <label for="publication_date" class="block text-sm font-medium text-gray-700">
          Publication Date <Mandatory />
        </label>
        <div class="relative">
          <input
            v-model="publicationDate"
            id="publication_date"
            name="publication_date"
            type="text"
            readonly
            minlength="10"
            maxlength="10"
            class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          />
          <span class="absolute left-3 top-3 text-gray-500">
            <i class="fa-regular fa-calendar"></i>
          </span>
        </div>
      </div>

      <!-- Deadline -->
      <div class="mb-4">
        <label for="deadline" class="block text-sm font-medium text-gray-700">
          Deadline <Mandatory />
        </label>
        <div class="relative">
          <input
            v-model="deadline"
            id="deadline"
            name="deadline"
            type="text"
            readonly
            minlength="10"
            maxlength="10"
            class="mt-1 block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          />
          <span class="absolute left-3 top-3 text-gray-500">
            <i class="fa-regular fa-calendar"></i>
          </span>
        </div>
      </div>

      <!-- Age -->
      <div class="mb-4">
        <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
        <input
          v-model="age"
          id="age"
          name="age"
          type="number"
          minlength="2"
          maxlength="2"
          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        />
      </div>

      <!-- Job Type -->
      <div class="mb-4">
        <label for="job_type" class="block text-sm font-medium text-gray-700">
          Job Type <Mandatory />
        </label>
        <div class="flex space-x-4">
          <div v-for="profile in profiles" :key="profile.id" class="flex items-center">
            <input
              type="radio"
              :id="'job_type_' + profile.id"
              v-model="jobType"
              :value="profile.name"
              class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300"
            />
            <label :for="'job_type_' + profile.id" class="ml-2 text-sm font-medium text-gray-700">
              {{ profile.name }}
            </label>
          </div>
        </div>
      </div>

      <!-- Submit Button -->
      <div class="mt-4 flex space-x-3">
        <ButtonPrimary> <i class="fa-regular fa-square-plus mr-2"></i> Add New Job </ButtonPrimary>
        <ButtonBackAdmin />
      </div>
    </form>
  </div>
</template>

<script setup>
// import { ref } from 'vue';

// export default {
//   setup() {
//     const jobCode = ref('');
//     const title = ref('');
//     const city1 = ref('');
//     const city2 = ref('');
//     const city3 = ref('');
//     const publicationDate = ref('');
//     const deadline = ref('');
//     const age = ref('');
//     const jobType = ref('');
//     const profiles = ref([
//       { id: 1, name: 'Full-time' },
//       { id: 2, name: 'Part-time' },
//       { id: 3, name: 'Contract' },
//     ]);

//     const submitForm = () => {
//       // handle form submission logic here
//       console.log({
//         jobCode,
//         title,
//         city1,
//         city2,
//         city3,
//         publicationDate,
//         deadline,
//         age,
//         jobType,
//       });
//     };

//     return {
//       jobCode,
//       title,
//       city1,
//       city2,
//       city3,
//       publicationDate,
//       deadline,
//       age,
//       jobType,
//       profiles,
//       submitForm,
//     };
//   },
// };
</script>
