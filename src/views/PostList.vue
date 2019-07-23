<template>
  <div>
    <el-table :data="topicList" stripe style="width: 70%;margin:0 auto">
      <el-table-column prop="title"></el-table-column>
      <!-- <el-table-column prop="name" label="姓名" width="180"></el-table-column>
      <el-table-column prop="address" label="地址"></el-table-column>-->
    </el-table>
    <el-pagination background layout="prev, pager, next" :total="total" :page-size="pageSize" :page-count="pageCount" ></el-pagination>
  </div>
</template>

<script>
export default {
  name: "PostList",
  data() {
    return {
      topicList: [],
      total: 0,
      pageSize:0,
      currentPage:0,
      pageCount:0
    };
  },
  created() {
    this.axios
      .get("topics")
      .then(res => {
        console.log(res.data);
        this.topicList = res.data.data;
        this.total = res.data.total;
        this.pageSize=res.data.per_page;
        this.currentPage=res.data.current_page;
        this.pageCount=res.data.last_page;
      })
      .catch(res => {});
  }
};
</script>

<style>
</style>