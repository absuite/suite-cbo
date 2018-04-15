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
    </md-part-toolbar>
    <md-part-body>
      <md-content>
        <md-ref-input md-label="分类" md-ref-id="gmf.sys.dti.category.ref" v-model="model.main.category" />
        <md-ref-input md-label="接口" md-ref-id="gmf.sys.dti.ref" :md-init="initDtiRef" v-model="model.main.dti" />
        <md-field>
          <label>编码</label>
          <md-input required maxlength="10" v-model="model.main.code"></md-input>
        </md-field>
        <md-field>
          <label>名称</label>
          <md-input required v-model="model.main.name"></md-input>
        </md-field>
        <md-field>
          <label>类型</label>
          <md-enum md-enum-id="gmf.sys.dti.param.type.enum" v-model="model.main.type_enum" />
        </md-field>
        <md-field>
          <label>值</label>
          <md-input v-model="model.main.value"></md-input>
        </md-field>
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
        options.wheres.$category = { 'category_id': this.model.main.category.id };
      } else {
        options.wheres.$category = false;
      }
    }
  },
  created() {
    this.route = 'sys/dti-params';
  },
};
</script>