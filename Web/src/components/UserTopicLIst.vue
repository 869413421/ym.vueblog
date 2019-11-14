<template>
  <div class="user-topic-list">
    <div class="user-topic-list-body">
      <div class="user-topic-list-body-top" v-if="user">
        <span class="el-icon-notebook-2"></span>
        <span>{{user.name}} 发布的文章 ({{user.topic_count}})</span>
      </div>

      <div class="user-top-info" v-for="item in topic_list" :key="item.id">
        <a href="javascript:void(0)" @click="changRoute('/topic_show?id='+item.id)">
          <div class="user-top-info-header">
            <span>{{item.title}}</span>
          </div>
        </a>
        <div class="user-top-info-bottom">
          <span>创建于{{item.diff_create_date}} | 阅读数 {{item.view_count}} | 评论数 {{item.comment_count}} | 点赞数 {{item.good_count}} | 收藏数 {{item.collect_count}}</span>
        </div>
      </div>
      <el-pagination
        style="margin-top:2%"
        background
        layout="prev, pager, next"
        :total="total"
        :current-page="current_page"
        :page-size="page_size"
        :page-count="page_count"
        @current-change="changPage"
      ></el-pagination>
    </div>
  </div>
</template>

<script>
import { getUserTopic } from "../js/api/user";
export default {
  name: "UserTopicList",
  data() {
    return {
      topic_list: null,
      user: null,
      page: 1,
      page_size: 10,
      current_page: 1,
      total: 0,
      page_count: 0
    };
  },
  created() {
    this.changPage(1);
  },
  methods: {
    changPage(page) {
      this.current_page = page;
      var user_id = this.$route.query.id;
      getUserTopic(user_id, this.current_page, this.page_size).then(res => {
        this.topic_list = res.data.data;
        this.user = res.data.meta.user;
        this.current_page = res.data.meta.pagination.current_page;
        this.last_page = res.data.meta.pagination.total_pages;
        this.total = res.data.meta.pagination.total;
        this.page_count = res.data.meta.pagination.total_pages;
      });
    }
  }
};
</script>

<style>
.user-topic-list {
  width: 100%;
  position: unset;
}
.user-topic-list-body {
  background-color: #fff;
  border-radius: 5px;
  width: 50%;
  position: absolute;
  right: 28%;
  color: #7b7979;
  font-weight: 100;
  font-size: 14px;
  padding: 12px;
  text-align: left;
}

.user-topic-list-body-top {
  font-size: 18px;
  font-weight: 700;
  border-bottom: 1px solid #dbd7d7;
  padding: 20px;
}
.user-top-info {
  line-height: 100%;
  padding: 2%;
  border-bottom: 1px dashed #c0dcdd;
}
.user-top-info-header {
  font-size: 16px;
  font-weight: 600;
}
.user-top-info-bottom {
  margin-top: 3%;
  font-size: 13px;
}
</style>
