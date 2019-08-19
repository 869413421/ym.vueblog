<template>
  <div>
    <div class="user-wrapper">
      <el-form ref="form" :model="form">
        <el-form-item>
          <span class="form-header"><i class="el-icon-user">修改资料</i></span>
        </el-form-item>

        <el-form-item label="头像">
          <el-upload
            class="avatar-uploader"
            action="http://ymbbs.com/api/image"
            :show-file-list="false"
            :before-upload="beforeAvatarUpload"
            :headers="headers"
            :data="uploadData"
            :on-success="handleAvatarSuccess"
            name="image"
          >
            <img v-if="form.avatar" :src="form.avatar" class="avatar" />
            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
          </el-upload>
        </el-form-item>

        <el-form-item label="用户名称">
          <el-input v-model="form.name"></el-input>
        </el-form-item>

        <el-form-item label="真实姓名">
          <el-input v-model="form.nickname"></el-input>
        </el-form-item>

        <el-form-item label="邮箱">
          <el-input v-model="form.email"></el-input>
        </el-form-item>

        <el-form-item label="城市">
          <el-input v-model="form.city"></el-input>
        </el-form-item>

        <el-form-item label="公司">
          <el-input v-model="form.company"></el-input>
        </el-form-item>

        <el-form-item label="头衔">
          <el-input v-model="form.title"></el-input>
        </el-form-item>

        <el-form-item label="个人简介">
          <el-input type="textarea" rows="10" v-model="form.introduction"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" style @click="onSubmit">更新资料</el-button>
          <el-button @click="changRoute('/postlist')">取消</el-button>
        </el-form-item>
      </el-form>
    </div>
  </div>
</template>
<script>
export default {
  name: "UserEdit",
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
      var items = this.form;
      for (var item in items) {
        if (!items[item]) {
          delete items[item];
        }
      }

      this.axios({
        method: "patch",
        url: "user",
        data: items
      }).then(res => {
        this.$message({
          message: "更新成功",
          type: "success"
        });
        this.form = res.data.data;
      });
    },
    handleAvatarSuccess(res) {
      console.log(res.data.path);
      this.form.avatar = res.data.path;
    },
    beforeAvatarUpload(file) {
      const isJPG = file.type === "image/png";
      const isLt2M = file.size / 1024 / 1024 < 2;

      if (!isJPG) {
        this.$message.error("上传头像图片只能是 png 格式!");
      }
      if (!isLt2M) {
        this.$message.error("上传头像图片大小不能超过 2MB!");
      }
      return isJPG && isLt2M;
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
.user-wrapper {
  display: flex;
  margin: 0 auto;
  padding: 20px;
  height: 100%;
  width: 70%;
  background-color: #fff;
}
.el-form {
  width: 100%;
}
.avatar-uploader .el-upload {
  border: 1px dashed #d9d9d9;
  border-radius: 6px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
}
.avatar-uploader .el-upload:hover {
  border-color: #409eff;
}
.avatar-uploader-icon {
  font-size: 15px;
  color: #8c939d;
  width: 178px;
  height: 178px;
  line-height: 178px;
  text-align: center;
}
.avatar {
  width: 178px;
  height: 178px;
  display: block;
}
.form-header {
  font-size: 24px;
  font-family: "Helvetica Neue", Helvetica, "PingFang SC", "Hiragino Sans GB",
    "Microsoft YaHei", "\5FAE\8F6F\96C5\9ED1", Arial, sans-serif;
  color: #606266;
}
</style>