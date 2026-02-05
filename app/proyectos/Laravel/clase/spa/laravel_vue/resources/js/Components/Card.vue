<script setup>

</script>

<template>
  <div class="card w-96 bg-base-100 card-md shadow-sm">
    <div class="card-body">
      <h2 class="card-title"><slot name="title"/></h2>
      <p><slot/></p>
      <div class="justify-end card-actions">
        <slot name="cta"/>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>