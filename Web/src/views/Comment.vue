<template>
  <div class="comment-wrapper">
    <div class="comment_edit">
      <reply></reply>
    </div>

    <div class="comment" v-for="item in comments" :key="item.id">
      <el-avatar shape="square" size="large" :src="item.user.avatar"></el-avatar>
      <el-card class="box-card">
        <div slot="header" class="card_header">
          <span>{{item.user.name}}</span>
          <div class="comment_header">
            <div class="el-icon-time"></div>
            {{item.diff_create_date}}
            <a
              href="javascript:void(0)"
              class="el-icon-chat-dot-round"
              @click="openReplyWrapper(item.id)"
            >评论</a>
          </div>
        </div>
        <div v-html="item.content"></div>

        <div class="reply_wrapper" v-if="currentReply==item.id">
          <el-input v-model="reply_content" placeholder="请输入内容"></el-input>
          <el-button type="primary" @click="replyTopic(item.id,item.user.id)">评论</el-button>
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
              <a
                href="javascript:void(0)"
                class="el-icon-chat-dot-round"
                @click="openReplyWrapper(reply.id)"
              >评论</a>
            </div>
            <div v-html="emoji(reply.content)"></div>
            <div class="reply_wrapper" v-if="currentReply==reply.id">
              <el-input v-model="reply_content" placeholder="请输入内容"></el-input>
              <el-button type="primary" @click="replyTopic(item.id,reply.user_id)">评论</el-button>
            </div>
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
import { createReply } from "../js/api/reply";
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
      },
      reply_content: "",
      currentReply: -1
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
  methods: {
    openReplyWrapper(id) {
      this.reply_content = "";
      this.currentReply == id
        ? (this.currentReply = -1)
        : (this.currentReply = id);
    },
    replyTopic(comment_id, reply_user_id) {
      var topic_id = this.$route.query.id;
      createReply(topic_id, comment_id, reply_user_id, this.reply_content).then(
        res => {
          this.$message({
            type: "success",
            message: "评论成功"
          });
          setTimeout(function() {
            window.location.reload();
          }, 3000);
        }
      );
    }
  },
  components: {
    reply
  }
};
</script>

<style>
.comment-wrapper {
  position: absolute;
  width: 100%;
  top: 125%;
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
  padding: 20px 0 20px 0px;
  width: 74%;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  position: absolute;
  left: 13%;
  top: 122%;
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
.reply_wrapper {
  display: inline;
}
.reply_wrapper > .el-input {
  width: 85%;
  line-height: 100px;
}
.el-icon-chat-dot-round {
  margin-left: 5px;
}
</style>