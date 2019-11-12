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
  </div>
</template>

<script>
import { getAction } from "../js/api/action";
export default {
  name: "UserInfoBox",
  data() {
    return {
      user: null
    };
  },
  created() {
    this.user = this.$store.state.user;
    getAction().then(res => {
      console.log(res.data);
    });
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
</style>
