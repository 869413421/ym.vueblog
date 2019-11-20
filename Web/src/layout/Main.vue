<template>
  <div id="container">
    <Header></Header>

    <el-main id="main">
      <router-view />
    </el-main>

    <Footer></Footer>
  </div>
</template>

<script>
import Header from "./Header";
import Footer from "./Footer";
export default {
  name: "Main",
  components: {
    Header,
    Footer
  }
};
</script>
<style>
#main {
  width: 100%;
  height: 100%;
}
</style>