<template>
  <div class="post_list">
    <div class="post_table">
      <el-table :data="topicList" stripe :border="true" :highlight-current-row="true">
        <el-table-column>
          <template slot="header">
            <div style="margin:0 auto">
              <el-button plain size="mini" id="Active" ref="Active" @click="changType('Active')">活跃</el-button>
              <el-button plain size="mini" id="Hot" @click="changType('Hot')">热门</el-button>
              <el-button plain size="mini" id="Essence" @click="changType('Essence')">精华</el-button>
              <el-button plain size="mini" id="New" @click="changType('New')">最新</el-button>
              <el-button plain size="mini" id="Zero" @click="changType('Zero')">零回复</el-button>
            </div>
          </template>
          <template slot-scope="data">
            <div>
              <el-avatar
                style="float:left"
                :src="data.row.user.avatar"
              ></el-avatar>
              <router-link :to="{path:'topic_show',query:{id:data.row.id}}">
              <div style="float:left;margin-left:20px">
                <span style="float:left">{{data.row.title}}</span>
                <br />
                <span>{{data.row.excerpt}}</span>
              </div>
              </router-link>
              <div style="float:right;margin-top:20px">
                <i class="el-icon-view"></i>
                <span style="font-size:6px;margin-left:5px">{{data.row.view_count}}</span>
                <i class="el-icon-chat-dot-round"></i>
                <span style="font-size:6px;margin-left:5px">{{data.row.comment_count}}</span>
                <i class="el-icon-star-off"></i>
              </div>
            </div>
          </template>
        </el-table-column>
      </el-table>
    </div>

    <div style="margin-bottom: 10px;">
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
            include:'user,category'
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
  height: 100%;
}
.post_table {
  display: flex;
  margin: 0 auto;
  padding: 20px;
  height: 100%;
}

.cell>div{
    display: flex;
    justify-content: flex-start;
    flex-wrap: wrap;
}

.el-avatar>img{
    width: 100%;
}
</style>