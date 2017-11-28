<template>
  <md-app md-waterfall md-mode="fixed-last">
    <md-app-toolbar class="md-dense md-primary">
      <app-toolbar @toggle="toggleMenu"></app-toolbar>
    </md-app-toolbar>
    <md-app-drawer :md-active.sync="menuVisible">
      <app-menu @toggle="toggleMenu"></app-menu>
    </md-app-drawer>
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
      menuVisible: false
    };
  },
  methods: {
    toggleMenu() {
      this.menuVisible = !this.menuVisible;
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
  min-height: 100%;
  .md-part-body{
    padding: 0px;
  }
  .md-app-content {
    padding: 0px;
  }
  .md-logo {
    margin: 0;
  }
  >.md-app-drawer {
    width: 230px;
    &.md-active {
      overflow: visible;
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
}
</style>