<template>
  <div>
    <div class="post-wrapper">
      <el-form ref="form" :model="form">
        <el-form-item>
          <span class="form-header">
            <i class="el-icon-edit">博文编辑</i>
          </span>
        </el-form-item>
        <el-form-item>
          <el-input v-model="form.label" placeholder="请输入标题"></el-input>
        </el-form-item>

        <el-form-item>
          <template>
            <div class="content">
              <mavon-editor style="height:500px" :ishljs="true" @imgAdd="imgAdd"></mavon-editor>
            </div>
          </template>
        </el-form-item>

        <el-form-item>
          <el-button type="primary" style @click="onSubmit">更新资料</el-button>
          <el-button>取消</el-button>
        </el-form-item>
      </el-form>
    </div>
  </div>
</template>
<script>
export default {
  name: "PostEdit",
  data() {
    return {
      form: {
        name: "",
        nickname: "",
        email: "",
        city: "",
        company: "",
        title: "",
        introduction: "",
        avatar: ""
      },
      headers: {
        Authorization: "Bearer " + this.$store.state.token
      },
      uploadData: {
        type: "avatar"
      }
    };
  },
  methods: {
    onSubmit() {
      this.axios({
        method: "patch",
        url: "user",
        data: this.form
      }).then(res => {
        this.$message({
          message: "更新成功",
          type: "success"
        });
        this.form = res.data.data;
      });
    },
    imgAdd(pos, $file) {
      // 第一步.将图片上传到服务器.
      var formdata = new FormData();
      formdata.append("image", $file);
      axios({
        url: "server url",
        method: "post",
        data: formdata,
        headers: { "Content-Type": "multipart/form-data" }
      }).then(url => {
        // 第二步.将返回的url替换到文本原位置![...](./0) -> ![...](url)
        /**
         * $vm 指为mavonEditor实例，可以通过如下两种方式获取
         * 1. 通过引入对象获取: `import {mavonEditor} from ...` 等方式引入后，`$vm`为`mavonEditor`
         * 2. 通过$refs获取: html声明ref : `<mavon-editor ref=md ></mavon-editor>，`$vm`为 `this.$refs.md`
         */
      });
    }
  },
  created() {
    this.axios
      .get("user")
      .then(res => {
        this.form = res.data.data;
      })
      .catch(res => {
        this.$message.error("请重新登陆");
      });
  }
};
</script>

<style>
.post-wrapper {
  display: flex;
  margin: 0 auto;
  padding: 20px;
  height: 100%;
  width: 70%;
  background-color: #fff;
}
</style>