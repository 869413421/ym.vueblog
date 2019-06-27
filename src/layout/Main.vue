<template>
  <div id="main">
    <Header></Header>

    <el-main>
      Main
      <router-view/>
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
.el-main {
  background-color: #e9eef3;
  color: #333;
  text-align: center;
  line-height: 100%;
}
#main{
  width:100%
}
</style>