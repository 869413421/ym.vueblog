<template>
  <div>
    <div class="post-wrapper">
      <el-form ref="form" :model="form" status-icon :rules="rules">
        <el-form-item>
          <span class="form-header">
            <i class="el-icon-edit">博文编辑</i>
          </span>
        </el-form-item>

        <el-form-item prop="title">
          <el-input v-model="form.title" placeholder="请输入标题"></el-input>
        </el-form-item>

        <el-form-item prop="categorie_id" v-if="form.category">
          <el-select v-model="form.category.id" filterable placeholder="请选择分类" style="width:100%">
            <el-option
              v-for="item in options"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            ></el-option>
          </el-select>
        </el-form-item>

        <el-form-item prop="content">
          <template>
            <div class="content">
              <mavon-editor
                ref="md"
                v-model="form.content"
                style="height:500px"
                :ishljs="true"
                @imgAdd="imgAdd"
              ></mavon-editor>
            </div>
          </template>
        </el-form-item>

        <el-form-item>
          <el-button type="primary" style @click="onSubmit">保存</el-button>
          <el-button>取消</el-button>
        </el-form-item>
      </el-form>
    </div>
  </div>
</template>
<script>
import { createTopic } from "../js/api/topic";
import { updateTopic } from "../js/api/topic";
import { getTopic } from "../js/api/topic";
import { getUserIofo } from "../js/api/user";
export default {
  name: "TopicEdit",
  data() {
    return {
      form: {
        categorie_id: "",
        content: "",
        title: "",
        id: ""
      },
      headers: {
        Authorization: "Bearer " + this.$store.state.token
      },
      options: [],
      rules: {
        title: [
          { required: true, message: "请输入标题", trigger: "blur" },
          { min: 3, max: 50, message: "标题长度在3到50间", trigger: "blur" }
        ],
        categorie_id: [
          { required: true, message: "请选择分类", trigger: "blur" }
        ],
        content: [
          { required: true, message: "请输入内容", trigger: "blur" },
          { min: 20, message: "最少为20个字符", trigger: "blur" }
        ]
      }
    };
  },
  methods: {
    onSubmit() {
      var id = this.$route.query.id;
      this.form.categorie_id=this.form.category.id
      console.log(this.form);
      this.$refs["form"].validate(valid => {
        if (valid) {
          if (!id) {
            createTopic("post", this.form).then(res => {
              this.form = res.data.data;
              this.$message({
                message: "发布成功",
                type: "success"
              });
            });
          } else {
            updateTopic(id, this.form).then(res => {
              this.form = res.data.data;
              this.$message({
                message: "更新成功",
                type: "success"
              });
            });
          }
        } else {
          this.$message.error("请检查提交内容");
        }
      });
    },
    imgAdd(pos, $file) {
      // 第一步.将图片上传到服务器.
      var formdata = new FormData();
      formdata.append("image", $file);
      formdata.append("type", "topic");
      this.axios({
        url: "image",
        method: "post",
        data: formdata,
        headers: {
          "Content-Type": "multipart/form-data",
          Authorization: "Bearer " + this.$store.state.token
        }
      }).then(res => {
        this.$refs.md.$img2Url(pos, res.data.data.path);
      });
    }
  },
  created() {
    //获取用户最新信息并分发到vuex
    // getUserIofo().then(res => {
    //   this.$store.dispatch("DispachUser", res.data.data);

    this.axios
      .get("category")
      .then(res => {
        for (var key in res.data) {
          var obj = new Object();
          obj.label = res.data[key]["title"];
          obj.value = res.data[key]["id"];
          this.options.push(obj);
        }
      })
      .catch(res => {
        this.$message.error("系统繁忙");
      });

    if (this.$route.query.id) {
      this.form.id = this.$route.query.id;
      getTopic(this.form.id).then(res => {
        this.form = res.data;
        console.log(this.form);
      });
    }
    // });
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