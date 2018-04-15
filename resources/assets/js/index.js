import './themes';
import values from 'lodash/values'
import * as MdComponents from 'gmf/components';
import components from './components';
import oauth from './oauth';
import sys from './sys';
import layouts from './layouts';
import common from './common';

import config from 'gmf/config';
import routesAuth from 'gmf/routes/auth';
import routesMd from 'gmf/routes/md';
import routesCbo from './routes/cbo';
const options = {
  components,
  oauth,
  sys,
  layouts,
  common,
};

options.install = (Vue) => {
  if (options.installed) {
    console.warn('Vue Material is already installed.');
    return;
  }
  options.installed = true;
  values(MdComponents).forEach((MdComponent) => {
    Vue.use(MdComponent)
  });

  values(options).forEach((component) => {
    Vue.use(component)
  });

  config.route(routesAuth);
  config.route(routesMd);
  config.route(routesCbo);
};
export default options;