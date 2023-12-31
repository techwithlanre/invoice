<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
  productCategory: Object
})

const form = useForm({
  name: props.productCategory.name
})

const submit = () => {
  form.put(route('product.category.update', props.productCategory));
}

</script>

<template>
  <authenticated-layout>
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
            <primary-button class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Update</primary-button>
          </div>
        </form>
      </div>
    </section>
  </authenticated-layout>
</template>

<style scoped>

</style>