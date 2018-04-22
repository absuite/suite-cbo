<template>
  <div class="suite-app-sider layout layout-column" v-if="user">
    <md-toolbar class="md-primary md-dense">
      <div class="md-toolbar-row">
        <div class="md-toolbar-section-start">
          <md-button class="md-icon-button md-avatar">
            <md-avatar>
              <img src="/assets/vendor/gmf-sys/avatar/1.jpg">
            </md-avatar>
          </md-button>
        </div>
        <h2 class="md-title flex">{{ user.name }}</h2>
        <div class="md-toolbar-section-end">
          <md-button class="md-icon-button" @click.native="toggle()">
            <md-icon>arrow_forward</md-icon>
          </md-button>
        </div>
      </div>
    </md-toolbar>
    <div class="layout layout-column flex">
      <md-list>
        <md-subheader>企业</md-subheader>
        <md-list-item v-for="item in ents" :key="item.id" @click="onSelectEnt(item)" :class="{'md-active':item.id==ent.id}">
          <md-icon>account_balance</md-icon>
          <span class="md-list-item-text">{{ item.name }}</span>
          <md-button class="md-icon-button md-list-action">
            <md-icon>send</md-icon>
          </md-button>
        </md-list-item>
        <md-divider class="md-inset"></md-divider>
        <md-list-item @click="onCreateEnt">
          <md-icon>account_balance</md-icon>
          <span class="md-list-item-text">创建企业</span>
          <md-button class="md-icon-button md-list-action">
            <md-icon>add</md-icon>
          </md-button>
        </md-list-item>
      </md-list>
    </div>
    <div>
      <md-button :to="{name:'auth.logout'}">退出</md-button>
    </div>
    <md-loading :loading="loading"></md-loading>
  </div>
</template>
<script>
export default {
  props: {
    mdToken: String,
    mdTitle: String
  },
  data() {
    return {
      ents: [],
      loading:0
    };
  },
  computed: {
    user() {
      return this.$root.configs.user;
    },
    ent() {
      return this.$root.configs.ent;
    },
  },
  methods: {
    toggle() {
      this.$emit('toggle');
      return true;
    },
    loadData() {
      this.$http.get('sys/ents/my').then(response => {
        this.ents = response.data.data;
      }).catch(err=>{
        this.$toast(err);
      });
    },
    onCreateEnt() {
      this.toggle();
      this.$router.replace({ name: 'module', params: { module: 'sys.ent.edit' } });
    },
    onSelectEnt(ent) {
      this.loading++;
      this.$http.post('sys/auth/entry-ent/'+ent.id).then(response => {
        if(response.data.data){
          this.toggle();
          this.$setConfigs({ent:ent});
        }
        this.loading--;
      }).catch(err=>{
        this.$toast(err);
        this.loading--;
      });
    },
  },
  created() {
    this.loadData();
  }
};
</script>
<style lang="scss">
@import "~gmf/components/MdAnimation/variables";
@import "~gmf/components/MdLayout/mixins";
.suite-app-sider {
  min-height: 100%;
  .md-list-item.md-active {
    .md-list-item-content {
      >.md-icon,
      >.md-list-item-text {
        color: var(--md-theme-default-primary, red);
      }
    }
  }
}
</style>