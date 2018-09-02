<template>
  <form novalidate @submit.prevent="validateForm">
    <md-card>
      <md-card-header>
        <div class="md-title">修改账号{{user.accent}}信息</div>
      </md-card-header>
      <md-card-content>
        <div class="layout-row">
          <div class="flex">
            <md-field :class="getValidationClass('name','userForm')">
              <label>姓名</label>
              <md-input v-model="userForm.name" :disabled="sending"></md-input>
              <span class="md-error">此项不能为空，请输入用户姓名</span>
            </md-field>
            <md-field :class="getValidationClass('name','userForm')">
              <label>显示名称</label>
              <md-input v-model="userForm.nick_name" :disabled="sending"></md-input>
              <span class="md-error">此项不能为空，请输入显示名称</span>
            </md-field>
          </div>
          <avatar-upload v-model="userForm.avatar_id" :disabled="sending" style="padding-left: 10px;padding-top: 30px;" />
        </div>
      </md-card-content>
      <md-card-actions>
        <md-button type="submit" class="md-accent md-raised" :disabled="sending">保存</md-button>
      </md-card-actions>
    </md-card>
  </form>
</template>
<script>
  import AvatarUpload from "../common/AvatarUpload";
  import {
    validationMixin
  } from "vuelidate";
  import {
    required,
    minLength
  } from "vuelidate/lib/validators";
  export default {
    name: "myProfileUser",
    mixins: [validationMixin],
    components: {
      AvatarUpload
    },
    data() {
      return {
        sending: false,
        userForm: {
          id: '-1',
          name: ""
        }
      };
    },
    computed: {
      user() {
        return this.$root.configs.user;
      }
    },
    watch: {
      user() {
        this.userForm = v;
      }
    },
    validations: {
      userForm: {
        name: {
          required
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
        this.sending = true;
        this.$tip.waiting("正在保存资料...");
        this.$http.post("cbo/users/infos", this.userForm).then(
          res => {
            this.$tip.success('保存资料成功');
            this.sending = false;
          },
          err => {
            this.$toast(err);
            this.sending = false;
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
      this.userForm = this.user;
    }
  };
</script>
<style scoped>
  form {
    max-width: 600px;
    margin: 10px auto;
  }
</style>