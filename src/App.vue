<template>
  <div id="app">
    <el-container>
      <router-view />
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
body,
#app,
.el-container,
#container {
  margin: 0%;
  font-family: "Helvetica Neue", Helvetica, "PingFang SC", "Hiragino Sans GB",
    "Microsoft YaHei", "微软雅黑", Arial, sans-serif;
  color: #e9eef3;
  height: 100%;
  width: 100%;
}

.el-header,
.el-footer {
  text-align: center;
  line-height: 60px;
  padding: 0 0px;
  color: #e9eef3;
  background-color: #24292e;
}
.el-main {
  background-color: #e9eef3;
  text-align: center;
  height: 80%;
  margin-top: 0%;
}
</style>
