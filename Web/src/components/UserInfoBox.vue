<template>
  <div class="user-info-box">
    <div class="user-info-box-header">
      <div class>
        <span :title="user.created_at">注册于：{{user.regirster_date}}</span> ，
        <span :title="user.last_active_time">最后活跃于：{{user.diff_last_active_time}}</span>
      </div>
    </div>
    <div class="user-info-box-body">
      <dl>
        <dt class="dt-header">
          <div class="el-icon-user-solid"></div>个人信息
        </dt>
        <dt>
          <span>姓名：{{user.name}}</span>
        </dt>
        <dt>
          <span>邮箱：{{user.email}}</span>
        </dt>
        <dt>
          <span>城市：{{user.city}}</span>
        </dt>
        <dt>
          <span>公司：{{user.company}}</span>
        </dt>
        <dt>
          <span>头衔：{{user.title}}</span>
        </dt>
        <dt>
          <span>真实姓名：{{user.nickname}}</span>
        </dt>
      </dl>
    </div>

    <div class="user-info-box-content">
      <dl>
        <dt class="dt-header">
          <div class="el-icon-chat-line-square"></div>动态
        </dt>
        <dt v-for="item in action_list" :key="item.id">
          <div class="action-content" v-if="item.model">
            <div class="action-content-span">
              <el-image style="width: 30px; height: 30px;margin-right: 2%;" :src="user.avatar"></el-image>
              <span>{{user.name}}</span>
              <span v-if="item.model.type==='good'">点赞了文章</span>
              <span v-if="item.model.type==='collect'">收藏了文章</span>
              <span v-if="item.model.type==='topic'">发布了文章</span>
              <span v-if="item.model.type==='comment'">评论了文章</span>
              <span v-if="item.model.type==='reply'">回复了</span>
              <span style="margin-left: 59%;font-weight: 100;">{{item.diff_create_date}}</span>
            </div>

            <a href="javascript:void(0)" @click="changRoute('/topic_show?id='+item.model.topic_id)">
              <div class="action-post">
                <el-image :src="item.model.avatar"></el-image>
                <div class="action-info-content">
                  <div class="font-hide">
                    <span>{{item.model.title}}</span>
                  </div>
                  <div class="font-hide">
                    <span v-if="item.model.type!='reply'">{{item.model.excerpt}}</span>
                    <span v-else v-html="emoji(item.model.comment_content)"></span>
                  </div>
                </div>
              </div>
            </a>

            <div class="action-post" v-show="item.model.type=='reply'||item.model.type=='comment'">
              <div class="action-info-content">
                <div class="font-hide">
                  <span v-if="item.model.type!='reply'">{{item.model.title}}</span>
                  <span v-else v-html="emoji(item.model.comment_content)"></span>
                </div>
                <div class="font-hide">
                  <span v-html="emoji(item.model.content)"></span>
                </div>
              </div>
              <el-image :src="user.avatar"></el-image>
            </div>
          </div>
        </dt>
        <el-button
          v-show="last_page>current_page"
          size="small"
          style="width:100%;margin-top:7%"
          @click="load()"
        >查看更多</el-button>
      </dl>
    </div>
  </div>
</template>

<script>
import { getAction } from "../js/api/action";
import { emoji } from "../utils/emoji";
export default {
  name: "UserInfoBox",
  data() {
    return {
      user: null,
      action_list: null,
      page: 1,
      page_size: 2,
      current_page: 1,
      last_page: 1
    };
  },
  created() {
    this.user = this.$store.state.user;
    getAction(this.page, this.page_size).then(res => {
      this.action_list = res.data.data;
      this.current_page = res.data.meta.pagination.current_page;
      this.last_page = res.data.meta.pagination.total_pages;
    });
  },
  methods: {
    load() {
      this.current_page = this.current_page + 1;
      console.log(this.current_page);
      getAction(this.current_page, this.page_size).then(res => {
        for (var i = 0; i < res.data.data.length; i++) {
          console.log(res.data.data[i]);
          this.action_list.push(res.data.data[i]);
        }
        this.current_page = res.data.meta.pagination.current_page;
      });
    }
  }
};
</script>

<style>
.user-info-box {
  width: 100%;
  position: unset;
}
.user-info-box-header {
  background-color: #fff;
  border-radius: 5px;
  width: 50%;
  position: absolute;
  right: 28%;
  color: #7b7979;
  font-weight: 100;
  font-size: 14px;
  padding: 12px;
}
.user-info-box-body {
  background-color: #fff;
  border-radius: 5px;
  width: 50%;
  position: absolute;
  right: 28%;
  color: #7b7979;
  font-weight: 100;
  font-size: 14px;
  padding: 12px;
  top: 17%;
  text-align: left;
}
dt {
  margin-left: 5%;
  margin-bottom: 0.6%;
}
.dt-header {
  font-size: 15px;
  font-weight: 600;
  margin-bottom: 2%;
}

.user-info-box-content {
  background-color: #fff;
  border-radius: 5px;
  width: 50%;
  position: absolute;
  right: 28%;
  color: #7b7979;
  font-weight: 100;
  font-size: 14px;
  padding: 12px;
  top: 83%;
  text-align: left;
}

.action-content {
  padding: 20px;
  border-bottom: 1px solid #ece9e9;
}

.action-post {
  border-radius: 5px;
  width: 75%;
  height: 100px;
  border: 1px solid #e0dbdb;
  margin: 3% auto;
  display: flex;
}

.action-content .el-image {
  border-radius: 4%;
  width: 20%;
  height: 98%;
  margin-left: 0.1%;
  margin-top: 1px;
  margin-bottom: 1px;
}

.action-post-header {
  display: inline-block;
  position: absolute;
}

.action-post-body {
  display: inline-block;
  position: absolute;
}
.action-content-span {
  display: flex;
  align-items: center;
  margin-left: 1%;
}
.action-info-content {
  width: 80%;
}
.font-hide {
  margin-left: 3%;
  font-size: 16px;
  font-weight: 700;
  margin-top: 1.5%;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 2;
  overflow: hidden;
  margin-top: 3%;
}
</style>
