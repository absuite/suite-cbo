<template>
  <md-part>
    <md-part-toolbar>
      <md-part-toolbar-group>
        <md-button @click.native="create">新增</md-button>
        <md-button @click.native="remove" :disabled="!(selectRows&&selectRows.length)">删除</md-button>
      </md-part-toolbar-group>
      <div></div>
      <md-part-toolbar-group class="flex">
        <md-layout md-gutter md-align="end">
          <md-layout md-flex-sm="33"  md-flex="15">
            <md-ref-input md-label="角色" md-ref-id="gmf.sys.authority.role.ref" v-model="model.role"></md-ref-input>
          </md-layout>
          <md-layout md-flex-sm="33"  md-flex="15">
            <md-ref-input md-label="菜单" md-ref-id="gmf.sys.menu.ref" v-model="model.menu"></md-ref-input>
          </md-layout>
          <md-layout>
            <md-button @click.native="loadData">查询</md-button>
          </md-layout>
        </md-layout>
      </md-part-toolbar-group>
    </md-part-toolbar>
    <md-part-body class="no-padding">
      <md-query @select="select" @dblclick="edit" :md-init="initQuery" ref="list" md-query-id="gmf.sys.authority.role.menu.list"></md-query>
      <md-loading :loading="loading"></md-loading>
    </md-part-body>
  </md-part>
</template>
<script>
import _map from 'lodash/map'
export default {
  data() {
    return {
      selectRows: [],
      loading: 0,
      model: { role: null, menu: null }
    };
  },
  watch: {
    'model.role': function(value) {
      this.loadData();
    },
    'model.menu': function(value) {
      this.loadData();
    },
  },
  methods: {
    create() {
      this.$router.push({ name: 'module', params: { module: 'sys.authority.role.menu.edit' } });
    },
    edit(item) {

    },
    initQuery(options) {
      options.wheres.role = this.model.role;
      options.wheres.menu = this.model.menu;
    },
    remove() {
      if (!this.selectRows || !this.selectRows.length) {
        this.$toast(this.$lang.LANG_NODELETEDATA);
        return;
      }
      this.loading++;
      const ids = _map(this.selectRows, 'id').toString();
      this.$http.delete('sys/authority/role-menus/' + ids).then(response => {
        this.loadData();
        this.loading--;
        this.$toast(this.$lang.LANG_DELETESUCCESS);
      }, response => {
        this.$toast(response);
        this.loading--;
      });
    },
    select(items) {
      this.selectRows = items;
    },
    loadData() {
      this.$refs.list.pagination(1);
    }
  }
};
</script>