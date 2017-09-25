<template>
  <md-part>
    <md-part-toolbar>
      <md-part-toolbar-group>
        <md-button @click.native="save" :disabled="!canSave">保存</md-button>
        <md-button @click.native="cancel">放弃</md-button>
        <md-button @click.native="create">新增</md-button>
      </md-part-toolbar-group>
      <md-button @click.native="seedDatas">导入演示数据</md-button>
      <md-part-toolbar-group>
      </md-part-toolbar-group>
      <md-part-toolbar-group>
        <md-button @click.native="list">列表</md-button>
      </md-part-toolbar-group>
      <span class="flex"></span>
      <md-part-toolbar-crumbs>
        <md-part-toolbar-crumb>企业</md-part-toolbar-crumb>
        <md-part-toolbar-crumb>编辑</md-part-toolbar-crumb>
      </md-part-toolbar-crumbs>
    </md-part-toolbar>
    <md-part-body>
      <md-content>
        <md-input-container>
          <label>编码</label>
          <md-input required maxlength="10" v-model="model.main.code"></md-input>
        </md-input-container>
        <md-input-container>
          <label>名称</label>
          <md-input required v-model="model.main.name"></md-input>
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
        main: { 'code': '', 'name': ''}
      }
    },
    seedDatas(){
      if(!this.model.main.id){
        this.$toast('先保存，再操作此功能!');
        return;
      }
      this.$http.post('sys/ents/seed/' + this.model.main.id).then(response => {
        this.$toast('导入数据成功!');
      }, response => {
        this.$toast('导入失败!');
      });
    },
    list() {
      this.$router.push({ name: 'module', params: { module: 'sys.ent.list' } });
    },
  },
  created() {
    this.route = 'sys/ents';
  },
};
</script>