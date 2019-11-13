<template>
  <div class="topic-wrapper">
    <div class="content_wraper">
      <div class="side-bar" v-if="topic.meta">
        <a href="javascript:void(0)" :title="topic.meta.give_good?'取消赞':'点赞'" @click="changGood()">
          <div class="side-icon">
            <el-image
              class="icon-img"
              src="./static/icon/thumb_dowm.ico"
              v-if="topic.meta.give_good"
            ></el-image>
            <el-image class="icon-img" src="./static/icon/thumb_up.ico" v-else></el-image>
          </div>
        </a>
        <a
          href="javascript:void(0)"
          :title="topic.meta.give_collect?'取消收藏':'收藏'"
          @click="changCollection()"
        >
          <div class="side-icon">
            <el-image
              class="icon-img"
              src="./static/icon/cancel.ico"
              v-if="topic.meta.give_collect"
            ></el-image>
            <el-image class="icon-img" src="./static/icon/mark.ico" v-else></el-image>
          </div>
        </a>
        <div class="side-icon">
          <el-image class="icon-img" src="./static/icon/reply.ico"></el-image>
        </div>
      </div>

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

      <div
        class="user_button"
        v-if="this.$store.state.user&&topic.user&&topic.user.id===this.$store.state.user.id"
      >
        <el-button
          type="primary"
          icon="el-icon-edit"
          size="small"
          circle
          @click="changRoute('topic_edit?id='+topic.id)"
        ></el-button>
        <el-button type="danger" icon="el-icon-delete" size="small" circle @click="destoryTopic"></el-button>
      </div>

      <div class="comment_edit">
        <reply></reply>
      </div>

      <Comment></Comment>
      <el-card class="user_box" v-if="topic.user">
        <el-image style="width: 200px; height: 200px" :src="topic.user.avatar"></el-image>
        <div style="padding: 14px;">
          <span v-html="topic.user.name"></span>
          <div class="bottom clearfix">
            <time class="time" v-html="topic.created_at"></time>
            <br />
            <el-button type="text" class="button">关注</el-button>
          </div>
        </div>
      </el-card>
    </div>
  </div>
</template>
<script>
import Comment from "./Comment";
import reply from "../components/reply";
import { getTopic } from "../js/api/topic";
import { deleteTopic } from "../js/api/topic";
import { emoji } from "../utils/emoji";
import { createGood } from "../js/api/good";
import { deleteGood } from "../js/api/good";
import { createCollection } from "../js/api/collection";
import { deleteCollection } from "../js/api/collection";
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
  methods: {
    changGood(type) {
      if (!this.topic.meta.give_good) {
        createGood(this.$route.query.id).then(res => {
          this.$message({
            message: "点赞成功",
            type: "success"
          });
          this.topic.good_count += 1;
          this.topic.meta.give_good = !this.topic.meta.give_good;
        });
      } else {
        deleteGood(this.$route.query.id).then(res => {
          this.$message({
            message: "取消成功",
            type: "success"
          });
          this.topic.good_count -= 1;
          this.topic.meta.give_good = !this.topic.meta.give_good;
        });
      }
    },
    changCollection(type) {
      if (!this.topic.meta.give_collect) {
        createCollection(this.$route.query.id).then(res => {
          this.$message({
            message: "收藏成功",
            type: "success"
          });
          this.topic.collect_count += 1;
          this.topic.meta.give_collect = !this.topic.meta.give_collect;
        });
      } else {
        deleteCollection(this.$route.query.id).then(res => {
          this.$message({
            message: "取消成功",
            type: "success"
          });
          this.topic.collect_count -= 1;
          this.topic.meta.give_collect = !this.topic.meta.give_collect;
        });
      }
    },
    destoryTopic() {
      this.$confirm("此操作将永久删除该文章, 是否继续?", "提示", {
        confirmButtonText: "确定",
        cancelButtonText: "取消",
        type: "warning"
      })
        .then(() => {
          var id = this.$route.query.id;
          deleteTopic(id)
            .then(res => {
              this.$message({
                type: "success",
                message: "删除成功!"
              });
              this.changRoute("/");
            })
            .catch(() => {
              this.$message({
                type: "error",
                message: "系统繁忙!"
              });
            });
        })
        .catch(() => {
          this.$message({
            type: "info",
            message: "已取消删除"
          });
        });
    }
  },
  components: {
    Comment,
    reply,
  }
};
</script>

<style>
.content_wraper {
  width: 70%;
  margin: 0 auto;
  position: relative;
}
.user_box {
  position: absolute;
  top: 0%;
  right: -13%;
}
.topic-wrapper {
  width: 100%;
  margin: 0 auto;
}
.post-wrapper {
  padding: 20px;
  height: 100%;
  width: 70%;
  margin: 0 auto;
  background-color: #fff;
  border: 1px solid #dcdfe6;
  border-radius: 4px;
  display: inline-block;
}
.user_button {
  position: absolute;
  padding: 20px;
  right: 12%;
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
  width: 30px;
  background-color: #fff;
  border: 1px solid #dcdfe6;
  border-radius: 4px;
  height: 115px;
  margin-left: 5%;
  position: fixed;
}
.side-icon {
  margin-top: 10px;
  margin-bottom: 10px;
  border-bottom-color: #dcdfe6;
  border-bottom-width: 1px;
  border-bottom-style: solid;
}
.side-icon > .el-divider--horizontal {
  display: block;
  height: 1px;
  width: 100%;
  margin-top: 10px;
}
.icon-img {
  width: 24px;
  height: 24px;
}
.user_box > .el-card__body {
  text-align: center;
}
</style>