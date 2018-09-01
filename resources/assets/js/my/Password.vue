<template>
  <form novalidate @submit.prevent="validateForm">
    <md-card>
      <md-card-header>
        <div class="md-title">重置登录密码</div>
      </md-card-header>
      <md-card-content>
        <p>重置登录密码后,下次登录时，生效！</p>
      </md-card-content>
      <md-card-content>
        <md-field :class="getValidationClass('password','userForm')">
          <label>登录密码</label>
          <md-input v-model="userForm.password" type="password" :disabled="sending"></md-input>
          <span class="md-error">此项不能为空，请输入密码！</span>
        </md-field>
      </md-card-content>
      <md-card-actions>
        <md-button type="submit" class="md-accent md-raised" :disabled="sending">密码重置</md-button>
      </md-card-actions>
    </md-card>
  </form>
</template>
<script>
  import {
    validationMixin
  } from "vuelidate";
  import {
    required,
    minLength
  } from "vuelidate/lib/validators";
  export default {
    name: "myProfilePasswrod",
    mixins: [validationMixin],
    data() {
      return {
        sending:false,
        userForm: {
          id:'-1',
          password: ""
        }
      };
    },
    validations: {
      userForm: {
        password: {
          required,
          minLength: minLength(3)
        }
      }
    },
    methods: {
      getValidationClass(fieldName, form) {
        const field = this.$v[form ? form : "userForm"][fieldName];
        if (field) {
          return {
            "md-invalid": field.$invalid && field.$dirty
          };
        }
      },
      savePassword() {
        if (!this.userForm.password) {
          this.$toast('密码不能为空！');
          return;
        }
        this.sending=true;
        this.$tip.waiting("正在重置密码...");
        this.$http.post("cbo/users/password", this.userForm).then(
          res => {
            this.$emit("md-confirm", res.data.data);
            this.$tip.success('密码设置成功');
            this.sending=false;
          },
          err => {
            this.$toast(err);
            this.sending=false;
          }
        );
      },
      validateForm() {
        this.$v.userForm.$touch();
        if (this.$v.userForm.$invalid) return;
        this.savePassword();
      }
    },
    mounted() {

    }
  };
</script>
<style scoped>
  form {
    max-width: 600px;
    margin: 10px auto;
  }
</style>