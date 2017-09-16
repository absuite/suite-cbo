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
      <span class="flex"></span>
      <md-part-toolbar-crumbs>
        <md-part-toolbar-crumb>接口</md-part-toolbar-crumb>
        <md-part-toolbar-crumb>参数</md-part-toolbar-crumb>
        <md-part-toolbar-crumb>编辑</md-part-toolbar-crumb>
      </md-part-toolbar-crumbs>
    </md-part-toolbar>
    <md-part-body>
      <md-content>
        <md-input-container>
          <label>分类</label>
          <md-input-ref md-ref-id="gmf.sys.dti.category.ref" v-model="model.main.category" />
        </md-input-container>
        <md-input-container>
          <label>接口</label>
          <md-input-ref md-ref-id="gmf.sys.dti.ref" @init="initDtiRef" v-model="model.main.dti" />
        </md-input-container>
        <md-input-container>
          <label>编码</label>
          <md-input required maxlength="10" v-model="model.main.code"></md-input>
        </md-input-container>
        <md-input-container>
          <label>名称</label>
          <md-input required v-model="model.main.name"></md-input>
        </md-input-container>
        <md-input-container>
          <label>类型</label>
          <md-enum md-enum-id="gmf.sys.dti.param.type.enum" v-model="model.main.type_enum" />
        </md-input-container>
        <md-input-container>
          <label>值</label>
          <md-input v-model="model.main.value"></md-input>
        </md-input-container>
      </md-content>
      <md-loading :loading="loading"></md-loading>
    </md-part-body>
  </md-part>
</template>
<script>
import model from '../../gmf-sys/core/mixin/model';
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
      });
      var fail = validator.fails();
      if (fail && !notToast) {
        this.$toast(validator.errors.all());
      }
      return !fail;
    },
    initModel() {
      return {
        main: { 'code': '', 'name': '', 'type_enum': 'fixed' }
      }
    },
    list() {
      this.$router.push({ name: 'module', params: { module: 'sys.dti.param.list' } });
    },
    initDtiRef(options) {
      if (this.model.main.category) {
        options.wheres.category = { name: 'category_id', value: this.model.main.category.id };
      } else {
        options.wheres.category = false;
      }
    }
  },
  created() {
    this.route = 'sys/dti-params';
  },
};
</script>