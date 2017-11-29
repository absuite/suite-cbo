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
          <label>名称</label>
          <md-input required v-model="model.main.name"></md-input>
        </md-field>
        <md-ref-input md-label="组织" required md-ref-id="suite.cbo.org.ref" v-model="model.main.org"></md-ref-input>
        <md-ref-input md-label="部门" required @init="initDeptRef" md-ref-id="suite.cbo.dept.ref" v-model="model.main.dept"></md-ref-input>
        <md-ref-input md-label="工作中心" @init="initWorgRef" md-ref-id="suite.cbo.work.ref" v-model="model.main.work"></md-ref-input>
        <md-ref-input md-label="负责人" md-ref-id="suite.cbo.person.ref" v-model="model.main.manager"></md-ref-input>
        <md-checkbox required v-model="model.main.is_effective">生效的</md-checkbox>
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
        'org': 'required',
        'dept': 'required',
      });
      var fail = validator.fails();
      if (fail && !notToast) {
        this.$toast(validator.errors.all());
      }
      return !fail;
    },
    initModel() {
      return {
        main: { 'code': '', 'name': '', 'memo': '', 'org': null, 'dept': null, 'work': null, is_effective: true }
      }
    },
    list() {
      this.$router.push({ name: 'module', params: { module: 'cbo.team.list' } });
    },
    initDeptRef(options) {
      if (this.model.main.org) {
        options.wheres.org = { name: 'org_id', value: this.model.main.org.id };
      } else {
        options.wheres.org = false;
      }
    },
    initWorgRef(options) {
      if (this.model.main.dept) {
        options.wheres.dept = { name: 'dept_id', value: this.model.main.dept.id };
      } else {
        options.wheres.dept = false;
      }
    },
  },
  created() {
    this.model.entity = 'suite.cbo.team';
    this.model.order = "code";
    this.route = 'cbo/teams';
  },
};
</script>