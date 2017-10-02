<template>
  <div class="md-pags layout-fill flex layout-column">
    <div class="md-pag-tabs">
      <div v-for="tab in navTabs" :key="tab.id" @click="toPageTab(tab)" class="md-pag-tab" :class="{'md-active': tab.active}">
        <span>{{ tab.name }}</span>
        <md-button class="md-icon-button md-delete" @click.native="removePageTab(tab,$event)">
          <md-icon>cancel</md-icon>
        </md-button>
      </div>
    </div>
    <div class="md-pag-container flex layout-column">
      <div v-for="tab in navTabs" :key="tab.id" class="md-pag flex" :class="{'md-active': tab.active}">
        <md-wrap :name="tab.code" ref="tabWrap"></md-wrap>
      </div>
    </div>
  </div>
</template>
<script>
import common from '../../gmf-sys/core/utils/common';

export default {
  props: {
    mdToken: String,
    mdTitle: String
  },
  data() {
    return {
      navTabs: [],
      currentTab: {}
    };
  },
  watch: {
    '$route' (to, from) {
      this.routePageTab(to);
    }
  },
  methods: {
    toPageTab(tab) {
      this.$router.replace(tab.fullPath);
    },
    removePageTab(tab, event) {
      if (event) {
        event.preventDefault && event.preventDefault();
        event.stopPropagation && event.stopPropagation();
      }
      var currTab = false;
      common.forEach(this.navTabs, function(t) {
        if (t.active) {
          currTab = t;
        }
      });
      var ind = this.getPageTabIndex(tab);
      var currInd = this.getPageTabIndex(currTab);
      if (ind >= 0 && this.navTabs.length > 1) {
        this.navTabs.splice(ind, 1);
        if (currInd == ind && ind >= 0) {
          ind = (--ind) > 0 ? ind : 0;
          if (this.navTabs.length > 0) {
            this.$router.replace(this.navTabs[ind].fullPath);
          }
        }
      }
    },
    getPageTabIndex(tab) {
      var ind = -1;
      if (!tab) return ind;
      common.forEach(this.navTabs, function(t, k) {
        if (t.code == tab.code) {
          ind = k;
        }
      });
      return ind;
    },
    routePageTab(route) {
      if (!route || !route.params || !route.params.module)
        return;
      //独立模式，把其它页签都关闭
      if (route.params.standalone === true) {
        this.navTabs.splice(0, this.navTabs.length);
      }
      var code = common.snakeCase(route.params.module);
      var oldTab = false,
        ind = -1,
        activeTab = false;
      common.forEach(this.navTabs, function(t, i) {
        if (t.code == code) {
          oldTab = t;
          ind = i;
        }
        if (t.active) {
          activeTab = t;
        }
      });
      var newTab = {
        id: common.uniqueId(),
        code: code,
        name: code,
        module: route.params.module,
        fullPath: route.fullPath,
        params: route.params,
        active: true
      };
      //un active not current node;
      if (activeTab && newTab.code !== activeTab.code) {
        activeTab.active = false;
      }
      if (oldTab) {
        oldTab.active = true;
        if (newTab.params.refresh === true || oldTab.fullPath !== newTab.fullPath) {
          oldTab.id = common.uniqueId();
        }
      } else {
        this.getTabInfo(newTab.code);
        this.navTabs.push(newTab);
      }
    },
    getCurrentTabInd() {
      var ind = -1;
      common.forEach(this.navTabs, function(t, i) {
        if (t.active) {
          ind = i;
        }
      });
      return ind;
    },
    getTabInfo(code) {
      if (!code) return;
      this.$http.get('sys/components/' + code).then(response => {
        if (!response.data.data) return;
        common.forEach(this.navTabs, function(t, i) {
          if (t.code == code) {
            t.name = response.data.data.name;
          }
        });
      });
    },
    refresh() {
      var ind = this.getCurrentTabInd();
      if (ind >= 0) {
        var tab = this.navTabs[ind];
        tab.id = common.uniqueId();
      }
    }
  },
  created() {

  },
  mounted() {
    this.routePageTab(this.$route);
    document.onkeydown = (e) => {
      var ev = window.event || e;
      var code = ev.keyCode || ev.which;
      if (code == 116 && !ev.ctrlKey) {
        if (ev.preventDefault) {
          ev.preventDefault();
          this.refresh();
        } else {
          ev.keyCode = 0;
          ev.returnValue = false;
          this.refresh();
        }
      }
    }
  }
};
</script>