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
      <span class="flex"></span>
    </md-part-toolbar>
    <md-part-body>
      <md-content>
        <md-field>
          <label>编码</label>
          <md-input required v-model="model.main.code"></md-input>
        </md-field>
        <md-field>
          <label>全称</label>
          <md-input required v-model="model.main.name"></md-input>
        </md-field>
        <md-field>
          <label>简称</label>
          <md-input required v-model="model.main.short_name"></md-input>
        </md-field>
        <md-ref-input md-label="国家/地区" required md-ref-id="suite.cbo.country.ref" v-model="model.main.country" />
        <md-ref-input md-label="区域" :md-init="initAreaRef" md-ref-id="suite.cbo.area.ref" v-model="model.main.area" />
        <md-ref-input md-label="省份" :md-init="initProvinceRef" required md-ref-id="suite.cbo.province.ref" v-model="model.main.province" />
        <md-checkbox required v-model="model.main.is_effective">生效的</md-checkbox>
      </md-content>
      <md-loading :loading="loading"></md-loading>
    </md-part-body>
  </md-part>
</template>
<script>
import model from 'cbo/mixins/MdModel/MdModel';
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
        'country': 'required',
        'province': 'required',
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
          'code': '',
          'name': '',
          'memo': '',
          'is_effective': true,
          country: this.$root.configs.country,
          area: null,
          province: null
        }
      }
    },
    list() {
      this.$router.push({ name: 'module', params: { module: 'cbo.division.list' } });
    },
    initProvinceRef(options) {
      if (this.model.main.area) {
        options.wheres.$area = { 'area_id': this.model.main.area.id };
      } else {
        options.wheres.$area = false;
      }
    },
    initAreaRef(options) {
      if (this.model.main.country) {
        options.wheres.$country = { 'country_id': this.model.main.country.id };
      } else {
        options.wheres.$country = false;
      }
    },
  },
  created() {
    this.model.entity = 'suite.cbo.division';
    this.model.order = "code";
    this.route = 'cbo/divisions';
  },
};
</script>