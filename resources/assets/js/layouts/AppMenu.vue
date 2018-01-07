<template>
  <div class="suite-app-menu layout layout-column">
    <md-toolbar class="md-primary">
      <md-button class="md-icon-button" @click.native="toggleMenu()">
        <md-icon>arrow_back</md-icon>
      </md-button>
      <span class="flex"></span>
      <div class="md-logo">
        <cbo-logo animated></cbo-logo>
      </div>
    </md-toolbar>
    <md-list class="flex">
      <md-list-item @click="goNav('dashboard')">
        <md-icon>dashboard</md-icon>
        <span class="md-list-item-text">首页</span>
      </md-list-item>
      <md-list-item @click="tipNav('cbo')" @mouseenter="showCategory('cbo')" @mouseleave="hideCategory">
        <md-icon>verified_user</md-icon>
        <span class="md-list-item-text">数据管理</span>
      </md-list-item>
      <md-list-item @click="tipNav('amiba')" @mouseenter="showCategory('amiba')" @mouseleave="hideCategory">
        <md-icon>assessment</md-icon>
        <span class="md-list-item-text">阿米巴经营</span>
      </md-list-item>
      <md-list-item @click="tipNav('bec')" @mouseenter="showCategory('bec')" @mouseleave="hideCategory">
        <md-icon>invert_colors</md-icon>
        <span class="md-list-item-text">经营环境</span>
      </md-list-item>
      <md-divider class="md-inset"></md-divider>
      <md-list-item @click="tipNav('my')" @mouseenter="showCategory('my')" @mouseleave="hideCategory">
        <md-icon>account_circle</md-icon>
        <span class="md-list-item-text">我的</span>
      </md-list-item>
      <md-list-item @click="tipNav('sys')" @mouseenter="showCategory('sys')" @mouseleave="hideCategory">
        <md-icon>settings</md-icon>
        <span class="md-list-item-text">系统运营</span>
      </md-list-item>
    </md-list>
    <md-divider></md-divider>
    <md-toolbar md-elevation="0" class="md-transparent">
      <a href="//demo.myamiba.com/docs/home" target="_blank">文档</a>
    </md-toolbar>
    <div class="suite-app-menu-extend layout layout-column" @mouseenter="showCategory(currentCategory)" @mouseleave="hideCategory" v-show="currentCategory">
      <section class="layout layout-column" v-for="item in extendMenu" v-show="currentCategory==item.code" :key="item.id">
        <md-toolbar>
          <h3 class="md-title">{{item.name}}</h3>
        </md-toolbar>
        <div class="extend-body layout layout-column flex">
          <md-list v-if="item.childs&&item.childs.length" v-for="sItem in item.childs" :key="sItem.id">
            <md-subheader>{{sItem.name}}</md-subheader>
            <md-list-item v-for="ssItem in sItem.childs" :key="ssItem.id" @click="goNav(ssItem,$event)">
              <div class="md-list-item-text">{{ssItem.name}}</div>
            </md-list-item>
          </md-list>
        </div>
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
  watch: {
    "$root.userData.entId": function(v, o) {
      this.loadData();
    }
  },
  data() {
    return {
      rootMenu: [],
      extendMenu: [],
      currentCategory: '',
      currentTip: '',
      categoryTimeout: false,
    };
  },
  methods: {
    toggleMenu() {
      this.$emit('toggle');
    },
    showCategory(category) {
      window.clearTimeout(this.categoryTimeout);
      this.currentCategory = category;
    },
    hideCategory() {
      window.clearTimeout(this.categoryTimeout);
      this.categoryTimeout = this._.delay(() => { this.currentCategory = '' }, 100);
    },
    tipNav(nav) {
      this.currentTip = nav;
    },
    goNav(nav, event) {
      if (!nav) return;
      if (typeof nav === 'string') {
        this.$router.push({ name: 'module', params: { module: nav } });
      } else if (nav && nav.uri) {
        this.$router.push({ name: 'module', params: { module: nav.uri } });
      }
      this.toggleMenu();
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
  overflow: hidden;
  top: 0px;
  left: 100%;
  z-index: 60;
  background: #fff;
  box-shadow: 0 0px 1px 0 rgba(0, 0, 0, .3);
  width: 200%;
  max-height: 100%;
  min-height: 100%;
  @include md-layout-xsmall {
    width: 100%;
  }
}

.suite-app-menu {
  max-width: 100%;
  max-height: 100%;
  height: 100%;
  >.md-list {
    overflow-y: auto;
  }
  .md-logo{
    display: inline-flex;
    justify-content: center;
    align-items: center;
    height:48px;
    padding: 0px;
    cursor: pointer;
    position: absolute;
    right: 10px;
    z-index: 11;
    @include md-layout-xsmall {
      display:none;
    }
    svg{
      height: 48px;
      width: 150px;
    }
  }
  .suite-app-menu-extend {
    >section {
      width: 100%;
      .extend-body {
        overflow: auto;
        width: 100%;
      }
    }
    .md-list {
      flex-flow: row wrap;
      flex: none;
      .md-subheader {
        width: 100%;
        color: var(--md-theme-default-primary, #0f9d58);
      }
      .md-list-item {
        margin: 0px;
        .md-list-item-content {
          min-height: 30px;
        }
      }
    }
  }
}
</style>