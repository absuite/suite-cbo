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
        <md-field>
          <label>编码</label>
          <md-input required maxlength="10" v-model="model.main.code"></md-input>
        </md-field>
        <md-field>
          <label>名称</label>
          <md-input required v-model="model.main.name"></md-input>
        </md-field>
        <md-field>
          <label>主机地址</label>
          <md-input required v-model="model.main.host"></md-input>
        </md-field>
      </md-content>
    </md-part-body>
    <md-loading :loading="loading"></md-loading>
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
        main: { 'code': '', 'name': '', 'host': '' }
      }
    },
    list() {
      this.$router.push({ name: 'module', params: { module: 'sys.dti.category.list' } });
    },
  },
  created() {
    this.route = 'sys/dti-categories';
  },
};
</script>