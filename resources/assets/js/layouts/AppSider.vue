<template>
  <div class="suite-app-sider layout layout-column" v-if="user">
    <md-toolbar class="md-primary md-dense">
      <div class="md-toolbar-row">
        <div class="md-toolbar-section-start">
          <md-button class="md-icon-button md-avatar">
            <md-avatar>
              <img :src="user.avatar_url">
            </md-avatar>
          </md-button>
        </div>
        <h2 class="md-title flex">{{ user.nick_name }}</h2>
        <div class="md-toolbar-section-end">
          <md-button class="md-icon-button" @click.native="toggle()">
            <md-icon>arrow_forward</md-icon>
          </md-button>
        </div>
      </div>
    </md-toolbar>
    <md-content class="flex">
      <md-card v-for="item in ents" :key="item.id" class="md-elevation-0">
        <md-card-header>
          <md-card-media>
            <img :src="item.avatar_url" alt="Avatar">
          </md-card-media>
          <md-card-header-text>
            <div class="md-title">{{item.name}}</div>
            <div class="md-subhead">{{item.memo||'没有填写任何描述!'}}</div>
          </md-card-header-text>
        </md-card-header>
        <md-card-actions>
          <md-icon class="md-primary" v-if="item.is_provider">assignment_ind</md-icon>
          <span class="flex"></span>
          <md-button v-if="item.id==ent.id" class="md-primary md-raised">当前企业</md-button>
          <md-button v-else class="md-accent md-raised" @click="onSelectEnt(item)">进入企业</md-button>
        </md-card-actions>
      </md-card>
    </md-content>
    <md-toolbar class="md-transparent" md-elevation="0">
      <md-button v-if="canCreateEnt" class="md-accent md-raised" @click="onCreateEnt">创建企业</md-button>
      <div class="flex"></div>
      <md-button class="md-warn md-raised" :to="{name:'auth.logout'}">退出</md-button>
    </md-toolbar>
    <md-loading :loading="loading"></md-loading>
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
        ents: [],
        loading: 0
      };
    },
    computed: {
      user() {
        return this.$root.configs.user;
      },
      ent() {
        return this.$root.configs.ent;
      },
      canCreateEnt() {
        return this.$root.configs && this.$root.configs.isSysUser;
      }
    },
    methods: {
      toggle() {
        this.$emit('toggle');
        return true;
      },
      loadData() {
        this.$http.get('sys/ents/my').then(response => {
          this.ents = response.data.data;
        }).catch(err => {
          this.$toast(err);
        });
      },
      onCreateEnt() {
        this.toggle();
        this.$router.replace({
          name: 'module',
          params: {
            module: 'sys.ent.edit'
          }
        });
      },
      onSelectEnt(ent) {
        this.loading++;
        this.$http.post('sys/auth/entry-ent/' + ent.id).then(response => {
          if (response.data.data) {
            this.toggle();
            this.$setConfigs({
              ent: ent
            });
          }
          this.loading--;
        }).catch(err => {
          this.$toast(err);
          this.loading--;
        });
      },
    },
    created() {
      this.loadData();
    }
  };
</script>
<style lang="scss">
  @import "~gmf/components/MdAnimation/variables";
  @import "~gmf/components/MdLayout/mixins";

  .suite-app-sider {
    min-height: 100%;

    .md-list-item.md-active {
      .md-list-item-content {

        >.md-icon,
        >.md-list-item-text {
          color: var(--md-theme-default-primary, red);
        }
      }
    }
  }
</style>
<style lang="scss" scoped>
  .md-content {
    background: transparent !important;
    overflow: auto;
  }

  .md-toolbar {
    .md-title {
      padding-left: 8px;
      padding-right: 8px;
    }
  }


  .md-card {
    border-bottom: 1px solid rgba(0, 59, 77, 0.2);
    border-radius: 0px;

    &:hover {
      background: rgba(0, 0, 0, 0.1);
    }

    .md-card-header {
      padding-bottom: 0px;

      .md-title {
        margin-top: 0px !important;
        font-size: 16px;
        line-height: 18px;
      }

      .md-card-media {
        width: 60px;
        height: 60px;
        flex: 0 0 60px;

        img {
          border-radius: 3px;
        }
      }
    }

    .md-card-actions {
      padding-top: 0px;
    }
  }
</style>