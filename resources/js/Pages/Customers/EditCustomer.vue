<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Link, useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import SelectInput from "@/Components/SelectInput.vue";

const props = defineProps({
  customer: Object
});

const form = useForm({
  name: props.customer.name,
  email: props.customer.email,
  phone: props.customer.phone,
  address: props.customer.address
});

const submit = () => {
  form.put(route('customer.update', props.customer));
}

</script>
<template>
  <AuthenticatedLayout>
    <template #header>
      <div class="flex flex-row  justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Customer: <strong>{{ customer.name }}</strong></h2>
        <div class="flex fex-row gap-x-5">

        </div>
      </div>
    </template>
    <section class="mt-10 flex flex-row justify-center">
      <div class="max-w-xl w-full bg-white px-5 py-10 rounded-xl">
        <form @submit.prevent="submit">
          <div class="mt-4">
            <input-label for="name" value="Name" />
            <text-input
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                required
                autocomplete="name"
            />
            <input-error class="mt-2" :message="form.errors.name" />
          </div>
          <div class="mt-4">
            <input-label for="email" value="Code" />
            <text-input
                id="email"
                type="text"
                class="mt-1 block w-full"
                v-model="form.email"
                required
                autocomplete="email"
            />
            <input-error class="mt-2" :message="form.errors.email" />
          </div>
          <div class="mt-4">
            <input-label for="phone" value="Phone" />
            <text-input
                id="phone"
                type="number"
                class="mt-1 block w-full"
                v-model="form.phone"
                required
                autocomplete="phone"
            />
            <input-error class="mt-2" :message="form.errors.phone" />
          </div>
          <div class="mt-4">
            <input-label for="address" value="Address" />
            <text-input
                id="address"
                type="text"
                class="mt-1 block w-full"
                v-model="form.address"
                required
                autocomplete="address"
            />
            <input-error class="mt-2" :message="form.errors.address" />
          </div>
          <primary-button class="mt-10 w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Update</primary-button>
        </form>
      </div>
    </section>
  </AuthenticatedLayout>
</template>