<template>
  <md-part>
    <md-part-toolbar>
      <md-part-toolbar-group>
        <md-button @click.native="create">创建用户</md-button>
        <md-button @click.native="create">添加用户</md-button>
      </md-part-toolbar-group>
      <div></div>
      <md-part-toolbar-group class="flex">
        <md-layout md-gutter md-align="end">
          <md-layout md-flex-sm="33" md-flex="15">
            <md-ref-input md-label="角色" md-ref-id="gmf.sys.authority.role.ref" v-model="model.role"></md-ref-input>
          </md-layout>
          <md-layout md-flex-sm="33" md-flex="15">
            <md-ref-input md-label="用户" md-ref-id="gmf.sys.user.ref" v-model="model.user"></md-ref-input>
          </md-layout>
          <md-layout>
            <md-button @click.native="loadData">查询</md-button>
          </md-layout>
        </md-layout>
      </md-part-toolbar-group>
    </md-part-toolbar>
    <md-part-body>
      <md-layout md-gutter>
        <md-card class="user-card" v-for="item in mainDatas.data" :key="item.id">
          <md-card-header>
            <md-avatar>
              <img :src="item.avatar" alt="Avatar">
            </md-avatar>
            <div class="md-title">{{item.name}}</div>
            <div class="md-subhead">{{item.account}}</div>
          </md-card-header>
        </md-card>
      </md-layout>
      <md-loading :loading="loading"></md-loading>
    </md-part-body>
    <md-drawer class="md-right" :md-active.sync="showCreateUser">
      <md-toolbar class="md-transparent" md-elevation="0">
        <span class="md-title">Favorites</span>
      </md-toolbar>

      <md-list>
        <md-list-item>
          <span class="md-list-item-text">Abbey Christansen</span>

          <md-button class="md-icon-button md-list-action">
            <md-icon class="md-primary">chat_bubble</md-icon>
          </md-button>
        </md-list-item>

        <md-list-item>
          <span class="md-list-item-text">Alex Nelson</span>

          <md-button class="md-icon-button md-list-action">
            <md-icon class="md-primary">chat_bubble</md-icon>
          </md-button>
        </md-list-item>

        <md-list-item>
          <span class="md-list-item-text">Mary Johnson</span>

          <md-button class="md-icon-button md-list-action">
            <md-icon>chat_bubble</md-icon>
          </md-button>
        </md-list-item>
      </md-list>
    </md-drawer>
  </md-part>
</template>
<script>
  import _map from 'lodash/map'
  export default {
    name: 'sysAuthorityUserList',
    data() {
      return {
        mainDatas: {},
        showCreateUser: false,
        loading: 0,
        model: {
          role: null,
          user: null
        }
      };
    },
    watch: {
      'model.role': function (value) {
        this.loadData();
      },
      'model.user': function (value) {
        this.loadData();
      },
    },
    methods: {
      create() {
        this.showCreateUser = true;
      },
      remove() {},
      loadData() {
        const options = {
          params: {}
        };
        this.loading++;
        this.$http.get('cbo/users/all', options).then(response => {
          this.mainDatas = response.data;
          this.loading--;
        }, response => {
          this.$toast(response);
          this.loading--;
        });
      }
    },
    mounted() {
      this.loadData();
    },
  };
</script>
<style lang="scss" scoped>
  .user-card {
    width: 300px;
    max-width: 100%;
    margin: 15px;
  }

  .md-part {
    padding: 0px;
    max-width: 100%;
    overflow: hidden;
  }

  .md-part-body {}
</style>