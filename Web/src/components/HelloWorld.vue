<template>
  <div class="hello">
    {{$store.state.count}}
    <br>
    <button @click="handleAdd(5)">增加</button>
    <button @click="handleReduce(10)">减少</button>
    <button @click="handleAddAction(5)">异步增加</button>
    <button @click="handleReduceAction(10)">异步减少</button>
  </div>
</template>

<script>
export default {
  name: "HelloWorld",
  data() {
    return {
      msg: "Welcome to Your Vue.js App"
    };
  },
  methods: {
    handleAdd(n) {
      this.$store.commit("mutationsAddNum", n);
    },
    handleReduce(n) {
      this.$store.commit("mutationsReduceNum", n);
    },
    handleAddAction(n) {
      this.$store.dispatch("actionAddNum", n);
    },
    handleReduceAction(n){
      this.$store.dispatch('actionReduceNum',n);
    }
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1,
h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
