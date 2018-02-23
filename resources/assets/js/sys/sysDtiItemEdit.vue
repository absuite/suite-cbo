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
        <md-ref-input md-label="接口" md-ref-id="gmf.sys.dti.local.ref" v-model="model.main.local" />
        <md-ref-input md-label="分类" md-ref-id="gmf.sys.dti.category.ref" v-model="model.main.category" />
        <md-field>
          <label>编码</label>
          <md-input required v-model="model.main.code"></md-input>
        </md-field>
        <md-field>
          <label>名称</label>
          <md-input required v-model="model.main.name"></md-input>
        </md-field>
        <md-field>
          <label>类型</label>
          <md-enum md-enum-id="gmf.sys.dti.method.enum" v-model="model.main.method_enum" />
        </md-field>
        <md-field>
          <label>接口路径</label>
          <md-input v-model="model.main.path"></md-input>
        </md-field>
        <md-field>
          <label>请求头</label>
          <md-textarea v-model="model.main.header"></md-textarea>
        </md-field>
        <md-field>
          <label>请求体</label>
          <md-textarea v-model="model.main.body"></md-textarea>
        </md-field>
        <md-field>
          <label>备注</label>
          <md-textarea v-model="model.main.memo"></md-textarea>
        </md-field>
      </md-content>
    </md-part-body>
    <md-loading :loading="loading"></md-loading>
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
      });
      var fail = validator.fails();
      if (fail && !notToast) {
        this.$toast(validator.errors.all());
      }
      return !fail;
    },
    initModel() {
      return {
        main: { 'code': '', 'name': '', 'method_enum': 'post', 'local': null, 'category': null }
      }
    },
    list() {
      this.$router.push({ name: 'module', params: { module: 'sys.dti.item.list' } });
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
    this.route = 'sys/dtis';
  },
};
</script>