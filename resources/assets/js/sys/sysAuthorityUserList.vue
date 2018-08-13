<template>
  <md-part>
    <md-part-toolbar>
      <md-part-toolbar-group>
        <md-button @click.native="showCreateUser=true">添加用户</md-button>
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
            <md-button @click.native="loadData()">查询</md-button>
          </md-layout>
        </md-layout>
      </md-part-toolbar-group>
    </md-part-toolbar>
    <md-part-body>
      <md-table v-model="mainDatas" md-card>
        <md-table-row slot="md-table-row" slot-scope="{ item }">
          <md-table-cell md-label="头像" width="160px">
            <md-avatar>
              <img :src="item.avatar" alt="Avatar">
            </md-avatar>
          </md-table-cell>
          <md-table-cell md-label="姓名" width="200px">{{ item.name }}</md-table-cell>
          <md-table-cell md-label="账号">{{ item.account }}</md-table-cell>
          <md-table-cell md-label="状态"  width="150px">{{ item.is_effective>0?'正常':'未生效' }}</md-table-cell>
          <md-table-cell md-label="操作"  width="250px">
            <md-button class="md-primary" @click="onEditItem(item)">编辑</md-button>
            <md-button :disabled="item.is_effective<=0" @click="setDisabled(item)">停用</md-button>
            <md-button :disabled="item.is_effective>0" class="md-primary" @click="setEffective(item)">启用</md-button>
          </md-table-cell>
        </md-table-row>
      </md-table>
      <md-pagination :pager="mainPager" @pagination="loadData"></md-pagination>
      <md-loading :loading="loading"></md-loading>
    </md-part-body>
    <user-add-dia :md-active.sync="showCreateUser" @md-confirm="onUserCreate"></user-add-dia>
    <md-drawer class="md-right" :md-active.sync="showEditUser">
      <md-toolbar class="md-transparent" md-elevation="0">
        <span class="md-title">输入</span>
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
import _map from "lodash/map";
import UserAddDia from "./components/UserAddDia";
export default {
  name: "sysAuthorityUserList",
  components: {
    UserAddDia,
  },
  data() {
    return {
      mainDatas: [],
      mainPager: false,
      showCreateUser: false,
      showEditUser: false,
      loading: 0,
      model: {
        role: null,
        user: null
      }
    };
  },
  watch: {
    "model.role": function(value) {
      this.loadData();
    },
    "model.user": function(value) {
      this.loadData();
    }
  },
  methods: {
    onUserCreate(item) {
      this.mainDatas.push(item);
    },
    onEditItem(item) {},
    setDisabled(item) {
      this.$http.post("cbo/users/disabled", { ids: item.id }).then(
        res => {
          item.is_effective = 0;
        },
        err => {
          this.$toast(err);
        }
      );
    },
    setEffective(item) {
      this.$http.post("cbo/users/effective", { ids: item.id }).then(
        res => {
          item.is_effective = 1;
        },
        err => {
          this.$toast(err);
        }
      );
    },
    loadData(pager) {
      const options = {
        params: {}
      };
      if (pager) {
        options.params.page = pager.page;
        options.params.size = pager.size;
      }
      this.loading++;
      this.$http.get("cbo/users/all", options).then(
        res => {
          this.mainDatas = res.data.data;
          this.mainPager = res.data.pager;
          this.loading--;
        },
        err => {
          this.$toast(err);
          this.loading--;
        }
      );
    }
  },
  mounted() {
    this.loadData();
  }
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

.md-part-body {
}
.md-table {
  .md-button {
    min-width: 0px;
  }
}
</style>