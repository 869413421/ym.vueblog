<template>
  <div id="header">
    <el-row>
      <el-header>
        <el-col :span="1">
          <div>
            <img src alt />
          </div>
        </el-col>

        <el-col :span="8">
          <el-menu
            default-active
            class="el-menu-demo"
            mode="horizontal"
            @select="handleSelect"
            background-color="#24292E"
            text-color="#FFFFFF"
            active-text-color="#E1F2F1"
          >
            <!-- 一级菜单 -->
            <template v-for="item in narbar">
              <el-submenu v-if="item.child&& item.child.length" :index="item.id" :key="item.id">
                <template slot="title">
                  <span>{{item.name}}</span>
                </template>

                <!-- 二级菜单 -->
                <template v-for="itemChild in item.child">
                  <el-submenu
                    v-if="itemChild.child&&itemChild.child.length"
                    :index="itemChild.id"
                    :key="itemChild.id"
                  >
                    <template slot="title">
                      <span>{{itemChild.name}}</span>
                    </template>

                    <!-- 三级菜单 -->
                    <el-menu-item
                      v-for="itemChild_Child in itemChild.child"
                      :index="itemChild_Child.id"
                      :key="itemChild_Child.id"
                    >
                      <span slot="title">{{itemChild_Child.name}}</span>
                    </el-menu-item>
                  </el-submenu>

                  <el-menu-item v-else :index="itemChild.id" :key="itemChild.id">
                    <i :class="itemChild.icon"></i>
                    <span slot="title">{{itemChild.name}}</span>
                  </el-menu-item>
                </template>
              </el-submenu>

              <el-menu-item v-else :index="item.id" :key="item.id">
                <span slot="title">{{item.name}}</span>
              </el-menu-item>
            </template>
          </el-menu>
        </el-col>

        <el-col :span="4">
          <div>
            <el-input placeholder="请输入内容" clearable size="small "></el-input>
          </div>
        </el-col>

        <el-col :span="3" :offset="8">
          <div v-if="this.$store.state.token" class="loginpanne">
            <el-menu
              class="el-menu-demo header-right-menu"
              mode="horizontal"
              @select="handleSelect"
              background-color="#24292E"
              text-color="#FFFFFF"
              active-text-color="#E1F2F1"
            >
              <el-menu-item>
                <div class="el-icon-bell icon-class"></div>
              </el-menu-item>
              <el-menu-item>
                <div class="el-icon-plus icon-class" @click="changRoute('/topic_edit')"></div>
              </el-menu-item>

              <el-submenu index="2">
                <template slot="title">
                  <el-avatar :size="35" :src="this.$store.state.user.avatar"></el-avatar>
                </template>
                <el-menu-item :index="'/user_center/user_info?id='+this.$store.state.user.id">个人中心</el-menu-item>
                <el-menu-item index="user_edit">修改资料</el-menu-item>
              </el-submenu>
            </el-menu>
          </div>

          <div v-else>
            <el-button type="info" size="small" @click="changRoute('login')">登陆</el-button>
            <el-button type="info" size="small" @click="changRoute('register')">注册</el-button>
          </div>
        </el-col>
      </el-header>
    </el-row>
  </div>
</template>

<script>
export default {
  name: "Header",
  data() {
    return {
      activeIndex: "1",
      activeIndex2: "1",
      narbar: []
    };
  },
  methods: {
    handleSelect(key, keyPath) {
      this.changRoute(keyPath[1]);
    }
  },
  created() {
    this.axios.get("narbars").then(res => {
      console.log(res.status);
      if (res.status == 200 || res.status == 302) {
        this.narbar = res.data;
        console.log(this.narbar);
      }
    });
  }
};
</script>

<style>
.grid-content {
  border-radius: 4px;
  min-height: 36px;
}
.icon-class {
  color: aliceblue;
}
.header-right-menu li.el-menu-item {
  padding: 0;
  height: 100%;
}
</style>

