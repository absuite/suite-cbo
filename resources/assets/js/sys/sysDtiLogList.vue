<template>
  <md-part>
    <md-part-toolbar>
      <md-part-toolbar-group>
        <md-button @click.native="remove" :disabled="!(selectRows&&selectRows.length)">删除</md-button>
      </md-part-toolbar-group>
      <span class="flex"></span>
      <md-part-toolbar-group>
        <md-fetch :fetch="doFetch"></md-fetch>
      </md-part-toolbar-group>
    </md-part-toolbar>
    <md-part-body class="no-padding">
      <md-query @select="select" ref="list" :md-init="initQuery" md-query-id="gmf.sys.dti.log.list"></md-query>
    </md-part-body>
    <md-loading :loading="loading"></md-loading>
  </md-part>
</template>
<script>
import _map from 'lodash/map'
export default {
  data() {
    return {
      selectRows: [],
      loading: 0
    };
  },
  methods: {
    remove() {
      if (!this.selectRows || !this.selectRows.length) {
        this.$toast(this.$lang.LANG_NODELETEDATA);
        return;
      }
      this.loading++;
      const ids =_map(this.selectRows, 'id').toString();
      this.$http.delete('sys/dti-logs/' + ids).then(response => {
        this.loadData();
        this.loading--;
        this.$toast(this.$lang.LANG_DELETESUCCESS);
      }, response => {
        this.$toast(response);
        this.loading--;
      });
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
        var isDate = this.currentQ.match(/^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2})$/);
        options.wheres.$filter = {
          "or": [
			{ like: {'dti.name': this.currentQ }},
			{ like: {'dti.category.name': this.currentQ }}
          ]
        };
        if (isDate) {
          options.wheres.$filter.or.push({'gte':{'date':this.currentQ}});
        }
      }
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