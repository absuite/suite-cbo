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
          <label>备注</label>
          <md-textarea maxlength="70" v-model="model.main.memo"></md-textarea>
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
      var validator = this.$validate(this.model.main, { 'code': 'required|max:255|min:3', 'name': 'required' });
      var fail = validator.fails();
      if (fail && !notToast) {
        this.$toast(validator.errors.all());
      }
      return !fail;
    },
    initModel() {
      return {
        main: { 'code': '', 'name': '', 'memo': '' }
      }
    },
    list() {
      this.$router.push({ name: 'module', params: { module: 'sys.language.list' } });
    },
  },
  created() {
    this.route = 'sys/languages';
  },
};
</script>