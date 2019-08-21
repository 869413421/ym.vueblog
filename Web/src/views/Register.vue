<template>
  <div>
    <div class="register-wrapper">
      <div id="register">
        <p class="title">注册</p>
        <el-form
          :model="Form"
          status-icon
          :rules="rules"
          ref="Form"
          label-width="0"
          class="demo-ruleForm"
        >
          <el-form-item prop="phone">
            <el-input v-model="Form.phone" auto-complete="off" placeholder="请输入手机号"></el-input>
          </el-form-item>
          <el-form-item prop="verification_code" class="code">
            <el-input v-model="Form.verification_code" placeholder="验证码"></el-input>
            <el-button type="primary" :disabled="isDisabled" @click="sendCode">{{buttonText}}</el-button>
          </el-form-item>
          <el-form-item prop="name">
            <el-input v-model="Form.name" auto-complete="off" placeholder="请输入用户名称"></el-input>
          </el-form-item>
          <el-form-item prop="password">
            <el-input
              type="password"
              v-model="Form.password"
              auto-complete="off"
              placeholder="输入密码"
            ></el-input>
          </el-form-item>
          <el-form-item prop="checkpassword">
            <el-input
              type="password"
              v-model="Form.checkpassword"
              auto-complete="off"
              placeholder="确认密码"
            ></el-input>
          </el-form-item>
          <el-form-item>
            <el-button type="primary" @click="submitForm('Form')" style="width:100%;">注册</el-button>
            <p class="login" @click="gotoLogin">已有账号？立即登录</p>
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
        callback(this.$message("请输入电话号码"));
      } else if (!this.checkMobile(value)) {
        callback(new Error("手机号码不合法"));
      } else {
        callback();
      }
    };
    //  <!--验证码是否为空-->
    let checkverification_code = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("请输入手机验证码"));
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
    // <!--二次验证密码-->
    let validatepassword2 = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("请再次输入密码"));
      } else if (value !== this.Form.password) {
        callback(new Error("两次输入密码不一致!"));
      } else {
        callback();
      }
    };

    let vdlidateName = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("请输入用户名"));
      }
    };
    return {
      Form: {
        name: "",
        password: "",
        checkpassword: "",
        phone: "",
        verification_code: ""
      },
      rules: {
        password: [{ validator: validatepassword, trigger: "change" }],
        checkpassword: [{ validator: validatepassword2, trigger: "change" }],
        phone: [{ validator: checkphone, trigger: "change" }],
        name: [{ validator: vdlidateName, trigger: "change" }],
        verification_code: [
          { validator: checkverification_code, trigger: "change" }
        ]
      },
      buttonText: "发送验证码",
      isDisabled: false, // 是否禁止点击发送验证码按钮
      flag: true
    };
  },
  methods: {
    // <!--发送验证码-->
    sendCode() {
      let phone = this.Form.phone;
      if (this.checkMobile(phone)) {
        this.axios
          .get("verificationCode", {
            params: {
              phone: phone
            }
          })
          .then(res => {
            if (res.status == 201) {
              let time = 60;
              this.buttonText = "已发送";
              this.isDisabled = true;
              this.$message({
                message: "发送成功",
                type: "success"
              });
              if (this.flag) {
                this.flag = false;
                let timer = setInterval(() => {
                  time--;
                  this.buttonText = time + " 秒";
                  if (time === 0) {
                    clearInterval(timer);
                    this.buttonText = "重新获取";
                    this.isDisabled = false;
                    this.flag = true;
                  }
                }, 1000);
              }
            } else {
              this.$message.error(res.message);
            }
          })
          .catch(res => {
            this.$message.error("系统繁忙");
          });
      } else {
        this.$message.error("请输入正确电话号码");
      }
    },
    // <!--提交注册-->
    submitForm() {
      this.axios({
        method: "post",
        data: this.Form,
        url: "user"
      })
        .then(res => {
          if (res.status == 201) {
            this.$message({
              message: "注册成功",
              type: "success"
            });
            console.log(res.data);
            this.$store.dispatch("Login", res.data);
            this.gotoPost();
          }
        })
        .catch(res => {
          this.$message.error(res.message);
        });
    },
    // <!--进入登录页-->
    gotoLogin() {
      this.changRoute('/login')
    },
    gotoPost() {
       this.changRoute('/postlist')
    },
    // 验证手机号
    checkMobile(str) {
      if (str == "" || str == null) {
        return false;
      }
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