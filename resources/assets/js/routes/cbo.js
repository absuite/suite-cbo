import common from 'gmf/core/utils/common';
import startsWith from 'lodash/startsWith'
const wrapApp = {
  template: '<md-wrap :name="wrap"></md-wrap>',
  computed: {
    wrap: function() {
      return this.$route.params.app;
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
const wrapModule = {
  template: '<md-wrap :name="wrap"></md-wrap>',
  computed: {
    wrap: function() {
      const app = common.snakeCase(this.$route.params.app);
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
      const app = common.snakeCase(this.$route.params.app);
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
  path: '/:app',
  component: wrapApp,
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