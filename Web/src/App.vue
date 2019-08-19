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
  padding: 0 0px;
  color: #e9eef3;
  background-color: #24292e;
  line-height: 60px;
}
.el-main {
  background-color: #e9eef3;
  text-align: center;
  height: 87.3%;
  margin-top: 0%;
}
.el-form-item__label {
  text-align: right;
  vertical-align: middle;
  float: left;
  font-size: 2px;
  color: #909399;
  line-height: 40px;
  padding: 0 12px 0 0;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}
.form-header {
  font-size: 24px;
  font-family: "Helvetica Neue", Helvetica, "PingFang SC", "Hiragino Sans GB",
    "Microsoft YaHei", "\5FAE\8F6F\96C5\9ED1", Arial, sans-serif;
  color: #606266;
}
</style>
