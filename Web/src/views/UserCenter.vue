<template>
  <div class="user-center">
    <div class="user-sidebar">
      <el-card class="box-card">
        <div slot="header" class="clearfix">
          <span>我的创作</span>
        </div>
        <div class="boxcard-body">基本资料</div>
        <div class="boxcard-body">我的文章</div>
      </el-card>
    </div>
  </div>
</template>
<script>
export default {
  name: "UserCenter",
  data() {
    return {};
  }
};
</script>
<style >
.user-center {
  position: relative;
  width: 100%;
}

.user-sidebar {
  text-align: left;
  background-color: #fff;
  border: 1px solid #dcdfe6;
  border-radius: 11px;
  width: 15%;
  position: absolute;
  left: 7%;
}

.user-sidebar .el-card__header {
  font-size: 1rem !important;
  font-weight: 700;
  color: #a5a5a5 !important;
}

.boxcard-body {
  border-bottom: 1px solid #EBEEF5;
  padding: 10px;
  padding: 10px 0px 10px;
}
</style>