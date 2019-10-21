<template>
  <div>
    <div class="side-bar"></div>
    <div class="post-wrapper">
      <div class="title">
        <h1 v-html="topic.title"></h1>
        <div class="header">
          <span class="el-icon-s-flag"></span>
          <span v-if="topic.category">{{topic.category.title}} / {{topic.diff_create_date}} /</span>
          <i class="el-icon-view"></i>
          <span>{{topic.view_count}}</span> /
          <i class="el-icon-chat-dot-round"></i>
          <span>{{topic.comment_count}}</span> /
          <i class="el-icon-star-off"></i>
          <span>{{topic.collect_count}}</span> /
          <span>更新于{{topic.diff_update_date}}</span>
        </div>
      </div>
      <el-divider></el-divider>
      <div class="content" v-html="topic.content"></div>
    </div>
    <Comment></Comment>
  </div>
</template>
<script>
import Comment from "./Comment";
import { getTopic } from "../js/api/topic";
import { emoji } from "../utils/emoji";
export default {
  name: "TopicShow",
  data() {
    return {
      topic: [],
      reply: ""
    };
  },
  created() {
    //获取用户最新信息并分发到vuex
    if (this.$route.query.id) {
      getTopic(this.$route.query.id).then(res => {
        this.topic = res.data;
        this.topic.content = emoji(this.topic.content);
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
  width: 72%;
  background-color: #fff;
  border: 1px solid #dcdfe6;
  border-radius: 4px;
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
  width: 350px;
}
.side-bar {
  width: 40px;
  background-color: #fff;
  height: 200px;
  border: 1px solid #dcdfe6;
  border-radius: 4px;
  float: left;
  margin-left: 150px;
}
</style>