<template>
  <div>
    <!-- <el-card class="box-card" style="width:50px;float:left;">
        <div v-for="o in 4" :key="o" class="text item">{{'列表内容 ' + o }}</div>
    </el-card>-->

    <div class="ui vertical icon menu border-0"></div>

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
  width: 74%;
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
  width: 350px;
}
.ui.vertical.menu {
  display: block;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  background: #fff;
  -webkit-box-shadow: 0 1px 2px 0 rgba(34, 36, 38, 0.15);
  box-shadow: 0 1px 2px 0 rgba(34, 36, 38, 0.15);
}
.ui.menu {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  margin: 1rem 0;
  font-family: Lato, Helvetica Neue, Arial, Helvetica, sans-serif;
  background: #fff;
  font-weight: 400;
  border: 1px solid rgba(34, 36, 38, 0.15);
  -webkit-box-shadow: 0 1px 2px 0 rgba(34, 36, 38, 0.15);
  box-shadow: 0 1px 2px 0 rgba(34, 36, 38, 0.15);
  border-radius: 0.28571429rem;
  min-height: 2.85714286em;
}
.ui.vertical.icon.menu {
  display: inline-block;
  width: auto;
}
.ui.menu:last-child {
  margin-bottom: 0;
}
.ui.menu:first-child {
  margin-top: 0;
}
.ui.menu {
  font-size: 1rem;
}
</style>