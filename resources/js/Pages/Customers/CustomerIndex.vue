<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Link, useForm} from "@inertiajs/vue3";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Modal from "@/Components/Modal.vue";
import {computed, ref} from "vue";

const props = defineProps({
  customers: Array
});

const form = useForm({});

const selectedToDelete = ref('');
const showConfirmDelete = ref(false);

const submitDelete = () => {
  form.delete(route('customer.delete', selectedToDelete.value), {
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
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Customers</h2>
                    <div class="flex fex-row gap-x-5">
                        <Link :href="route('customer.create')"><primary-button>Add Customer</primary-button></Link>
                    </div>
                </div>
            </template>
      <section class="relative overflow-x-auto shadow-sm sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 font-bold">
              Name
            </th>
            <th scope="col" class="px-6 py-3 font-bold">
              Email
            </th>
            <th scope="col" class="px-6 py-3 font-bold">
              Phone
            </th>
            <th scope="col" class="px-6 py-3 font-bold">
              Address
            </th>
            <th scope="col" class="px-6 py-3 font-bold">
              Action
            </th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(c, index) in customers" :key="c.id" class="odd:bg-white  even:bg-gray-50  border-b">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
              {{ c.name }}
            </th>
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
              {{ c.email }}
            </th>
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
              {{ c.phone }}
            </th>
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
              {{ c.address }}
            </th>
            <td class="px-6 py-4">
              <Link :href="route('customer.edit', c.id)" class="font-medium text-blue-600 hover:underline">Edit</Link> |
              <a href="javascript:void(0)" class="font-medium text-red-600 hover:underline" @click="confirmDelete(c)">Delete</a>
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
