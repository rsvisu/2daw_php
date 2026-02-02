<script setup>
import {ref} from "vue";

const minutos = ref(0);
const segundos = ref(0);
const milisegundos = ref(0);
const labelStartStop = ref("Start");
const running = ref(false);
const idInterval = ref(0);

const startStop = () => {
  // Si está ejecutándose, lo paramos
  if (running.value) {
    stop();
  }
  // Si no está ejecutándose, lo iniciamos
  else {
    start();
  }
}

const reset = () => {
  stop();
  [minutos, segundos, milisegundos].forEach((tiempo) => {
    tiempo.value = 0;
  })
}

const start = () => {
  // Establecemos el running a true, el texto a "start"
  // y empezamos un intervalo para incrementar el cronometro
  running.value = true;
  labelStartStop.value = "Stop";
  idInterval.value = setInterval(() => {
    if (milisegundos.value === 99) {
      milisegundos.value = 0;
      segundos.value++;
    } else {
      milisegundos.value++;
    }
  })
}

const stop = () => {
  // Establecemos el running a falso, el texto a "stop" y limpiamos el interval
  running.value = false;
  labelStartStop.value = "Start";
  clearInterval(idInterval.value);
}

const format = (input) => input.toString().padStart(2, "0");
</script>

<template>
  <div class="bg-base-200 flex min-h-screen items-center justify-center">
    <div class="card bg-base-100 w-96 p-8 shadow-xl">
      <div class="mb-6 flex items-end justify-center gap-4">
        <div class="bg-base-200 rounded-lg px-4 py-3 text-center">
          <div class="font-mono text-4xl">
            {{ format(minutos) }}
          </div>
          <div class="text-xs opacity-60">MIN</div>
        </div>

        <div class="pb-4 font-mono text-3xl">:</div>

        <div class="bg-base-200 rounded-lg px-4 py-3 text-center">
          <div class="font-mono text-4xl">
            {{ format(segundos) }}
          </div>
          <div class="text-xs opacity-60">SEG</div>
        </div>

        <div class="pb-4 font-mono text-3xl">:</div>

        <div class="bg-base-200 rounded-lg px-4 py-3 text-center">
          <div class="font-mono text-4xl">
            {{ format(milisegundos) }}
          </div>
          <div class="text-xs opacity-60">MS</div>
        </div>
      </div>

      <div class="flex justify-center gap-4">
        <button @click="startStop" class="btn btn-primary">
          {{ labelStartStop }}
        </button>
        <button @click="reset" class="btn btn-outline">
          Reset
        </button>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>