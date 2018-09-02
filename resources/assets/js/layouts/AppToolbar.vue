<template>
  <div class="suite-app-toolbar">
    <div class="md-toolbar-row layout-align-space-between-center">
      <div class="md-toolbar-section-start">
        <md-button v-if="!menuVisible" class="md-icon-button" @click.native="toggleMenu()">
          <md-icon>menu</md-icon>
        </md-button>
        <md-button class="md-icon-button" @click="toggleScreenfull()">
          <md-icon v-if="!screenfull">fullscreen</md-icon>
          <md-icon v-else>fullscreen_exit</md-icon>
        </md-button>
      </div>
      <div class="md-pag-tabs flex">
        <md-button v-for="tab in navTabs" class="md-pag-item" :class="{'md-active': tab.active}" :key="tab.id" @click="toPageTab(tab)">
          <span>{{ tab.name }}</span>
          <md-button v-if="navTabs.length>1" class="md-icon-button md-delete" @click.native="removePageTab(tab,$event)">
            <md-icon>cancel</md-icon>
          </md-button>
        </md-button>
      </div>
      <div class="md-toolbar-section-end">
        <md-button class="md-icon-button md-avatar" @click.native="toggleSider()">
          <md-avatar>
            <img :src="user&&user.avatar_url">
          </md-avatar>
        </md-button>
      </div>
    </div>
  </div>
</template>
<script>
import PageTabMixin from "./PageTabMixin";
import screenfull from "screenfull";
import { mapState, mapActions, mapMutations } from "vuex";
import * as types from "gmf/store/mutation-types";

export default {
  props: {},
  mixins: [PageTabMixin],
  data() {
    return {
      search_q: "",
      search_options: [],
      showSidepanel: false,
      screenfull: false
    };
  },
  computed: {
    ...mapState({
      menuVisible: "menuVisible"
    }),
    user() {
      return this.$root.configs.user;
    }
  },
  methods: {
    ...mapMutations({
      showMenu: types.SHOW_MENU,
      hideMenu: types.HIDE_MENU
    }),
    toggleMenu() {
      this.showMenu();
    },
    toggleSider() {
      this.$emit("toggleSider");
    },
    toggleScreenfull() {
      if (screenfull.enabled) {
        screenfull.toggle();
      }
    },
    screenfullChange() {
      this.screenfull = screenfull.isFullscreen;
    }
  },
  mounted() {
    if (screenfull.enabled) {
      screenfull.on("change", this.screenfullChange);
    }
  },
  destroyed() {
    if (screenfull.enabled) {
      screenfull.off("change", this.screenfullChange);
    }
  }
};
</script>
<style lang="scss">
@import "~gmf/components/MdAnimation/variables";
@import "~gmf/components/MdLayout/mixins";
.suite-app-toolbar {
  width: 100%;
  .md-logo {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    height: 56px;
    padding: 0px;
    cursor: pointer;
    svg {
      height: 60px;
      width: 140px;
    }
  }
  .md-pag-tabs {
    padding-left: 0px;
    .md-pag-item {
      margin: 0px;
      opacity: 0.8;
      min-width: 60px;
      min-height: 28px;
      height: auto;
      overflow: hidden;
      padding-left: 2px;
      padding-right: 5px;
      .md-ripple {
        padding: 0px;
      }
      .md-delete {
        margin: 0px;
        padding: 0px;
        width: 18px;
        height: 18px;
        min-width: auto;
        min-height: auto;
        transform: translate3d(120%, 0px, 0px);
        opacity: 0;

        .md-icon {
          font-size: 18px;
        }
      }
      &.md-active {
        opacity: 1;
        .md-delete {
          transform: translate3d(0px, 0px, 0px);
          opacity: 1;
        }
      }
      &:hover {
        .md-delete {
          transform: translate3d(0px, 0px, 0px);
          opacity: 1;
        }
      }
    }
  }
}
</style>