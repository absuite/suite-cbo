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
      <md-part-toolbar-group v-if="model&&model.main&&model.main.id">
        <md-button @click.native="buildPeriods">生成期间</md-button>
      </md-part-toolbar-group>
      <md-part-toolbar-pager @paging="paging" :options="model.pager"></md-part-toolbar-pager>
      <span class="flex"></span>
      <md-part-toolbar-crumbs>
        <md-part-toolbar-crumb>日历</md-part-toolbar-crumb>
        <md-part-toolbar-crumb>编辑</md-part-toolbar-crumb>
      </md-part-toolbar-crumbs>
    </md-part-toolbar>
    <md-part-body>
      <md-content class="flex layout-column">
        <md-layout md-gutter>
          <md-layout md-flex-xsmall="100" md-flex-small="50" md-flex-medium="25" md-flex-large="20">
            <md-input-container>
              <label>编码</label>
              <md-input required v-model="model.main.code"></md-input>
            </md-input-container>
          </md-layout>
          <md-layout md-flex-xsmall="100" md-flex-small="50" md-flex-medium="25" md-flex-large="20">
            <md-input-container>
              <label>名称</label>
              <md-input required v-model="model.main.name"></md-input>
            </md-input-container>
          </md-layout>
          <md-layout md-flex-xsmall="100" md-flex-small="50" md-flex-medium="25" md-flex-large="20">
            <md-input-container>
              <label>期间类型</label>
              <md-enum required md-enum-id="suite.cbo.period.type.enum" v-model="model.main.type_enum" />
            </md-input-container>
          </md-layout>
          <md-layout md-flex-xsmall="100" md-flex-small="50" md-flex-medium="25" md-flex-large="20">
            <md-input-container>
              <label>起始日期</label>
              <md-date required v-model="model.main.from_date"></md-date>
            </md-input-container>
          </md-layout>
        </md-layout>
        <md-layout class="flex">
          <md-grid :datas="fetchLineDatas" ref="grid" @onRemove="onLineRemove" :row-focused="false" :auto-load="true" :showRemove="true">
            <md-grid-column label="期间名称" field="name" width="200px" />
            <md-grid-column label="开始时间" field="from_date" width="200px" />
            <md-grid-column label="结束时间" field="to_date" width="200px" />
          </md-grid>
        </md-layout>
      </md-content>
      <md-loading :loading="loading"></md-loading>
    </md-part-body>
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
        'code': 'required',
        'name': 'required',
        'type_enum': 'required',
        'from_date': 'required'
      });
      var fail = validator.fails();
      if (fail && !notToast) {
        this.$toast(validator.errors.all());
      }
      return !fail;
    },
    beforeSave() {
      this.model.main.lines = [];
    },
    buildPeriods() {
      if (!this.model.main || !this.model.main.id) {
        this.$toast('日历保存后，才能生成期间');
        return;
      }
      this.loading++;
      this.$http.post('cbo/period-calendars/' + this.model.main.id + '/build').then(response => {
        this.$refs.grid && this.$refs.grid.refresh();
        this.loading--;
        this.$toast(this.$lang.LANG_DOSUCCESS);
      }, response => {
        this.$toast(this.$lang.LANG_DOFAIL);
        this.loading--;
      });
    },
    initModel() {
      return {
        main: { 'code': '', 'name': '', 'type_enum': '', 'from_date': '' }
      }
    },
    list() {
      this.$router.push({ name: 'module', params: { module: 'cbo.period.calendar.list' } });
    },
    onLineRemove(options) {
      if (!options || !options.data || options.data.length <= 0) {
        return;
      }
      this.loading++;
      this.$http.delete('cbo/period-accounts/' + options.data[0].id).then(response => {
        this.$refs.grid && this.$refs.grid.refresh();
        this.loading--;
      }, response => {
        this.loading--;
      });
    },
  },
  created() {
    this.model.entity = 'suite.cbo.period.calendar';
    this.model.order = "code";
    this.route = 'cbo/period-calendars';
  },
};
</script>