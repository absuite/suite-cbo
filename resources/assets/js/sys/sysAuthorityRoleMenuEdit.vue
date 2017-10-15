<template>
  <md-part>
    <md-part-toolbar>
      <md-part-toolbar-group>
        <md-button @click.native="save" :disabled="!canSave">保存</md-button>
        <md-button @click.native="cancel">放弃</md-button>
        <md-button @click.native="create">新增</md-button>
      </md-part-toolbar-group>
      <md-part-toolbar-group>
        <md-button @click.native="list">列表</md-button>
      </md-part-toolbar-group>
      <md-part-toolbar-pager @paging="paging" :options="model.pager"></md-part-toolbar-pager>
      <span class="flex"></span>
    </md-part-toolbar>
    <md-part-body>
      <md-content class="flex layout-column">
        <md-layout md-gutter>
          <md-layout md-flex-xsmall="100" md-flex-small="50" md-flex-medium="33" md-flex-large="20" md-flex-xlarge="20">
            <md-input-container>
              <label>角色</label>
              <md-input-ref required md-ref-id="gmf.sys.authority.role.ref" v-model="model.main.role">
              </md-input-ref>
            </md-input-container>
          </md-layout>
        </md-layout>
        <md-layout class="flex">
          <md-grid :datas="loadLineDatas" ref="grid" :row-focused="false" :auto-load="true" @onAdd="onLineAdd" :showAdd="true" :showRemove="true">
            <md-grid-column label="菜单" field="menu" dataType="entity" ref-id="gmf.sys.menu.ref" :ref-init="init_Menu_ref" width="200px" editable/>
            <md-grid-column label="uri"></md-grid-column>
          </md-grid>
        </md-layout>
      </md-content>
    </md-part-body>
    <md-ref @init="init_Menu_ref" md-ref-id="gmf.sys.menu.ref" ref="lineRef" @confirm="lineRefClose"></md-ref>
  </md-part>
</template>
<script>
import model from '../../gmf-sys/core/mixin/model';
import modelGrid from '../../gmf-sys/core/mixin/modelGrid';
export default {
  mixins: [model, modelGrid],
  computed: {
    canSave() {
      return this.validate(true);
    }
  },
  methods: {
    validate(notToast) {
      var validator = this.$validate(this.model.main, {
        role: 'required',
      });
      var fail = validator.fails();
      if (fail && !notToast) {
        this.$toast(validator.errors.all());
      }
      return !fail;
    },
    initModel() {
      return {
        main: {
          role: null
        }
      }
    },
    list() {
      this.$router.push({ name: 'module', params: { module: 'sys.authority.role.menu.list' } });
    },
    onLineAdd() {
      this.$refs['lineRef'].open();
    },
    lineRefClose(datas) {
      this._.forEach(datas, (v, k) => {
        this.$refs.grid && this.$refs.grid.addDatas({ menu: v});
      });
    },
    init_Menu_ref(options) {
      options.wheres.leaf = null;
    },

  },
  created() {
    this.model.entity = 'sys.authority.role.menu';
    this.model.order = "created_at";
    this.route = 'sys/authority/role-menus';
  },
};
</script>