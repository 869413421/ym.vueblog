<template>
  <div>
    <el-input
      type="textarea"
      :autosize="{ minRows: 10, maxRows: 20}"
      placeholder="请输入内容"
      resize="none"
      v-model="value"
    ></el-input>
    <div class="icon clearfix">
      <i class="icon iconfont icon-face" @click="showEmoji = !showEmoji"></i>
      <el-button type="success" size="small" @click="submit" class="submit">提交</el-button>
      <transition name="fade" mode>
        <div class="emoji-box" v-if="showEmoji">
          <el-button
            class="pop-close"
            :plain="true"
            type="danger"
            size="mini"
            icon="close"
            @click="showEmoji = false"
          ></el-button>
          <vue-emoji @select="selectEmoji"></vue-emoji>
          <span class="pop-arrow arrow"></span>
        </div>
      </transition>
    </div>
  </div>
</template>

<script>
import vueEmoji from "./emoji";
import { postComment } from "../js/api/comment";

export default {
  name: "reply",
  data() {
    return {
      value: "",
      showEmoji: false,
      data: []
    };
  },
  methods: {
    selectEmoji(code) {
      this.showEmoji = false;
      this.value += code;
    },
    submit() {
      var token = this.$store.state.token;

      if (!token) {
        this.$message.error("请登录");
        return;
      }
      if (!this.value) {
        this.$message.error("请输入评论内容");
        return;
      }
      var id = this.$route.query.id;
      postComment(id, this.value)
        .then(res => {
          this.$message({
            message: "发布成功",
            type: "success"
          });
          setTimeout(() => {
            window.location.reload();
          }, 3000);
        })
        .catch(res => {
          this.$message.error("系统繁忙");
        });
    }
  },
  components: {
    vueEmoji
  }
};
</script>

<style lang="scss">
ul {
  margin: 0;
  padding: 0;
  list-style: none;
}
.icon {
  position: relative;
  margin-top: 20px;
  .iconfont {
    cursor: pointer;
    color: #f7ba2a;
  }
  .emoji-box {
    position: absolute;
    z-index: 10;
    left: -10px;
    top: 24px;
    box-shadow: 0 4px 20px 1px rgba(0, 0, 0, 0.2);
    background: white;
    .el-button {
      position: absolute;
      border: none;
      color: #ff4949;
      right: 12px;
      top: 12px;
      z-index: 10;
    }
    .arrow {
      left: 10px;
    }
  }
  .submit {
    float: right;
  }

  .comment {
    margin-top: 20px;
    .item {
      margin-top: 20px;
      padding: 10px;
      margin: 0;
      border-top: 1px solid #bfcbd9;
    }
  }
}

.clearfix {
  &:after {
    content: "";
    display: block;
    height: 0;
    clear: both;
    visibility: hidden;
  }
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter,
.fade-leave-active {
  opacity: 0;
}
.fade-move {
  transition: transform 0.4s;
}

.list-enter-active,
.list-leave-active {
  transition: all 0.5s;
}
.list-enter,
.list-leave-active {
  opacity: 0;
  transform: translateX(30px);
}
.list-leave-active {
  position: absolute !important;
}
.list-move {
  transition: all 0.5s;
}
</style>
