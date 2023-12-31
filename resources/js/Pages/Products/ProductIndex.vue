<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Link, useForm} from "@inertiajs/vue3";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Modal from "@/Components/Modal.vue";
import {computed, ref} from "vue";

const props = defineProps({
  products: Array
});

const form = useForm({});

const selectedToDelete = ref('');
const showConfirmDelete = ref(false);

const submitDelete = () => {
  form.delete(route('product.delete', selectedToDelete.value), {
    onSuccess: showConfirmDelete.value = false
  })
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
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products</h2>
                    <div class="flex fex-row gap-x-5">
                        <Link :href="route('product.create')"><primary-button>Add Product</primary-button></Link>
                    </div>
                </div>
            </template>
      <section class="relative overflow-x-auto shadow-sm sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 font-bold">
              Code
            </th>
            <th scope="col" class="px-6 py-3 font-bold">
              Product name
            </th>
            <th scope="col" class="px-6 py-3 font-bold">
              Product type
            </th>
            <th scope="col" class="px-6 py-3 font-bold">
              Product category
            </th>
            <th scope="col" class="px-6 py-3 font-bold">
              Price
            </th>
            <th scope="col" class="px-6 py-3 font-bold">
              Action
            </th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(p, index) in products" :key="p.id" class="odd:bg-white  even:bg-gray-50  border-b">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
              {{ p.code }}
            </th>
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
              {{ p.name }}
            </th>
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
              <span class="px-3 py-0.5 text-center rounded-full bg-opacity-20 text-xs" :class="p.type === 'product' ? 'bg-primary text-primary-dark' : 'bg-orange-500 text-orange-700'" >{{ p.type }}</span>
            </th>
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
              {{ p.category }}
            </th>
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
              {{ p.price }}
            </th>
            <td class="px-6 py-4">
              <Link :href="route('product.edit', p.id)" class="font-medium text-blue-600 hover:underline">Edit</Link> |
              <a href="javascript:void(0)" class="font-medium text-red-600 hover:underline" @click="confirmDelete(p)">Delete</a>
            </td>
          </tr>
          </tbody>
        </table>
      </section>
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
