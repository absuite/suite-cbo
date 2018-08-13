<template>
  <md-dialog :md-active.sync="showDia" @md-closed="onCloseDia">
    <form novalidate @submit.prevent="validateForm" class="layout-column">
      <md-dialog-title>添加用户</md-dialog-title>
      <md-dialog-content>
        <md-field :class="getValidationClass('account')">
          <label>电子邮件</label>
          <md-input type="email" v-model="form.account" :disabled="sending" />
          <span class="md-error">此项不能为空，请输入完整的电子邮件！</span>
        </md-field>
        <md-field :class="getValidationClass('name')">
          <label>姓名</label>
          <md-input v-model="form.name" :disabled="sending" />
          <span class="md-error">此项不能为空，请输入用户姓名</span>
        </md-field>
      </md-dialog-content>
      <md-dialog-actions>
        <md-button @click="onCloseDia">取消</md-button>
        <md-button class="md-primary" type="submit" :disabled="sending">添加</md-button>
      </md-dialog-actions>
      <md-progress-bar md-mode="indeterminate" v-if="sending" />
    </form>
  </md-dialog>
</template>
<script>
  import {
    validationMixin
  } from 'vuelidate'
  import {
    required,
    email
  } from 'vuelidate/lib/validators'
  export default {
    name: "UserAddDia",
    mixins: [validationMixin],
    props: {
      mdActive: Boolean
    },
    validations: {
      form: {
        name: {
          required,
        },
        account: {
          required,
          email
        }
      }
    },
    data() {
      return {
        showDia: this.mdActive,
        form: {
          name: null,
          account: null,
        },
        sending: false,
      };
    },
    watch: {
      mdActive(visible) {
        this.showDia = visible;
      }
    },
    methods: {
      getValidationClass(fieldName) {
        const field = this.$v.form[fieldName]
        if (field) {
          return {
            'md-invalid': field.$invalid && field.$dirty
          }
        }
      },
      saveForm() {
        this.sending = true;
        this.$http.post('cbo/users/create', this.form).then(res => {
          this.sending = false;
          this.onCloseDia();
          this.$emit("md-confirm", res.data.data);
        }, err => {
          this.$toast(err);
        });
      },
      onCloseDia() {
        this.$emit("update:mdActive", false);
      },
      validateForm() {
        this.$v.$touch()
        if (!this.$v.$invalid) {
          this.saveForm()
        }
      }
    },
    mounted() {

    }
  };
</script>
<style lang="scss" scoped>
</style>