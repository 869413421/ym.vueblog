<template>
  <div class="comment-wrapper">
    <div class="comment_edit">
      <reply></reply>
    </div>

    <div class="comment" v-for="item in comments" :key="item.id">
      <el-avatar shape="square" size="large" :src="item.user.avatar"></el-avatar>
      <el-card class="box-card">
        <div slot="header" class="card_header">
          <span>{{item.name}}</span>
          <div class="comment_header">
            <div class="el-icon-time"></div>
            {{item.diff_create_date}}
          </div>
        </div>
        <div v-html="item.content"></div>
        <div style="display:inlink">
          <el-input v-model="input" placeholder="请输入内容"></el-input>
          <el-button type="primary">评论</el-button>
        </div>

        <div v-for="reply in item.reply.data" :key="reply.id">
          <el-divider></el-divider>
          <div slot="header" class="card_header">
            <el-avatar shape="square" size="small" :src="reply.user_avatar"></el-avatar>
            <span>{{reply.user_name}}</span>
            <span style="font-size: 0.5em;color:#adb1af">回复</span>
            <span>{{reply.reply_user_name}}</span>
            <div class="comment_header">
              <div class="el-icon-time"></div>
              {{reply.diff_create_date}}
            </div>
            <div v-html="reply.content"></div>
          </div>
        </div>
      </el-card>
    </div>
  </div>
</template>
<script>
import reply from "../components/reply";
import { getCommentList } from "../js/api/comment";
import { emoji } from "../utils/emoji";
export default {
  name: "Comment",
  data() {
    return {
      comments: [],
      comment: "",
      toolbars: {
        bold: true, // 粗体
        italic: true, // 斜体
        header: true, // 标题
        underline: true, // 下划线
        strikethrough: true, // 中划线
        mark: true, // 标记
        superscript: true, // 上角标
        subscript: true, // 下角标
        quote: true, // 引用
        ol: true, // 有序列表
        ul: true, // 无序列表
        link: true, // 链接
        help: true // 帮助
      }
    };
  },
  created() {
    var id = this.$route.query.id;
    getCommentList(id).then(res => {
      this.comments = res.data.data;
      for (var i = 0; i < this.comments.length; i++) {
        this.comments[i]["content"] = emoji(this.comments[i]["content"]);
      }
      console.log(this.comments);
    });
  },
  components: {
    reply
  }
};
</script>

<style>
.comment-wrapper {
  margin-top: 20px;
}
.box-card {
  width: 92%;
  margin: 0 auto;
  display: inline-block;
}
.card_header,
.el-card__body {
  line-height: 20px;
  text-align: left;
}
.card_header > span {
  font-size: 1em;
  color: rgba(0, 0, 0, 0.87);
  font-weight: 700;
}

.box-card {
  padding: 0px;
  position: inherit;
}

.comment {
  margin: 0 auto;
  padding: 20px 0 20px 0px;
  width: 74%;
  box-sizing: border-box;
}

.comment_edit {
  margin: 0 auto;
  padding: 20px 0 20px 0px;
  width: 74%;
  box-sizing: border-box;
}

.comment > .el-avatar {
  float: left;
}

.el-avatar--large {
  width: 40px;
  height: 40px;
  line-height: 40px;
  margin-right: 20px;
}
.comment_header {
  font-size: 0.5em;
  color: rgba(0, 0, 0, 0.87);
  font-weight: 500;
  margin-top: 10px;
}
.avatar {
  width: 10%;
}
</style>