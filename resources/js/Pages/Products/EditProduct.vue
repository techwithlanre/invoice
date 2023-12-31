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
  productCategories: Array,
  product: Object
});

const productTypes = [
  {
    "id": "product",
    "name": "Product",
  },
  {
    "id": "service",
    "name": "Service",
  }
];

const form = useForm({
  name: props.product.name,
  product_category: props.product.product_category_id,
  product_type: props.product.type,
  price: props.product.price,
  code: props.product.code,
});

const submit = () => {
  form.put(route('product.update', props.product));
}

</script>
<template>
  <AuthenticatedLayout>
    <template #header>
      <div class="flex flex-row  justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Product: <strong>{{ product.name }}</strong></h2>
        <div class="flex fex-row gap-x-5">

        </div>
      </div>
    </template>
    <section class="mt-10 flex flex-row justify-center">
      <div class="max-w-xl w-full bg-white px-5 py-10 rounded-xl">
        <form @submit.prevent="submit">
          <div>
            <input-label for="name" value="Product Category" />
            <select-input class="w-full mt-1" :options="productCategories" autofocus v-model="form.product_category" required/>
            <input-error class="mt-2" :message="form.errors.product_category" />
          </div>
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
            <input-label for="code" value="Code" />
            <text-input
                id="code"
                type="text"
                class="mt-1 block w-full"
                v-model="form.code"
                required
                autocomplete="code"
            />
            <input-error class="mt-2" :message="form.errors.code" />
          </div>
          <div class="mt-4">
            <input-label for="name" value="Product Type" />
            <select-input class="w-full mt-1" :options='productTypes'  v-model="form.product_type" required/>
            <input-error class="mt-2" :message="form.errors.name" />
          </div>
          <div class="mt-4">
            <input-label for="price" value="Price" />
            <text-input
                id="price"
                type="number"
                class="mt-1 block w-full"
                v-model="form.price"
                required
                autocomplete="price"
            />
            <input-error class="mt-2" :message="form.errors.price" />
          </div>
          <primary-button class="mt-10 w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Update</primary-button>
        </form>
      </div>
    </section>
  </AuthenticatedLayout>
</template>