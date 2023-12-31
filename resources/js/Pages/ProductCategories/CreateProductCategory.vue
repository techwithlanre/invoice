<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import {Link, useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {hrefToUrl} from "@inertiajs/core";

const form = useForm({
  name: ""
})

const submit = () => {
  form.post(route('product.category.store'))
}

const back = () => history.back();

</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <div class="flex flex-row  justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Product Category</h2>
      </div>
    </template>
    <section class="mt-10 flex flex-row justify-center">
      <div class="max-w-xl w-full">
        <form @submit.prevent="submit">
          <div>
            <input-label for="name" value="Name" />
            <text-input
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                placeholder="Enter product category name"
                required
                autofocus
                autocomplete="name"
            />

            <input-error class="mt-2" :message="form.errors.name" />
          </div>
          <div class="mt-4">
            <primary-button class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Create</primary-button>
          </div>
        </form>
      </div>
    </section>
  </AuthenticatedLayout>
</template>

<style scoped>

</style>