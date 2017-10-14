<template>
  <md-part>
    <md-part-toolbar>
      <md-part-toolbar-group>
        <md-button @click.native="create">新增</md-button>
        <md-button @click.native="remove" :disabled="!(selectRows&&selectRows.length)">删除</md-button>
      </md-part-toolbar-group>
    </md-part-toolbar>
    <md-part-body>
      <md-query @select="select" @dblclick="edit" ref="list" md-query-id="gmf.sys.authority.permit.list"></md-query>
    </md-part-body>
    <md-loading :loading="loading"></md-loading>
  </md-part>
</template>
<script>
export default {
  data() {
    return {
      selectRows: [],
      loading: 0
    };
  },
  methods: {
    create() {
      this.$router.push({ name: 'module', params: { module: 'sys.authority.permit.edit' } });
    },
    edit(item) {
      this.$router.push({ name: 'id', params: { module: 'sys.authority.permit.edit', id: item.id } });
    },
    remove() {
      if (!this.selectRows || !this.selectRows.length) {
        this.$toast(this.$lang.LANG_NODELETEDATA);
        return;
      }
      this.loading++;
      const ids = this._.map(this.selectRows, 'id').toString();
      this.$http.delete('sys/permits/' + ids).then(response => {
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