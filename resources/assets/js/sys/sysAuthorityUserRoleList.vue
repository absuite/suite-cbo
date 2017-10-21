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
          <md-layout md-flex-small="33" md-flex-medium="15" md-flex-large="15">
            <md-input-container class="md-inset">
              <label>角色</label>
              <md-input-ref md-ref-id="gmf.sys.authority.role.ref" v-model="model.role"></md-input-ref>
            </md-input-container>
          </md-layout>
          <md-layout md-flex-small="33" md-flex-medium="15" md-flex-large="15">
            <md-input-container class="md-inset">
              <label>用户</label>
              <md-input-ref md-ref-id="gmf.sys.user.ref" v-model="model.user"></md-input-ref>
            </md-input-container>
          </md-layout>
          <md-layout>
            <md-button @click.native="loadData">查询</md-button>
          </md-layout>
        </md-layout>
      </md-part-toolbar-group>
    </md-part-toolbar>
    <md-part-body>
      <md-query @select="select" @dblclick="edit" @init="initQuery" ref="list" md-query-id="gmf.sys.authority.role.user.list"></md-query>
      <md-loading :loading="loading"></md-loading>
    </md-part-body>
  </md-part>
</template>
<script>
export default {
  data() {
    return {
      selectRows: [],
      loading: 0,
      model: { role: null, user: null }
    };
  },
  watch: {
    'model.role': function(value) {
      this.loadData();
    },
    'model.user': function(value) {
      this.loadData();
    },
  },
  methods: {
    create() {
      this.$router.push({ name: 'module', params: { module: 'sys.authority.user.role.edit' } });
    },
    edit(item) {
      
    },
    initQuery(options) {
      options.wheres.role = this.model.role;
      options.wheres.user = this.model.user;
    },
    remove() {
      if (!this.selectRows || !this.selectRows.length) {
        this.$toast(this.$lang.LANG_NODELETEDATA);
        return;
      }
      this.loading++;
      const ids = this._.map(this.selectRows, 'id').toString();
      this.$http.delete('sys/authority/role-users/' + ids).then(response => {
        this.loadData();
        this.loading--;
        this.$toast(this.$lang.LANG_DELETESUCCESS);
      }, response => {
        this.$toast(this.$lang.LANG_DELETEFAIL);
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