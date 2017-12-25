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
        <cbo-file-import @import="importData" template="/assets/vendor/suite-cbo/files/suite.cbo.trader.xlsx"></cbo-file-import>
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
          <label>简称</label>
          <md-input v-model="model.main.short_name"></md-input>
        </md-field>
        <md-field>
          <label>名称</label>
          <md-input required v-model="model.main.name"></md-input>
        </md-field>
        <md-ref-input md-label="分类" md-ref-id="suite.cbo.trader.category.ref" v-model="model.main.category" />
        <md-ref-input md-label="国家" md-ref-id="suite.cbo.country.ref" v-model="model.main.country" />
        <md-ref-input md-label="省份" md-ref-id="suite.cbo.province.ref" v-model="model.main.province" />
        <md-ref-input md-label="城市区县" md-ref-id="suite.cbo.division.ref" v-model="model.main.division" />
        <md-ref-input md-label="区域" md-ref-id="suite.cbo.area.ref" v-model="model.main.area" />
        <md-field>
          <label>类型</label>
          <md-enum md-enum-id="suite.cbo.trader.type.enum" v-model="model.main.type_enum"></md-enum>
        </md-field>
        <md-field>
          <md-checkbox required v-model="model.main.is_effective">生效的</md-checkbox>
        </md-field>
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
      var validator = this.$validate(this.model.main, { 'code': 'required', 'name': 'required' });
      var fail = validator.fails();
      if (fail && !notToast) {
        this.$toast(validator.errors.all());
      }
      return !fail;
    },
    initModel() {
      return {
        main: {
          'code': '',
          'name': '',
          category: null,
          is_effective: true,
          division: null,
          province: null,
          country: this.$root.userConfig.country
        }
      }
    },
    list() {
      this.$router.push({ name: 'module', params: { module: 'cbo.trader.list' } });
    },
  },
  created() {
    this.model.entity = 'suite.cbo.trader';
    this.model.order = "code";
    this.route = 'cbo/traders';
  },
};
</script>