import './themes';

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

  config.route(routesAuth);
  config.route(routesMd);
  config.route(routesCbo);

  for (let component in options) {
    const componentInstaller = options[component];

    if (componentInstaller && component !== 'install') {
      Vue.use(componentInstaller);
    }
  }
  options.installed = true;
};
export default options;