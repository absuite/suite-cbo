<template>
  <md-app md-waterfall md-mode="fixed">
    <md-app-toolbar class="md-dense md-primary">
      <app-toolbar @toggleMenu="toggleMenu" @toggleSider="toggleSider"></app-toolbar>
    </md-app-toolbar>
    <md-app-drawer class="menu-drawer" :md-active.sync="menuVisible">
      <app-menu @toggle="toggleMenu"></app-menu>
    </md-app-drawer>
    <md-app-content>
      <div v-for="tab in navTabs" :key="tab.id" class="md-pag-container flex" :class="{'md-active': tab.active}">
        <md-wrap :name="tab.code" ref="tabWrap"></md-wrap>
      </div>
    </md-app-content>
    <md-app-drawer class="md-right" :md-active.sync="siderVisible">
      <app-sider @toggle="toggleSider"></app-sider>
    </md-app-drawer>
  </md-app>
</template>
<script>
import MdComponent from 'gmf/core/MdComponent';
import PageTabMixin from './PageTabMixin';
import AppMenu from './AppMenu';
import AppSider from './AppSider';
export default new MdComponent({
  name: 'App',
  components: {
    AppMenu,
    AppSider
  },
  props: {
    mdToken: String,
    mdTitle: String
  },
  mixins: [PageTabMixin],
  watch: {
    "$root.configs.ent.id": function(v, o) {
      this.onChangeEnt();
    }
  },
  data() {
    return {
      menuVisible: false,
      siderVisible: false
    };
  },
  methods: {
    toggleMenu() {
      this.menuVisible = !this.menuVisible;
    },
    toggleSider() {
      this.siderVisible = !this.siderVisible;
    },
    onChangeEnt() {
      this.menuVisible = false;
      this.siderVisible = false;
      this.$http.get('/site/configs').then(response => {
        if (!response.data.data) return;
        this.$setConfigs(response.data.data);
        this.$router.replace({ name: 'module', params: { module: 'entchange', refresh: true, standalone: true } });
      });
    },
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
  min-height: 100%;
  .md-gutter.md-layout-row>[class*="md-flex"]+[class*="md-flex"] {
    margin-left: 0;
  }
  .md-app-content {
    padding: 0px;
    &.md-content {
      background-color: transparent;
      height: 100%;
    }
  }
  .md-logo {
    margin: 0;
  }
  >.md-app-drawer.menu-drawer {
    width: 230px;
    &.md-active {
      overflow: visible;
    }
    @include md-layout-xsmall {
      width: 170px;
    }
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
  .md-part {
    margin: 0 auto;
    max-width: 1200px;
    width: 100%;
    &.md-full {
      max-width: 100%;
    }
    .md-part-toolbar {
      &.md-toolbar.md-dense {
        background-color: #fff;
        margin: 0 auto;
        min-height: 40px;
        width: 100%;
      }
      .md-part-toolbar-pager {
        @include md-layout-small {
          display: none;
        }
      }
    }
    .md-part-body {
      padding: 10px;
      margin: 10px auto;
      width: 100%;

      @include md-layout-xsmall {
        margin: 0;
        padding: 4px;
      }
    }
  }
  .md-form {
    .layout>.md-field {
      margin-left: 0px;
      margin-right: 10px;
      margin-bottom: 5px;
    }
  }
  .md-pag-container {
    display: none;
    min-height: 100%;
    height: 100%;
    &.md-active {
      display: block;
    }
  }
}
</style>