<template>
  <md-app md-waterfall md-mode="fixed-last">
    <md-app-toolbar class="md-dense md-primary">
      <div class="md-toolbar-row layout-align-space-between-center">
        <div class="md-toolbar-section-start">
          <md-button class="md-icon-button" @click.native="toggleMenu()">
            <md-icon>menu</md-icon>
          </md-button>
          <h2 class="md-logo md-title">
            <img src="/img/logo.png"/>
          </h2>
        </div>
        <div class="flex search">
          <md-autocomplete v-model="search_q" :md-options="search_options" md-layout="box">
            <label>智能搜索...</label>
          </md-autocomplete>
        </div>
        <div class="md-toolbar-section-end">
          <md-menu md-align-trigger ref="menuEnts">
            <md-button md-menu-trigger>{{ $root.userData.ent.name }}
              <md-icon>arrow_drop_down</md-icon>
            </md-button>
            <md-menu-content>
              <md-menu-item v-for="item in $root.userData.ents" :key="item.id" @selected="onSelectEnt(item)">{{item.name }}</md-menu-item>
              <md-divider></md-divider>
              <md-menu-item @selected="onCreateEnt">创建企业</md-menu-item>
            </md-menu-content>
          </md-menu>
          <md-menu md-align-trigger ref="menuUser">
            <md-button class="md-icon-button md-avatar" md-menu-trigger>
              <md-avatar>
                <img src="/img/vendor/gmf-sys/avatar/1.jpg">
              </md-avatar>
            </md-button>
            <md-menu-content>
              <md-card class="md-primary">
                <md-card-header>
                  <md-card-header-text>
                    <div class="md-title">{{ $root.userConfig.user.name }}</div>
                    <div class="md-subhead">{{ $root.userConfig.user.account }}</div>
                  </md-card-header-text>
                  <md-card-media>
                    <img src="/img/vendor/gmf-sys/avatar/1.jpg" alt="People">
                  </md-card-media>
                </md-card-header>
                <md-card-actions>
                  <div class="layout-row layout-fill layout-align-space-between-center">
                    <md-button>添加账号</md-button>
                    <md-button href="/logout">退出</md-button>
                  </div>
                </md-card-actions>
              </md-card>
            </md-menu-content>
          </md-menu>
        </div>
      </div>
      <div class="md-toolbar-row">
        <div class="md-toolbar-section-start md-flexible">
          <md-button class="md-icon-button" @click.native="toggleMenu()">
            <md-icon>menu</md-icon>
          </md-button>
        </div>
        <md-tabs class="md-pag-tabs md-primary md-dense">
          <template slot="md-tab" slot-scope="{ tab }">
            <span>{{ tab.label }}</span>
            <md-button class="md-icon-button md-delete" @click.native="removePageTab(tab.data,$event)">
              <md-icon>cancel</md-icon>
            </md-button>
          </template>
          <md-tab v-for="tab in navTabs" :key="tab.id" :id="tab.id" :md-label="tab.name" @click="toPageTab(tab)"></md-tab>
        </md-tabs>
        <div class="md-toolbar-section-end md-flexible">
        </div>
      </div>
    </md-app-toolbar>
    <md-app-content>
      <div v-for="tab in navTabs" :key="tab.id" class="md-pag-container flex" :class="{'md-active': tab.active}">
        <md-wrap :name="tab.code" ref="tabWrap"></md-wrap>
      </div>
    </md-app-content>
  </md-app>
</template>
<script>
import MdComponent from 'gmf/core/MdComponent';
import PageTabMixin from './PageTabMixin';
export default new MdComponent({
  name: 'App',
  props: {
    mdToken: String,
    mdTitle: String
  },
  mixins: [PageTabMixin],
  watch: {
    "$root.userData.entId": function(v, o) {
      this.onChangeEnt();
    }
  },
  data() {
    return {
      search_q: '',
      search_options: []
    };
  },
  methods: {
    onChangeEnt() {
      this.$http.get('/getconfig').then(response => {
        if (!response.data.data) return;
        this.$set(this.$root, 'userConfig', response.data.data);
        this.$router.replace({ name: 'module', params: { module: 'entchange', refresh: true, standalone: true } });
      });
    },
    onCreateEnt() {
      this.$router.replace({ name: 'module', params: { module: 'sys.ent.edit' } });
    },
    onSelectEnt(ent) {
      this.$root.userData.ent = ent;
    },
    toggleMenu() {

    }
  },
  mounted() {

  }
});
</script>
<style lang="scss">
@import "~gmf/components/MdAnimation/variables";
@import "~gmf/components/MdLayout/mixins";
.md-app {
  max-height: 100%;
  .md-app-content {
    padding: 0px;
  }
  .md-logo {
    margin: 0;
  }
  .md-app-toolbar {
    .search {
      margin-right: 12px;
      margin-left: 20px;
      @include md-layout-small {
        display: none;
      }
    }
  }
}
</style>