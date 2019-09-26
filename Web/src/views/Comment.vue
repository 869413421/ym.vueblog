<template>
  <div>
    <div class="comment-wrapper">
      <el-card class="box-card" v-for="item in commit" :key="item.id">
        <div class="card__header">
          <span>{{item.name}}</span>
        </div>

        <!-- <el-button style="float: right; padding: 3px 0" type="text">操作按钮</el-button> -->

        <div>{{item.content}}</div>
        <!-- <div v-for="o in 4" :key="o" class="text item">{{'列表内容 ' + o }}</div> -->
      </el-card>
    </div>
  </div>
</template>
<script>
import { getCommentList } from "../js/api/comment";
export default {
  name: "Comment",
  data() {
    return {
      commit: []
    };
  },
  created() {
    var id = this.$route.query.id;
    getCommentList(id).then(res => {
      this.commit = res.data.data;
    });
  }
};
</script>

<style>
.box-card {
  padding: 20px;
  height: 100%;
  width: 70%;
  margin: 0 auto;
}
.card__header {
  padding-right: 15px;
  padding-left: 15px;
  color: #767676;
  background-color: #fff;
  border-bottom: 1px solid #ddd;
  border-top-left-radius: 3px;
  border-top-right-radius: 3px;
  position: relative;
}
</style>