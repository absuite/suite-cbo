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
            <md-grid-column label="实体*" field="entity" dataType="entity" ref-id="gmf.sys.entity.ref" :ref-init="init_Entity_ref" width="200px" editable>
              <template slot-scope="row">
                {{ row.entity&&row.entity.comment ||''}}
              </template>
            </md-grid-column>
            <md-grid-column label="名称">
              <template slot-scope="row">
                {{ row.entity&&row.entity.name ||''}}
              </template>
            </md-grid-column>
            <md-grid-column label="字段" field="field" dataType="entity" ref-id="gmf.sys.entity.field.ref" :ref-init="init_Field_ref" width="200px" editable>
              <template slot-scope="row">
                {{ row.field&&row.field.comment ||row.field&&row.field.name||''}}
              </template>
            </md-grid-column>
            <md-grid-column label="数据值*" field="data" dataType="entity" :ref-init="init_Data_ref" :ref-id="getDataRefId" width="200px" editable/>
            <md-grid-column label="数据名称">
              <template slot-scope="row">
                {{ row.data_name}}
              </template>
            </md-grid-column>
            <md-grid-column label="条件" field="filter" width="200px" editable></md-grid-column>
            <md-grid-column label="操作类型" field="operation_enum" dataType="enum" ref-id="gmf.sys.authority.data.operation.type.enum" editable></md-grid-column>
          </md-grid>
        </md-layout>
      </md-content>
    </md-part-body>
    <md-ref :md-init="init_Entity_ref" md-ref-id="gmf.sys.entity.ref" ref="lineRef" @confirm="lineRefClose"></md-ref>
    <md-loading :loading="loading"></md-loading>
  </md-part>
</template>
<script>
import _forEach from "lodash/forEach";
import _extend from "lodash/extend";
import MdValidate from "cbo/mixins/MdValidate/MdValidate";
export default {
  mixins: [MdValidate],
  data() {
    return {
      lineRefID: "",
      model: {
        role: null
      },
      loading: 0,
      route: ""
    };
  },
  watch: {
    "model.role.id": function(value, oldValue) {
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
        role: "required"
      });
      var fail = validator.fails();
      if (fail && !notToast) {
        this.$toast(validator.errors.all());
      }
      return !fail;
    },
    async fetchLineDatas({ pager }) {
      if (!this.model.role) {
        return [];
      }
      const params = _extend({}, pager, { role_id: this.model.role.id });
      return await this.$http.get(this.route + "/", { params: params });
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
      _forEach(postDatas, (v, k) => {
        if (v.data) {
          v.data_name = v.data.name;
          v.data_id = v.data.id;
          v.data_type = "Suite\\Amiba\\Models\\Group";
        }
      });
      this.$http.post(this.route, { datas: postDatas }).then(
        response => {
          this.loadLineData();
          this.loading--;
          this.$toast(this.$lang.LANG_SAVESUCCESS);
        },
        response => {
          this.loading--;
          this.$toast(response);
          this.loadLineData();
        }
      );
    },
    list() {
      this.$router.push({
        name: "module",
        params: { module: "sys.authority.role.entity.list" }
      });
    },
    async loadRole(id) {
      const res = await this.$http.get("sys/authority/roles/" + id);
      this.$set(this.model, "role", res.data.data);
    },
    onLineAdd() {
      this.$refs["lineRef"].open();
    },
    lineRefClose(datas) {
      _forEach(datas, (v, k) => {
        this.$refs.grid &&
          this.$refs.grid.addDatas({ entity: v, role: this.model.role });
      });
    },
    getDataRefId(row) {
      if (row && row.entity && row.entity.name) {
        if (row.field && row.field.name == "id")
          return row.entity.name + ".ref";
        else if (row.field && row.field.type_enum == "entity") {
          return row.field.type_type + ".ref";
        } else {
          return "";
        }
      }
      return "";
    },
    init_Data_ref(options) {
      //options.wheres.$leaf = { is_leaf: '1' };
    },
    init_Entity_ref(options, row) {
      options.wheres.type = "entity";
    },
    init_Field_ref(options, row) {
      options.wheres.entity_id = row && row.entity ? row.entity.id : "-1";
    }
  },
  created() {
    this.route = "sys/authority/role-entities";
  },
  mounted() {
    if (this.$route && this.$route.params && this.$route.params.id) {
      this.loadRole(this.$route.params.id);
    }
  }
};
</script>