<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Link, useForm} from "@inertiajs/vue3";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref} from "vue";
import Modal from "@/Components/Modal.vue";

const props = defineProps({
  productCategories: Array
});

const form = useForm({

})

const selectedToDelete = ref('');
const showConfirmDelete = ref(false);

const submitDelete = () => {
  form.delete(route('product.category.delete', selectedToDelete.value))
  showConfirmDelete.value = false;
}

const confirmDelete = (selected) => {
  selectedToDelete.value = selected;
  showConfirmDelete.value = true
}

</script>

<template>
    <AuthenticatedLayout>
      <template #header>
        <div class="flex flex-row  justify-between items-center">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">Product Categories</h2>
          <div class="flex fex-row gap-x-5">
            <Link :href="route('product.category.create')"><primary-button>Add Product Category</primary-button></Link>
          </div>
        </div>
      </template>
      <div class="relative overflow-x-auto shadow-sm sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 font-bold">
              #
            </th>
            <th scope="col" class="px-6 py-3 font-bold">
              Category name
            </th>
            <th scope="col" class="px-6 py-3 font-bold">
              Action
            </th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(pc, index) in productCategories" :key="pc.id" class="odd:bg-white  even:bg-gray-50  border-b">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
              {{ index + 1 }}
            </th>
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
              {{ pc.name }}
            </th>
            <td class="px-6 py-4">
              <Link :href="route('product.category.edit', pc.id)" class="font-medium text-blue-600 hover:underline">Edit</Link> |
              <a href="javascript:void(0)" class="font-medium text-red-600 hover:underline" @click="confirmDelete(pc)">Delete</a>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
      <Modal :show="showConfirmDelete">
        <div class="">
          <div class="p-5 text-center">
            <h1 class="font-bold text-2xl">Are you sure you want to delete this?</h1>
            <div class="flex flex-row space-x-8 justify-center mt-10">
              <primary-button @click="submitDelete">Yes, delete</primary-button>
              <secondary-button @click="showConfirmDelete = false">Cancel</secondary-button>
            </div>
          </div>
        </div>
      </Modal>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>