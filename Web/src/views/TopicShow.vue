<template>
  <div>
    <div class="post-wrapper">
      <div class="title">
        <h1 v-html="form.title"></h1>
        <div class="header">
          <span class="el-icon-s-flag"></span>
          {{form.categorie_name}} / {{form.diff_create_date}} /
          <i class="el-icon-view"></i>
          <span>{{form.view_count}}</span> /
          <i class="el-icon-chat-dot-round"></i>
          <span>{{form.reply_count}}</span> /
          <i class="el-icon-star-off"></i>
          <span>{{form.collect_count}}</span> /
          <span>更新于{{form.diff_update_date}}</span>
        </div>
      </div>
      <el-divider></el-divider>
      <div class="content" v-html="form.content"></div>
    </div>
    <Comment></Comment>
  </div>
</template>
<script>
import Comment from "./Comment";
import { getTopic } from "../js/api/topic";
export default {
  name: "TopicShow",
  data() {
    return {
      form: {},
      reply: ""
    };
  },
  created() {
    //获取用户最新信息并分发到vuex
    if (this.$route.query.id) {
      this.form.id = this.$route.query.id;
      getTopic(this.form.id).then(res => {
        console.log(res.data.data);
        this.form = res.data.data;
      });
    }
  },
  components: {
    Comment
  }
};
</script>

<style>
.post-wrapper {
  margin: 0 auto;
  padding: 20px;
  height: 100%;
  width: 70%;
  background-color: #fff;
}
.title,
.content {
  width: 100%;
  color: black;
  margin-top: 10px;
}
.header {
  margin-bottom: 10px;
  color: #adb1af;
  font-size: 14px;
  width: 300px;
}
</style>