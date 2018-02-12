<template>
    <div>
        <h3>Counter</h3>
        <p class="text-center">
            {{ counter }}
        </p>
        <p class="text-center">
            <a href="#" @click="decrement()" class="btn btn-outline-info">-</a>
            <a href="#" @click="increment()" class="btn btn-outline-info">+</a>
        </p>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        counter: 0,
      }
    },
    methods: {
      increment() {
        this.counter++;
      },
      decrement() {
        this.counter--;
      }
    }
  }
</script>