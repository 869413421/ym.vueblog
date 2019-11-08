<template>
  <div class="user-center">
    <div class="user-sidebar">
      <el-card class="box-card">
        <div slot="header" class="clearfix">
          <span>我的创作</span>
        </div>
        <div class="boxcard-body">
          <router-link :to="{name: 'UserInfoBox'}">基础信息</router-link>
        </div>
        <div class="boxcard-body">我的文章</div>
        <div class="boxcard-body">我的动态</div>
        <div class="boxcard-body">我的收藏</div>
        <div class="boxcard-body">我的点赞</div>
      </el-card>
    </div>

    <router-view></router-view>

    <div class="user-info">
      <el-card class="user_box" v-if="user">
        <el-image style="width: 100%; height: 100%;" :src="user.avatar"></el-image>
        <div style="padding: 14px;">
          <div class="bottom clearfix">
            <!-- <time class="time" v-html="user.created_at"></time>
            <br />
            <el-button type="text" class="button">关注</el-button>-->
            <div class="user-index-wraper">
              <div class="user-index-item">
                文章
                <br />
                {{user.topic_count}}
              </div>
              <div class="user-index-item">
                粉丝
                <br />
                {{user.fans_count}}
              </div>
              <div class="user-index-item">
                喜欢
                <br />
                {{user.good_count}}
              </div>
            </div>
            <span id="user_name" v-html="user.name"></span>
            <br><span v-html="user.regirster_date"></span>
          </div>
        </div>
      </el-card>
    </div>
  </div>
</template>
<script>
export default {
  name: "UserCenter",
  data() {
    return {
      user: null
    };
  },
  created() {
    this.user = this.$store.state.user;
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
  width: 10%;
  position: absolute;
  left: 7%;
}

.user-sidebar .el-card__header {
  font-size: 1rem !important;
  font-weight: 700;
  color: #a5a5a5 !important;
}

.boxcard-body {
  border-bottom: 1px solid #ebeef5;
  padding: 10px;
  padding: 10px 0px 10px;
  color: #7b7979;
  font-weight: 100;
  font-size: 14px;
}
.user-info {
  position: relative;
  position: relative;
  width: 15%;
  right: -76%;
}
#user_name {
  font-size: 1rem !important;
  font-weight: 700;
  color: #a5a5a5 !important;
}
.user-index-wraper {
  margin: 20px 0px 20px 0px;
  padding: 10px;
  border-bottom: 1px solid #ebeef5;
  border-top: 1px solid #ebeef5;
  color: #7b7979;
  font-size: 14px;
  font-weight: 400;
}
.user-index-item {
  display: inline-block;
  padding: 3.8px;
}
</style>