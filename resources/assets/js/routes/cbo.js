import common from 'gmf/core/utils/common';
import startsWith from 'lodash/startsWith'

import App from '../layouts/App.vue';
const wrapModule = {
  template: '<md-wrap :name="wrap"></md-wrap>',
  computed: {
    wrap: function() {
      const app = common.snakeCase(App.name);
      const module = common.snakeCase(this.$route.params.module);
      if (!startsWith(module, app) && module.indexOf('-') < 0) {
        return app + '-' + module;
      }
      return module;
    }
  },
  beforeRouteEnter(to, from, next) {
    next(vm => {
      if (!vm.$root.configs.user) {
        next({ name: 'auth.login' });
      }
    });
  },
  beforeRouteUpdate(to, from, next) {
    if (!this.$root.configs.user) {
      next({ name: 'auth.login' });
    } else {
      next();
    }
  },
  beforeRouteLeave(to, from, next) {
    next();
  }
};
const wrapExtend = {
  template: '<md-wrap :name="wrap"></md-wrap>',
  computed: {
    wrap: function() {
      const app = common.snakeCase(App.name);
      const module = common.snakeCase(this.$route.params.module);
      if (!startsWith(module, app) && module.indexOf('-') < 0) {
        return app + '-' + module;
      }
      return module;
    }
  },
  beforeRouteEnter(to, from, next) {
    next(vm => {
      if (!vm.$root.configs.user) {
        next({ name: 'auth.login' });
      }
    });
  },
  beforeRouteUpdate(to, from, next) {
    if (!this.$root.configs.user) {
      next({ name: 'auth.login' });
    } else {
      next();
    }
  },
  beforeRouteLeave(to, from, next) {
    next();
  }
};
const defaultRoutes = [{
  path: '/app',
  component: App,
  name: 'app',
  // meta: { requiresAuth: true },
  children: [{
    path: ':module',
    name: 'module',
    // meta: { requiresAuth: true },
    component: wrapModule,
    children: [
      { path: ':id', name: 'id', component: wrapExtend },
      { path: '*', component: wrapExtend }
    ]
  }]
}];

export default defaultRoutes;