<template>
  <div class="suite-app-menu layout layout-column" :class="{'md-active': menuVisible}">
    <md-list class="menu-header">
      <md-list-item>
        <md-image class="logo-img" md-src="/assets/vendor/suite-cbo/images/logo.png"></md-image>
        <span class="md-list-item-text logo-text">阿米巴巴</span>
        <md-button class="md-icon-button" @click.native="hideMenu">
          <md-icon>arrow_back</md-icon>
        </md-button>
      </md-list-item>
    </md-list>
    <md-list class="flex menu-list">
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
      <md-divider></md-divider>
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
      <!-- <a href="//demo.myamiba.com/docs/home" target="_blank">文档</a> -->
    </md-toolbar>
    <div class="suite-app-menu-extend layout layout-column" @mouseenter="showCategory(currentCategory)" @mouseleave="hideCategory" v-show="currentCategory">
      <md-content class="layout flex" md-theme="default">
        <section class="layout layout-column flex" v-for="item in extendMenu" v-show="currentCategory==item.code" :key="item.id">
          <md-toolbar class="md-dense md-fixed" md-elevation="1">
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
      </md-content>
    </div>
  </div>
</template>
<script>
import _delay from 'lodash/delay'
import { mapState, mapActions, mapMutations } from 'vuex'
import * as types from 'gmf/store/mutation-types'
export default {
  props: {
    mdToken: String,
    mdTitle: String
  },
  watch: {
    "$root.configs.ent.id": function(v, o) {
      this.loadData();
    }
  },
  computed: {
    ...mapState({
      menuVisible: 'menuVisible'
    })
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
    ...mapMutations({
      showMenu: types.SHOW_MENU,
      hideMenu: types.HIDE_MENU
    }),
    showCategory(category) {
      window.clearTimeout(this.categoryTimeout);
      this.currentCategory = category;
    },
    hideCategory() {
      window.clearTimeout(this.categoryTimeout);
      this.categoryTimeout = _delay(() => { this.currentCategory = '' }, 100);
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
      if (window && window.innerWidth <= 800) {
        this.hideCategory();
        this.hideMenu();
      } else {
        this.hideCategory();
      }
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
  width: calc(33vw);
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
    padding: 0px;
    margin: 0px;
    overflow-y: auto;
  }
  .menu-header {
    background-color: #4b9e59!important;
    .md-list-item-content {
      padding-right: 0px !important;
      padding-left: 16px !important;
    }
    .logo-text {
      font-size: 20px;
      color: #fff;
      font-weight: 600;
    }
    .md-icon {
      color: #fff!important;
    }
    .logo-img {
      width: 36px;
      min-width: 36px;
      margin-right: 20px;
    }

    .md-button {
      margin: 0px;
    }
  }
  .menu-list {
    .md-list-item-content {
      padding-left: 10px !important;
      padding-right: 5px !important;
      >.md-icon:first-child {
        font-size: 18px;
        margin-right: 12px;
      }
    }
  }
  &:not(.md-active) {
    .menu-list {
      .md-icon:first-child {
        margin-right: 6px !important;
      }
      .md-list-item-text {
        font-size: 16px;
        letter-spacing: 16px;
      }
    }
  }
  .suite-app-menu-extend {
    section {
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