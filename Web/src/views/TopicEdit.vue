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
          <el-input v-model="form.title" placeholder="请输入标题"></el-input>
        </el-form-item>

        <el-form-item>
          <el-select v-model="form.categorie_id" filterable placeholder="请选择分类" style="width:100%">
            <el-option
              v-for="item in options"
              :key="item.value"
              :label="item.label"
              :value="item.value"
            ></el-option>
          </el-select>
        </el-form-item>

        <el-form-item>
          <template>
            <div class="content">
              <mavon-editor
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
export default {
  name: "TopicEdit",
  data() {
    return {
      form: {
        categorie_id: "",
        content: "",
        title: ""
      },
      headers: {
        Authorization: "Bearer " + this.$store.state.token
      },
      options: []
    };
  },
  methods: {
    onSubmit() {
      this.axios({
        method: "post",
        url: "topic",
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
      formdata.append("type", 'topic');
      this.axios({
        url: "image",
        method: "post",
        data: formdata,
        headers: {
          "Content-Type": "multipart/form-data",
          Authorization: "Bearer " + this.$store.state.token
        }
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