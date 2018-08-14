<template>
  <md-dialog :md-active.sync="showDia" @md-closed="onCloseDia" @md-opened="onOpened">
    <md-progress-bar md-mode="indeterminate" v-if="sending" />
    <md-dialog-title>添加用户</md-dialog-title>
    <form novalidate @submit.prevent="validateAccountForm" class="layout-column" v-if="stepper=='showAccount'">
      <md-dialog-content>
        <md-field :class="getValidationClass('account','accountForm')">
          <label>登录账号</label>
          <md-input type="email" v-model="accountForm.account" :disabled="sending" />
          <span class="md-error">此项不能为空，建议使用工号、邮箱、或者电话号码！</span>
          <span class="md-helper-text">账号是登录系统的凭据，一般使用工号、邮箱、或者电话号码</span>
        </md-field>
      </md-dialog-content>
      <md-dialog-actions>
        <md-button @click="onCloseDia">取消</md-button>
        <md-button class="md-primary" type="submit" :disabled="sending">下一步</md-button>
      </md-dialog-actions>
    </form>
    <div class="layout-column" v-if="stepper=='showUser'">
      <md-dialog-content>
        <md-card>
          <md-card-header>
            <md-avatar>
              <img :src="oldUser.avatar" alt="Avatar">
            </md-avatar>
            <div class="md-title">{{oldUser.name}}</div>
            <div class="md-subhead">{{oldUser.account}}</div>
          </md-card-header>
        </md-card>
      </md-dialog-content>
      <md-dialog-actions>
        <md-button @click="onPreStep('showAccount')">上一步</md-button>
        <md-button class="md-primary" :disabled="sending" @click="onAddUser">完成</md-button>
      </md-dialog-actions>
    </div>
    <form novalidate @submit.prevent="validateUserForm" class="layout-column" v-if="stepper=='showInput'">
      <md-dialog-content>
        <md-field>
          <label>账号</label>
          <md-input v-model="accountForm.account" disabled />
        </md-field>
        <md-field :class="getValidationClass('name','userForm')">
          <label>姓名</label>
          <md-input v-model="userForm.name" :disabled="sending" />
          <span class="md-error">此项不能为空，请输入用户姓名</span>
        </md-field>
        <md-field>
          <label>设置密码</label>
          <md-input v-model="userForm.password" type="password" :disabled="sending"></md-input>
        </md-field>
      </md-dialog-content>
      <md-dialog-actions>
        <md-button @click="onPreStep('showAccount')">上一步</md-button>
        <md-button class="md-primary" type="submit" :disabled="sending">添加</md-button>
      </md-dialog-actions>
    </form>
  </md-dialog>
</template>
<script>
import { validationMixin } from "vuelidate";
import { required, minLength } from "vuelidate/lib/validators";
export default {
  name: "UserAddDia",
  mixins: [validationMixin],
  props: {
    mdActive: Boolean
  },
  validations: {
    accountForm: {
      account: {
        required,
        minLength: minLength(3)
      }
    },
    userForm: {
      name: {
        required
      },
      account: {
        required
      }
    }
  },
  data() {
    return {
      stepper: "showAccount",
      oldUser: null,
      showDia: this.mdActive,
      accountForm: {
        account: null
      },
      userForm: {
        name: null,
        account: null
      },
      sending: false
    };
  },
  watch: {
    mdActive(visible) {
      this.showDia = visible;
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

    onCloseDia() {
      this.$emit("update:mdActive", false);
    },
    onOpened() {
      this.$v.$reset();
      this.accountForm.account = "";
      this.stepper = "showAccount";
    },
    onPreStep(step) {
      this.stepper = step;
    },
    onAddUser() {
      this.sending = true;
      this.$http.post("cbo/users/join", this.oldUser).then(
        res => {
          this.sending = false;
          this.$emit("md-confirm", res.data.data);
          this.onCloseDia();
        },
        err => {
          this.sending = false;
          this.$toast(err);
        }
      );
    },
    saveUserForm() {
      this.sending = true;
      this.$http.post("cbo/users/create", this.userForm).then(
        res => {
          this.sending = false;
          this.$emit("md-confirm", res.data.data);
          this.onCloseDia();
        },
        err => {
          this.$toast(err);
        }
      );
    },
    validateUserForm() {
      this.userForm.account = this.accountForm.account;
      this.$v.userForm.$touch();
      if (this.$v.userForm.$invalid) return;
      this.saveUserForm();
    },
    validateAccountForm() {
      this.$v.accountForm.$touch();
      if (this.$v.accountForm.$invalid) return;
      this.sending = true;
      this.$http.post("cbo/users/checker", this.accountForm).then(
        res => {
          if (res && res.data && res.data.data) {
            this.oldUser = res.data.data;
            this.stepper = "showUser";
          } else {
            this.stepper = "showInput";
          }
          this.sending = false;
        },
        err => {
          this.sending = false;
          this.$toast(err);
        }
      );
    }
  },
  mounted() {}
};
</script>
<style lang="scss" scoped>
.md-dialog {
  width: 500px;
}
</style>