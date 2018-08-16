<template>
  <md-drawer :md-active.sync="showDrawer" @md-opened="onOpened" class="md-right" @md-closed="onCloseDrawer" :md-click-outside-to-close="false">
    <md-toolbar class="md-transparent" md-elevation="0">
      <span class="md-title" style="flex: 1">修改账号信息</span>
      <md-button class="md-icon-button" @click="onCloseDrawer">
        <md-icon>close</md-icon>
      </md-button>
    </md-toolbar>
    <md-card class="md-elevation-0">
      <md-card-header>
        <md-avatar>
          <img :src="mainData.avatar" alt="Avatar">
        </md-avatar>
        <md-card-header-text>
          <div class="md-title">{{mainData.name}}</div>
          <div class="md-subhead">{{mainData.account}}</div>
        </md-card-header-text>
      </md-card-header>
      <md-divider></md-divider>
      <md-card-content>
        <md-field>
          <label>姓名</label>
          <md-input autocomplete="off" v-model="mainData.name" :disabled="sending" />
        </md-field>
        <md-button class="md-primary md-raised" :disabled="sending" @click="onSaveInfo">保存</md-button>
      </md-card-content>
      <md-divider></md-divider>
      <md-card-content>
        <md-field>
          <label>密码</label>
          <md-input autocomplete="off" v-model="mainData.password" type="password" :disabled="sending"></md-input>
        </md-field>
        <md-button class="md-primary md-raised" :disabled="sending" @click="onSavePassword">重设密码</md-button>
      </md-card-content>
    </md-card>
  </md-drawer>
</template>
<script>
  export default {
    name: "CboUserEditDrawer",
    props: {
      mdId: String,
      mdActive: Boolean
    },
    data() {
      return {
        showDrawer: this.mdActive,
        sending: false,
        mainData: {},
      };
    },
    watch: {
      mdActive(visible) {
        this.showDrawer = visible;
      }
    },
    methods: {
      onOpened() {
        this.fetchMainData();
      },
      onCloseDrawer() {
        this.$emit("update:mdActive", false);
      },
      fetchMainData() {
        if (!this.mdId) {
          this.mainData = {};
          return;
        }
        this.$http.get("cbo/users/show/" + this.mdId).then(
          res => {
            this.mainData = res.data.data || {};
          },
          err => {
            this.$toast(err);
          }
        );
      },
      onSaveInfo() {
        if (!this.mainData.name) {
          this.$toast('姓名不能为空！');
          return;
        }
        this.$http.post("cbo/users/infos", this.mainData).then(
          res => {
            this.$emit("md-confirm", res.data.data);
            this.$toast('保存成功');
          },
          err => {
            this.$toast(err);
          }
        );
      },
      onSavePassword() {
        if (!this.mainData.password) {
          this.$toast('密码不能为空！');
          return;
        }
        this.$http.post("cbo/users/password", this.mainData).then(
          res => {
            this.$emit("md-confirm", res.data.data);
            this.$toast('密码设置成功');
          },
          err => {
            this.$toast(err);
          }
        );
      },
    },
  };
</script>
<style lang="scss" scoped>
  .md-drawer {
    overflow: hidden;
    width: 420px;
    .md-toolbar:first-child {
      border-bottom: 1px solid rgba(0, 59, 77, 0.2);
    }
    .md-toolbar:last-child {
      border-top: 1px solid rgba(0, 59, 77, 0.2);
    }
    .md-content {
      background: transparent !important;
      overflow: auto;
      padding-left: 15px;
      padding-right: 15px;
      overflow-x: hidden;
      overflow-y: auto;
    }
    .md-button {
      box-shadow: none !important;
    }
  }
</style>