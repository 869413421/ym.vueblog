<template>
  <div id="app">
    <el-container>
      <router-view/>
    </el-container>
  </div>
</template>

<script>
export default {
  name: "App"
};
</script>

<style>
html,
body {
  margin: 0%;
  font-family: "Helvetica Neue", Helvetica, "PingFang SC", "Hiragino Sans GB",
    "Microsoft YaHei", "微软雅黑", Arial, sans-serif;
}
.el-header,
.el-footer {
  color: #333;
  text-align: center;
  line-height: 60px;
  padding: 0 0px;
}
</style>
