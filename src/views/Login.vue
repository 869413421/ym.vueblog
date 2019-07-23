<template>
  <div>
    <div class="register-wrapper">
      <div id="register">
        <p class="title">登陆 {{token}}</p>
        <el-form
          :model="Form"
          status-icon
          :rules="rules"
          ref="Form"
          label-width="0"
          class="ruleForm"
        >
          <el-form-item prop="phone">
            <el-input v-model="Form.phone" auto-complete="off" placeholder="请输入手机号"></el-input>
          </el-form-item>

          <el-form-item prop="password">
            <el-input
              type="password"
              v-model="Form.password"
              auto-complete="off"
              placeholder="输入密码"
            ></el-input>
          </el-form-item>

          <el-form-item>
            <el-button type="primary" @click="submitForm('Form')" style="width:100%;">登陆</el-button>
            <p class="login" @click="gotoRegister">立即注册</p>
          </el-form-item>
        </el-form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "Register",
  data() {
    // <!--验证手机号是否合法-->
    let checkphone = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("请输入手机号码"));
      } else if (!this.checkMobile(value)) {
        callback(new Error("手机号码不合法"));
      } else {
        callback();
      }
    };
    // <!--验证密码-->
    let validatepassword = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("请输入密码"));
      } else {
        if (this.Form.checkpassword !== "") {
          this.$refs.Form.validateField("checkpassword");
        }
        callback();
      }
    };

    return {
      Form: {
        password: "",
        phone: ""
      },
      rules: {
        password: [{ validator: validatepassword, trigger: "change" }],
        phone: [{ validator: checkphone, trigger: "change" }]
      },
      token:this.$store.state.token,
    };
  },
  methods: {
    // <!--提交注册-->
    submitForm(formName) {
      this.axios({
        method: "post",
        data: this.Form,
        url: "authorizations"
      })
        .then(res => {
          this.$store.dispatch("Login", res.data.access_token);
          if (res.status == 201) {
            this.$message({
              message: "登陆成功",
              type: "success"
            });
          } else {
            this.$message.error(res.message);
          }
        })
        .catch(res => {
          this.$message.error("系统繁忙");
        });
    },
    // <!--进入登录页-->
    gotoRegister() {
      this.$router.push({
        path: "/register"
      });
    },
    // 验证手机号
    checkMobile(str) {
      let re = /^1\d{10}$/;
      if (re.test(str)) {
        return true;
      } else {
        return false;
      }
    }
  }
};
</script>

<style scoped>
.loading-wrapper {
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
  background: #aedff8;
  display: flex;
  align-items: center;
  justify-content: center;
}
.register-wrapper img {
  position: absolute;
  z-index: 1;
}
.register-wrapper {
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
}
#register {
  max-width: 340px;
  margin: 60px auto;
  background: #fff;
  padding: 20px 40px;
  border-radius: 10px;
  position: relative;
  z-index: 9;
}
.title {
  font-size: 26px;
  line-height: 50px;
  font-weight: bold;
  margin: 10px;
  text-align: center;
}
.el-form-item {
  text-align: center;
}
.login {
  margin-top: 10px;
  font-size: 14px;
  line-height: 22px;
  color: #1ab2ff;
  cursor: pointer;
  text-align: left;
  text-indent: 8px;
  width: 160px;
}
.login:hover {
  color: #2c2fd6;
}
.code >>> .el-form-item__content {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.code button {
  margin-left: 20px;
  width: 140px;
  text-align: center;
}
.el-button--primary:focus {
  background: #409eff;
  border-color: #409eff;
  color: #fff;
}
</style>