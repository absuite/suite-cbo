<template>
  <md-toolbar class="md-accent">
    <md-button class="md-icon-button" @click.native="toggle()">
      <md-icon>menu</md-icon>
    </md-button>
    <h2 class="md-title">
      <img src="/img/logo.png"/>
    </h2>
    <div class="md-flex">
      <md-input-container class="md-flex md-header-search">
        <md-input class="md-header-search-input" placeholder="search"></md-input>
      </md-input-container>
    </div>
    <md-button class="md-header-search-bar md-icon-button">
      <md-icon>search</md-icon>
    </md-button>
    <md-menu md-direction="bottom left" ref="menuEnts">
      <md-button md-menu-trigger>测试企业
        <md-icon>arrow_drop_down</md-icon>
      </md-button>
      <md-menu-content>
        <md-menu-item v-for="item in $root.userData.ents" :key="item.id">{{item.name }}</md-menu-item>
      </md-menu-content>
    </md-menu>
    <md-button class="md-icon-button">
      <md-icon>notifications</md-icon>
    </md-button>
    <md-menu md-direction="bottom left" ref="menuUser">
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
  </md-toolbar>
</template>
<script>
export default {
  props: {
    mdToken: String,
    mdTitle: String
  },
  methods: {
    toggle() {
      this.$emit('toggle');
    }
  }
};
</script>