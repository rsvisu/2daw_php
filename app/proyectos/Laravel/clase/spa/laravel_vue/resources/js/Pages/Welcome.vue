<script setup>

import Layout from "@/Layouts/Layout.vue";
import {computed} from "vue";
import {Link, usePage} from "@inertiajs/vue3";
import Card from "@/Components/Card.vue";

const user = computed(() => usePage().props.auth.user);
</script>

<template>
  <Layout>
    <template #header>
      Dashboard
    </template>

    <div v-if="user" class="grid col-3 gap-6">
      <card>
        <template #title>
          Cronometero
        </template>
        Accede al cronometro
        <template #cta>
          <Link href="cronometro" class="btn btn-primary">Ver</Link>
        </template>
      </card>
    </div>
    <div v-else class="hero bg-base-200 flex-1 flex justify-center items-center min-h-[70vh]">
      <div class="hero-content text-center">
        <div class="max-w-md">
          <h1 class="text-5xl font-bold">Hello there</h1>
          <p class="py-6">
            Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem
            quasi. In deleniti eaque aut repudiandae et a id nisi.
          </p>
          <button class="btn btn-primary">Get Started</button>
        </div>
      </div>
    </div>
  </Layout>
</template>

<style scoped>

</style>