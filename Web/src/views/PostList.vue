<template>
  <div class="post_list">
    <div class="post_table">
      <el-table :data="topicList" stripe :border="true" :highlight-current-row="true">
        <el-table-column>
          <template slot="header">
            <div>
              <el-button plain size="mini" id="Active" ref="Active" @click="changType('Active')">活跃</el-button>
              <el-button plain size="mini" id="Hot" @click="changType('Hot')">热门</el-button>
              <el-button plain size="mini" id="Essence" @click="changType('Essence')">精华</el-button>
              <el-button plain size="mini" id="New" @click="changType('New')">最新</el-button>
              <el-button plain size="mini" id="Zero" @click="changType('Zero')">零回复</el-button>
            </div>
          </template>
          <template slot-scope="data">

            <router-link :to="{path:'/user_center/user_info',query:{id:data.row.user.id}}">
              <el-avatar :src="data.row.user.avatar"></el-avatar>
            </router-link>

            <div class="post-wraper">
              <router-link :to="{path:'topic_show',query:{id:data.row.id}}">
                <div class="post-content">
                  <span>{{data.row.title}}</span>
                  <br />
                  <span>{{data.row.excerpt}}</span>
                </div>
              </router-link>
            </div>
            <div class="icon-wraper">
              <i class="el-icon-view"></i>
              <span class="icon-span">{{data.row.view_count}}</span>
              <i class="el-icon-chat-dot-round"></i>
              <span class="icon-span">{{data.row.comment_count}}</span>
              <i class="el-icon-star-off"></i>
              <span class="icon-span">{{data.row.collect_count}}</span>
              <i class="el-icon-thumb"></i>
              <span class="icon-span">{{data.row.good_count}}</span>
            </div>
          </template>
        </el-table-column>
      </el-table>
    </div>

    <div style="margin-top: 2%;">
      <el-pagination
        background
        layout="prev, pager, next"
        :total="total"
        :current-page="currentPage"
        :page-size="pageSize"
        :page-count="pageCount"
        @current-change="changPage"
      ></el-pagination>
    </div>
  </div>
</template>

<script>
export default {
  name: "PostList",
  data() {
    return {
      topicList: [],
      total: 0,
      pageSize: 0,
      currentPage: 0,
      pageCount: 0,
      type: ""
    };
  },
  created() {
    this.getPostData(this.currentPage, this.type);
  },
  methods: {
    changPage(currentPage) {
      this.currentPage = currentPage;
      this.getPostData(this.currentPage, this.type);
    },
    changType(type) {
      this.type = type;
      this.currentPage = 1;
      this.getPostData(this.currentPage, this.type);
    },
    getPostData(page, type) {
      if (type) {
        var button = document.getElementById(type);
        button.focus();
        this.type = type;
      }
      this.axios
        .get("topics", {
          params: {
            page: page,
            type: type,
            include: "user,category"
          }
        })
        .then(res => {
          this.topicList = res.data.data;
          this.total = res.data.meta.pagination.total;
          this.pageSize = res.data.meta.pagination.per_page;
          this.currentPage = res.data.meta.pagination.current_page;
          this.pageCount = res.data.meta.pagination.total_pages;
        })
        .catch(res => {
          this.$message.error("系统繁忙");
        });
    }
  }
};
</script>
<style>
.post_list {
  width: 70%;
  margin: 0 auto;
}
.post-wraper {
  display: inline-block;
  width: 80%;
}
.post-content {
  display: inline-block;
  margin-left: 2%;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 2;
  overflow: hidden;
}
.icon-wraper {
  margin-left: 1%;
  display: inline-block;
}
.icon-span {
  font-size: 6px;
  margin-left: 5px;
}
.post_list a {
  color: black;
  text-decoration: none;
}
</style>