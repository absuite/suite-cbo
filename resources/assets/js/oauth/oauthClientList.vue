<template>
  <md-part>
    <md-part-toolbar>
      <md-part-toolbar-group>
        <md-button @click.native="create">新增</md-button>
        <md-button @click.native="remove" :disabled="!(selectRows&&selectRows.length)">删除</md-button>
      </md-part-toolbar-group>
    </md-part-toolbar>
    <md-part-body>
      <md-query @select="select" @dblclick="edit" ref="list" md-query-id="gmf.oauth.client.list"></md-query>
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
        loading:0
      };
    },
    methods: {
      create(){
        this.$router.push({ name: 'module', params: { module: 'oauth.client.edit' }});
      },
      edit(item){
        this.$router.push({ name: 'id', params: { module: 'oauth.client.edit',id:item.id }});
      },
      remove(){
        if(!this.selectRows||!this.selectRows.length){
          this.$toast(this.$lang.LANG_NODELETEDATA);
          return;
        }
        this.loading++;
        const ids=_map(this.selectRows,'id').toString();
        this.$http.delete('/oauth/clients/'+ids).then(response => {
          this.loadData();
          this.loading--;
          this.$toast(this.$lang.LANG_DELETESUCCESS);
        }, response => {
          this.$toast(response);
          this.loading--;
        });
      },
      select(items){
        this.selectRows=items;
      },
      load(){
        this.$refs.list.pagination(1);
      }
    }
  };
</script>
