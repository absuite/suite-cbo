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
      <md-part-toolbar-crumbs>
        <md-part-toolbar-crumb>客商</md-part-toolbar-crumb>
        <md-part-toolbar-crumb>编辑</md-part-toolbar-crumb>
      </md-part-toolbar-crumbs>
    </md-part-toolbar>
    <md-part-body>
      <md-content>
        
        <md-input-container>
          <label>编码</label>
          <md-input required v-model="model.main.code"></md-input>
        </md-input-container>
        <md-input-container>
          <label>简称</label>
          <md-input v-model="model.main.short_name"></md-input>
        </md-input-container>
        <md-input-container>
          <label>名称</label>
          <md-input required v-model="model.main.name"></md-input>
        </md-input-container>
        <md-input-container>
          <label>分类</label>
          <md-input-ref md-ref-id="suite.cbo.trader.category.ref" v-model="model.main.category"/>
        </md-input-container>
        <md-input-container>
          <label>国家</label>
          <md-input-ref md-ref-id="suite.cbo.country.ref" v-model="model.main.country"/>
        </md-input-container>
        <md-input-container>
          <label>省份</label>
          <md-input-ref md-ref-id="suite.cbo.province.ref" v-model="model.main.province"/>
        </md-input-container>
        <md-input-container>
          <label>城市区县</label>
          <md-input-ref md-ref-id="suite.cbo.division.ref" v-model="model.main.division"/>
        </md-input-container>
        <md-input-container>
          <label>区域</label>
          <md-input-ref md-ref-id="suite.cbo.area.ref" v-model="model.main.area"/>
        </md-input-container>
        <md-input-container>
          <label>类型</label>
          <md-enum md-enum-id="suite.cbo.trader.type.enum" v-model="model.main.type_enum"></md-enum>
        </md-input-container>
        <md-input-container>
          <md-checkbox required v-model="model.main.is_effective">生效的</md-checkbox>
        </md-input-container>
        <md-input-container>
          <label>备注</label>
          <md-textarea v-model="model.main.memo"></md-textarea>
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
      return {
      };
    },
    mixins: [model],
    computed: {
      canSave() {
        return this.validate(true);
      }
    },
    methods: {
      validate(notToast){
        var validator=this.$validate(this.model.main,{'code':'required','name':'required'});
        var fail=validator.fails();
        if(fail&&!notToast){
          this.$toast(validator.errors.all());
        }
        return !fail;
      },
      initModel(){
        return {
          main:{
            'code':'',
            'name':'',
            category:null,
            is_effective:true,
            division:null,
            province:null,
            country:this.$root.userConfig.country
          }
        }
      },
      list() {
        this.$router.push({ name: 'module', params: { module: 'cbo.trader.list' }});
      },
    },
    created() {
      this.model.entity='suite.cbo.trader';
      this.model.order="code";
      this.route='cbo/traders';
    },
  };
</script>
