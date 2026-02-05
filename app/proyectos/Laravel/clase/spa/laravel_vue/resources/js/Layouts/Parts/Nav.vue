<script setup>

import {Link, usePage} from "@inertiajs/vue3";
import {computed} from "vue";

const user = computed(() => usePage().props.auth.user);
</script>

<template>
  <div class="bg-base-100">
    <div class="navbar shadow-sm max-w-7xl mx-auto">
      <div class="flex-1 flex flex-row items-center gap-8 mx-5">
        <div>
          <Link href="/" class="text-xl">daisyUI</Link>
        </div>
        <div>
          <ul class="menu menu-horizontal px-1">
            <li>
              <Link href="#">Link</Link>
            </li>
          </ul>
        </div>
      </div>
      <div v-if="user" class="ml-3 gap-2 flex flex-none items-center">
        <ul class="menu menu-horizontal px-1">
          <li>
            <details>
              <summary>{{ user.name }}</summary>
              <ul class="bg-base-100 rounded-t-none p-2">
                <li>
                  <Link href="/logout" method="post">Logout</Link>
                </li>
              </ul>
            </details>
          </li>
        </ul>
      </div>
      <div v-else class="ml-3 gap-2 flex flex-none">
        <Link href="/login" class="btn btn-primary">Login</Link>
        <Link href="/register" class="btn btn-secondary">Sign Up</Link>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>