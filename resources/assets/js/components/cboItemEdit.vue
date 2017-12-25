<template>
  <md-part>
    <md-part-toolbar>
      <md-part-toolbar-group>
        <md-button @click.native="save" :disabled="!canSave">保存</md-button>
        <md-button @click.native="cancel">放弃</md-button>
        <md-button @click.native="create">新增</md-button>
      </md-part-toolbar-group>
      <md-part-toolbar-group>
        <md-button @click.native="copy" :disabled="!canCopy">复制</md-button>
      </md-part-toolbar-group>
      <md-part-toolbar-group>
        <md-button @click.native="list">列表</md-button>
      </md-part-toolbar-group>
      <md-part-toolbar-pager @paging="paging" :options="model.pager"></md-part-toolbar-pager>
      <md-part-toolbar-group>
        <cbo-file-import @import="importData" template="/assets/vendor/suite-cbo/files/suite.cbo.item.xlsx"></cbo-file-import>
      </md-part-toolbar-group>
      <span class="flex"></span>
    </md-part-toolbar>
    <md-part-body>
      <md-content>
        <md-field>
          <label>编码</label>
          <md-input required v-model="model.main.code"></md-input>
        </md-field>
        <md-field>
          <label>名称</label>
          <md-input required v-model="model.main.name"></md-input>
        </md-field>
        <md-field>
          <label>形态</label>
          <md-enum md-enum-id="suite.cbo.item.form.enum" v-model="model.main.form_enum"></md-enum>
        </md-field>
        <md-ref-input md-label="分类" md-ref-id="suite.cbo.item.category.ref" v-model="model.main.category" />
        <md-ref-input md-label="计量单位" required md-ref-id="suite.cbo.unit.ref" v-model="model.main.unit"></md-ref-input>
        <md-field>
          <label>默认单价</label>
          <md-input type="number" v-model="model.main.price"></md-input>
        </md-field>
        <md-checkbox required v-model="model.main.is_effective">生效的</md-checkbox>
        <md-field>
          <label>备注</label>
          <md-textarea v-model="model.main.memo"></md-textarea>
        </md-field>
      </md-content>
      <md-loading :loading="loading"></md-loading>
    </md-part-body>
  </md-part>
</template>
<script>
import model from 'gmf/core/mixins/MdModel/MdModel';
export default {
  data() {
    return {};
  },
  mixins: [model],
  computed: {
    canSave() {
      return this.validate(true);
    }
  },
  methods: {
    validate(notToast) {
      var validator = this.$validate(this.model.main, {
        'code': 'required',
        'name': 'required',
        'unit': 'required',
      });
      var fail = validator.fails();
      if (fail && !notToast) {
        this.$toast(validator.errors.all());
      }
      return !fail;
    },
    initModel() {
      return {
        main: { 'code': '', 'name': '', 'memo': '', is_effective: true, category: null, unit: null }
      }
    },
    list() {
      this.$router.push({ name: 'module', params: { module: 'cbo.item.list' } });
    },
  },
  created() {
    this.model.entity = 'suite.cbo.item';
    this.model.order = "code";
    this.route = 'cbo/items';
  },
};
</script>