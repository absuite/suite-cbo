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
      <md-part-toolbar-group>
        <md-button @click.native="seedDatas">导入演示数据</md-button>
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
          <label>行业</label>
          <md-input v-model="model.main.industry"></md-input>
        </md-field>
        <md-field>
          <label>区域</label>
          <md-input v-model="model.main.area"></md-input>
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
        main: { 'code': '', 'name': '' }
      }
    },
    afterSave(data){
      this.$root.loadEnts();
    },
    seedDatas() {
      if (!this.model.main.id) {
        this.$toast('先保存，再操作此功能!');
        return;
      }
      this.loading++;
      this.$http.post('sys/ents/seed/' + this.model.main.id).then(response => {
        this.$toast('导入数据成功!');
        this.loading--;
      }, response => {
        this.$toast('导入失败!');
        this.loading--;
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