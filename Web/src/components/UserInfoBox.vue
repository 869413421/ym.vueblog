<template>
  <div class="user-info-box"></div>
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
  text-align: left;
  background-color: #fff;
  border: 1px solid #dcdfe6;
  border-radius: 11px;
  width: 50%;
  position: absolute;
  height: 200px;
  right: 28%;
}
</style>
