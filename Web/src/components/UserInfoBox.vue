<template>
  <div class="user-info-box">
    <div class="user-info-box-header">
      <span class>注册于：{{user.regirster_date}} ，最后活跃于：{{user.regirster_date}}</span>
    </div>
    <div class="user-info-box-body">
      <span class>注册于：{{user.regirster_date}} ，最后活跃于：{{user.regirster_date}}</span>
    </div>
  </div>
</template>

<script>
export default {
  name: "UserInfoBox",
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

<style>
.user-info-box {
  width: 100%;
  position: absolute;
}
.user-info-box-header {
  background-color: #fff;
  border-radius: 5px;
  width: 50%;
  position: absolute;
  right: 28%;
  color: #7b7979;
  font-weight: 100;
  font-size: 17px;
  padding: 12px;
}
</style>
