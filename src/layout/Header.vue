<template>
  <div id="header">
    <el-row>
      <el-header>
        <el-col :span="1">
          <div>
            <img src alt>
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
            <el-menu-item index="1">我的工作台</el-menu-item>
            <el-submenu index="2">
              <template slot="title">我的工作台</template>
              <el-menu-item index="2-1">选项1</el-menu-item>
              <el-menu-item index="2-2">选项2</el-menu-item>
              <el-menu-item index="2-3">选项3</el-menu-item>
              <el-submenu index="2-4">
                <template slot="title">选项4</template>
                <el-menu-item index="2-4-1">选项1</el-menu-item>
                <el-menu-item index="2-4-2">选项2</el-menu-item>
                <el-menu-item index="2-4-3">选项3</el-menu-item>
              </el-submenu>
            </el-submenu>
            <el-menu-item index="3">消息中心</el-menu-item>
            <el-menu-item index="4">消息中心2</el-menu-item>
          </el-menu>
        </el-col>

        <el-col :span="4">
          <div>
            <el-input placeholder="请输入内容" clearable size="small "></el-input>
          </div>
        </el-col>

       <!--  <el-col :span="8">
          <div class="grid-content bg-purple-dark"></div>
        </el-col> -->

        <el-col :span="3" :offset="8">
          <div  v-if="login">
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
                <div class="el-icon-plus icon-class"></div>
              </el-menu-item>
        <!--        <el-menu-item>
                <el-avatar :size="35"></el-avatar>
              </el-menu-item> -->
              <el-submenu index="2">
              <template slot="title">
                <el-avatar :size="35"></el-avatar>
              </template>
              <el-menu-item index="2-1">选项1</el-menu-item>
              <el-menu-item index="2-2">选项2</el-menu-item>
              <el-menu-item index="2-3">选项3</el-menu-item>
            </el-submenu>
            </el-menu>
          </div>

          <div v-if="!login">
           <el-button type="info" size="small">登陆</el-button>
           <el-button type="info" size="small">注册</el-button>
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
      login:true
    };
  },
  methods: {
    handleSelect(key, keyPath) {
      console.log(key, keyPath);
    }
  }
};
</script>

<style>
.el-header {
  position: flex;
  top: 0%;
  background-color: #24292e;
}
.grid-content {
  border-radius: 4px;
  min-height: 36px;
}
.icon-class {
  color: aliceblue;
}
.header-right-menu li.el-menu-item{
	padding: 0;
}

</style>

