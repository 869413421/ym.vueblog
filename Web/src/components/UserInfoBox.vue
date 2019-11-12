<template>
  <div class="user-info-box">
    <div class="user-info-box-header">
      <div class>
        <span :title="user.created_at">注册于：{{user.regirster_date}}</span> ，
        <span :title="user.last_active_time">最后活跃于：{{user.diff_last_active_time}}</span>
      </div>
    </div>
    <div class="user-info-box-body">
      <dl>
        <dt class="dt-header">
          <div class="el-icon-user-solid"></div>个人信息
        </dt>
        <dt>
          <span>姓名：{{user.name}}</span>
        </dt>
        <dt>
          <span>邮箱：{{user.email}}</span>
        </dt>
        <dt>
          <span>城市：{{user.city}}</span>
        </dt>
        <dt>
          <span>公司：{{user.company}}</span>
        </dt>
        <dt>
          <span>头衔：{{user.title}}</span>
        </dt>
        <dt>
          <span>真实姓名：{{user.nickname}}</span>
        </dt>
      </dl>
    </div>

    <div class="user-info-box-content">
      <dl>
        <dt class="dt-header">
          <div class="el-icon-chat-line-square"></div>动态
        </dt>
        <dt v-for="item in action_list" :key="item.id">
          <div class="action-content" v-if="item.model">
            <el-image style="width: 100px; height: 100px;" :src="user.avatar"></el-image>
            <span>{{user.name}}</span>
            <span v-if="item.model.type==='good'">点赞了文章</span>
            <span v-if="item.model.type==='collect'">收藏了文章</span>
            <span v-if="item.model.type==='topic'">发布了文章</span>
            <span>{{item.diff_create_date}}</span>

            <div class="action-post">
              <el-image :src="item.model.avatar"></el-image>
              <div class="action-post-header">
                <span>{{item.model.title}}</span>
              </div>
              <div class="action-post-body">
                <span>{{item.model.excerpt}}</span>
              </div>
            </div>
          </div>
        </dt>
      </dl>
    </div>
  </div>
</template>

<script>
import { getAction } from "../js/api/action";
export default {
  name: "UserInfoBox",
  data() {
    return {
      user: null,
      action_list: null
    };
  },
  created() {
    this.user = this.$store.state.user;
    getAction().then(res => {
      this.action_list = res.data.data;
    });
  },
  methods: {
    load() {
      this.action_list = 2;
    }
  }
};
</script>

<style>
.user-info-box {
  width: 100%;
  position: unset;
}
.user-info-box-header {
  background-color: #fff;
  border-radius: 5px;
  width: 50%;
  position: absolute;
  right: 28%;
  color: #7b7979;
  font-weight: 100;
  font-size: 14px;
  padding: 12px;
}
.user-info-box-body {
  background-color: #fff;
  border-radius: 5px;
  width: 50%;
  position: absolute;
  right: 28%;
  color: #7b7979;
  font-weight: 100;
  font-size: 14px;
  padding: 12px;
  top: 17%;
  text-align: left;
}
dt {
  margin-left: 5%;
  margin-bottom: 0.6%;
}
.dt-header {
  font-size: 15px;
  font-weight: 600;
  margin-bottom: 2%;
}

.user-info-box-content {
  background-color: #fff;
  border-radius: 5px;
  width: 50%;
  position: absolute;
  right: 28%;
  color: #7b7979;
  font-weight: 100;
  font-size: 14px;
  padding: 12px;
  top: 83%;
  text-align: left;
}

.action-content {
}

.action-post {
  border-radius: 5px;
  width: 75%;
  height: 100px;
  border: 1px solid #e0dbdb;
  margin: 3% auto;
}

.action-post .el-image {
  border-radius: 4%;
  width: 20%;
  height: 98%;
  margin-left: 0.1%;
  margin-top: 1px;
  margin-bottom: 1px;
}

.action-post-header {
  display: inline-block;
  position: absolute;
}

.action-post-body {
  display: inline-block;
  position: absolute;
}
</style>
