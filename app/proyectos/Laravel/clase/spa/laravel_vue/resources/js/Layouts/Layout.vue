<script setup>

</script>

<template>
  <body class="min-h-screen bg-base-200 flex flex-col">
  <!-- Nav -->
  <div class="bg-base-100">
    <div class="navbar shadow-sm max-w-7xl mx-auto px-5">
      <div class="flex-1">
        <a href="/" class="text-xl">daisyUI</a>
      </div>
      <div class="flex-none">
        <ul class="menu menu-horizontal px-1">
          <li><a>Link</a></li>
          <li>
            <details>
              <summary>Parent</summary>
              <ul class="bg-base-100 rounded-t-none p-2">
                <li><a>Link 1</a></li>
                <li><a>Link 2</a></li>
              </ul>
            </details>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Header -->
  <header>
    <div class="max-w-7xl mx-auto px-5 my-6">
      <h1 class="text-xl">Header</h1>
    </div>
  </header>

  <!-- Main -->
  <main class="flex-1">
    <div class="px-5 my-3 max-w-7xl mx-auto">
      <slot/>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer sm:footer-horizontal footer-center bg-base-300 text-base-content p-4">
    <aside>
      <p>Copyright © {{ new Date().getFullYear() }} - All right reserved by ACME Industries Ltd</p>
    </aside>
  </footer>
  </body>
</template>

<style scoped>

</style>