<template>
  <div class="suite-app-menu layout layout-column">
    <md-toolbar class="md-primary">
      <md-button class="md-icon-button" @click.native="toggleMenu()">
        <md-icon>arrow_back</md-icon>
      </md-button>
      <h2 class="md-title"><img src="/img/logo.png"/></h2>
    </md-toolbar>
    <md-list>
      <md-list-item @click="goNav('dashboard')">
        <md-icon>dashboard</md-icon>
        <span class="md-list-item-text">首页</span>
      </md-list-item>
      <md-list-item @click="goNav('dashboard')">
        <md-icon>verified_user</md-icon>
        <span class="md-list-item-text">数据管理</span>
      </md-list-item>
      <md-list-item @click="goNav('dashboard')">
        <md-icon>assessment</md-icon>
        <span class="md-list-item-text">阿米巴经营</span>
      </md-list-item>
      <md-list-item @click="goNav('dashboard')">
        <md-icon>invert_colors</md-icon>
        <span class="md-list-item-text">经营环境</span>
      </md-list-item>
      <md-divider class="md-inset"></md-divider>
      <md-list-item @click="goNav('dashboard')">
        <md-icon>account_circle</md-icon>
        <span class="md-list-item-text">我的</span>
      </md-list-item>
      <md-list-item @click="goNav('dashboard')">
        <md-icon>settings</md-icon>
        <span class="md-list-item-text">系统运营</span>
      </md-list-item>
    </md-list>
    <div class="suite-app-menu-extend">
      <section v-for="item in extendMenu">
        <div :id="'menu-id-'+item.name"></div>
        <md-subheader>{{item.name}}</md-subheader>
        <ul v-if="item.childs&&item.childs.length" class="nav">
          <li v-for="sItem in item.childs" :class="{'has-child layout':sItem.childs&&sItem.childs.length}">
            <a @click="goNav(sItem,$event)" :class="{'title':sItem.childs&&sItem.childs.length}">{{sItem.name}}</a>
            <ul v-if="sItem.childs&&sItem.childs.length" class="nav">
              <li v-for="ssItem in sItem.childs">
                <a @click="goNav(ssItem,$event)">{{ssItem.name}}</a>
              </li>
            </ul>
          </li>
        </ul>
      </section>
    </div>
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
      rootMenu: [],
      extendMenu: [],
    };
  },
  methods: {
    toggleMenu() {
      this.$emit('toggle');
    },
    goNav(nav, event) {
      if (!nav) return;
      return;
      if (typeof nav === 'string') {
        this.$router.push({ name: 'module', params: { module: nav } });
      } else if (nav && nav.uri) {
        this.$router.push({ name: 'module', params: { module: nav.uri } });
      }
      this.$refs.mainSidenav.close();
    },
    loadData() {
      this.$http.get('sys/menus/all').then(response => {
        this.extendMenu = response.data.data;
      }, response => {
        this.$toast(response);
      });
    }
  },
  created() {
    this.loadData();
  }
};
</script>
<style lang="scss">
@import "~gmf/components/MdAnimation/variables";
@import "~gmf/components/MdLayout/mixins";
.suite-app-menu-extend {
  position: fixed;
  overflow: auto;
  top: 0px;
  left: 100%;
  z-index: 60;
  background: #fff;

  width: 200%;
  max-height: 100%;
  min-height: 100%;
}

.suite-app-menu {
  max-width: 100%;
  max-height: 100%;
  >.md-list {
    overflow-y: auto;
  }
}
</style>