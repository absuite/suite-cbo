<template>
  <div class="suite-app-toolbar">
    <div class="md-toolbar-row layout-align-space-between-center">
      <div class="md-toolbar-section-start">
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
        <md-button class="md-icon-button md-avatar" @click.native="toggleSider()">
          <md-avatar>
            <img src="/img/vendor/gmf-sys/avatar/1.jpg">
          </md-avatar>
        </md-button>
      </div>
    </div>
    <div class="md-toolbar-row">
      <div class="md-toolbar-section-start">
        <md-button class="md-icon-button" @click.native="toggleMenu()">
          <md-icon>menu</md-icon>
        </md-button>
      </div>
      <div class="md-pag-tabs">
        <md-button v-for="tab in navTabs" class="md-pag-item" :class="{'md-active': tab.active}" :key="tab.id" @click="toPageTab(tab)">
          <span>{{ tab.name }}</span>
          <md-button v-if="navTabs.length>1" class="md-icon-button md-delete" @click.native="removePageTab(tab,$event)">
            <md-icon>cancel</md-icon>
          </md-button>
        </md-button>
      </div>
      <div class="md-toolbar-section-end md-flexible">
      </div>
    </div>
  </div>
</template>
<script>
import PageTabMixin from './PageTabMixin';
export default {
  props: {

  },
  mixins: [PageTabMixin],
  watch: {
    
  },
  data() {
    return {
      search_q: '',
      search_options: [],
      showSidepanel:false
    };
  },
  methods: {
    toggleMenu() {
      this.$emit('toggleMenu');
    },
    toggleSider(){
      this.$emit('toggleSider');
    },
    
  }
};
</script>
<style lang="scss">
@import "~gmf/components/MdAnimation/variables";
@import "~gmf/components/MdLayout/mixins";
.suite-app-toolbar {
  width: 100%;
  .md-pag-tabs {
    padding-left: 0px;
    .md-pag-item {
      margin: 0px;
      opacity: .8;
      min-width: 60px;
      min-height: 40px;
      overflow: hidden;
      padding-left: 2px;
      padding-right: 5px;
      .md-ripple{
        padding: 0px;
      }
      &.md-active {
        opacity: 1;
      }

      .md-delete {
        margin: 0px;
        padding: 0px;
        width:18px;
        height:18px;
        min-width: auto;
        min-height: auto;
        transform: translate3d(120%, 0px, 0px);
        opacity: 0;

        .md-icon {
          font-size: 18px;
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