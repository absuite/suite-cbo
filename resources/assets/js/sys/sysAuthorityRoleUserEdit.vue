<template>
  <md-part>
    <md-part-toolbar>
      <md-part-toolbar-group>
        <md-button @click.native="save" :disabled="!canSave">保存</md-button>
        <md-button @click.native="create">新增</md-button>
      </md-part-toolbar-group>
      <md-part-toolbar-group>
        <md-button @click.native="list">列表</md-button>
      </md-part-toolbar-group>
      <span class="flex"></span>
    </md-part-toolbar>
    <md-part-body>
      <md-content class="flex layout-column">
        <md-layout md-gutter>
          <md-layout md-flex-xs="100" md-flex-sm="50" md-flex-md="33" md-flex="20">
            <md-ref-input md-label="角色" required md-ref-id="gmf.sys.authority.role.ref" v-model="model.role">
            </md-ref-input>
          </md-layout>
        </md-layout>
        <md-layout class="flex">
          <md-grid :datas="fetchLineDatas" ref="grid" :row-focused="false" :auto-load="true" @onAdd="onLineAdd" :showAdd="true" :showRemove="true">
            <md-grid-column label="用户" field="user" dataType="entity" ref-id="gmf.sys.user.ref" :ref-init="init_User_ref" width="200px"
              editable/>
            <md-grid-column label="昵称">
              <template slot-scope="row">
                {{ row.user&&row.user.nick_name ||''}}
              </template>
            </md-grid-column>
          </md-grid>
        </md-layout>
      </md-content>
    </md-part-body>
    <md-ref :md-init="init_User_ref" md-ref-id="gmf.sys.user.ref" ref="lineRef" @confirm="lineRefClose"></md-ref>
    <md-loading :loading="loading"></md-loading>
  </md-part>
</template>
<script>
  import _extend from 'lodash/extend'
  import _forEach from 'lodash/forEach'
  import MdValidate from 'cbo/mixins/MdValidate/MdValidate';
  export default {
    mixins: [MdValidate],
    data() {
      return {
        model: {
          role: null,
        },
        loading: 0,
        route: ''
      };
    },
    watch: {
      'model.role.id': function (value, oldValue) {
        value && this.loadLineData(value);
      }
    },
    computed: {
      canSave() {
        return this.validate(true);
      }
    },
    methods: {
      validate(notToast) {
        var validator = this.$validate(this.model, {
          role: 'required',
        });
        var fail = validator.fails();
        if (fail && !notToast) {
          this.$toast(validator.errors.all());
        }
        return !fail;
      },
      async fetchLineDatas({
        pager
      }) {
        if (!this.model.role) {
          return [];
        }
        const params = _extend({}, pager, {
          role_id: this.model.role.id
        });
        return await this.$http.get(this.route + '/', {
          params: params
        });
      },
      loadLineData() {
        this.$refs.grid && this.$refs.grid.refresh();
      },
      create() {
        this.model.role = null;
      },
      save() {
        this.loading++;
        this.$refs.grid.endEdit();
        const postDatas = this.$refs.grid.getPostDatas();
        this.$http.post(this.route, {
          datas: postDatas
        }).then(response => {
          this.loadLineData();
          this.loading--;
          this.$toast(this.$lang.LANG_SAVESUCCESS);
        }, response => {
          this.loading--;
          this.$toast(response);
          this.loadLineData();
        });
      },
      list() {
        this.$router.push({
          name: 'module',
          params: {
            module: 'sys.authority.role.user.list'
          }
        });
      },
      async loadRole(id) {
        const res = await this.$http.get('sys/authority/roles/' + id);
        this.$set(this.model, 'role', res.data.data);
      },
      onLineAdd() {
        this.$refs['lineRef'].open();
      },
      lineRefClose(datas) {
        _forEach(datas, (v, k) => {
          this.$refs.grid && this.$refs.grid.addDatas({
            user: v,
            role: this.model.role
          });
        });
      },
      init_User_ref(options) {
        options.wheres.leaf = null;
      },
    },
    created() {
      this.route = 'sys/authority/role-users';
    },
    mounted() {
      if (this.$route && this.$route.params && this.$route.params.id) {
        this.loadRole(this.$route.params.id);
      }
    },
  };
</script>