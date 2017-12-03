<template>
  <md-part>
    <md-part-toolbar>
      <md-part-toolbar-group>
        <md-button @click.native="create">新增</md-button>
      </md-part-toolbar-group>
      <span class="flex"></span>
      <md-part-toolbar-group>
        <md-fetch :fetch="doFetch"></md-fetch>
      </md-part-toolbar-group>
    </md-part-toolbar>
    <md-part-body class="no-padding">
      <md-query @select="select" @dblclick="edit" @init="initQuery" ref="list" md-query-id="gmf.sys.ent.list"></md-query>
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
      this.$router.push({ name: 'module', params: { module: 'sys.ent.edit' } });
    },
    edit(item) {
      this.$router.push({ name: 'id', params: { module: 'sys.ent.edit', id: item.id } });
    },
    doFetch(q) {
      if (this.currentQ != q) {
        this.currentQ = q;
        this.loadData();
      }
      this.currentQ = q;
    },
    initQuery(options) {
      options.wheres.filter = false;
      if (this.currentQ) {
        options.wheres.filter = {
          "or": [
            { name: 'code', operator: 'like', value: this.currentQ },
            { name: 'name', operator: 'like', value: this.currentQ }
          ]
        };
      }
    },
    remove() {

    },
    select(items) {
      this.selectRows = items;
    },
    loadData() {
      this.$refs.list.pagination(1);
    }
  },
  mounted() {},
};
</script>