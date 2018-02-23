<template>
  <md-part>
    <md-part-toolbar>
      <md-part-toolbar-group>
        <md-button @click.native="create">新增</md-button>
        <md-button @click.native="remove" :disabled="!(selectRows&&selectRows.length)">删除</md-button>
      </md-part-toolbar-group>
      <md-part-toolbar-group>
        <md-file-import md-entity="Gmf\Sys\Models\Dti" template="/assets/vendor/suite-cbo/files/suite.cbo.dti.item.xlsx"></md-file-import>
      </md-part-toolbar-group>
      <span class="flex"></span>
      <md-part-toolbar-group>
       <md-fetch :fetch="doFetch"></md-fetch>
      </md-part-toolbar-group>
    </md-part-toolbar>
    <md-part-body class="no-padding">
      <md-query @select="select" @dblclick="edit" :md-init="initQuery" ref="list" md-query-id="gmf.sys.dti.list"></md-query>
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
      this.$router.push({ name: 'module', params: { module: 'sys.dti.item.edit' } });
    },
    edit(item) {
      this.$router.push({ name: 'id', params: { module: 'sys.dti.item.edit', id: item.id } });
    },
    doFetch(q) {
      if (this.currentQ != q) {
        this.currentQ = q;
        this.loadData();
      }
      this.currentQ = q;
    },
    initQuery(options) {
      options.wheres.$filter = false;
      if (this.currentQ) {
        options.wheres.$filter = {
          "or": [
			{ like: {'code': this.currentQ }},
			{ like: {'name': this.currentQ }}
          ]
        };
      }
    },
    remove() {
      if (!this.selectRows || !this.selectRows.length) {
        this.$toast(this.$lang.LANG_NODELETEDATA);
        return;
      }
      this.loading++;
      const ids = this._.map(this.selectRows, 'id').toString();
      this.$http.delete('sys/dtis/' + ids).then(response => {
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
  },
  mounted() {},
};
</script>