import './themes';
import values from 'lodash/values'
import components from './components';
import oauth from './oauth';
import sys from './sys';
import layouts from './layouts';
import common from './common';
import gapp from 'gmf/app';
import routesCbo from './routes/cbo';
const options = {
  components,
  oauth,
  sys,
  layouts,
  common,
};
gapp.route(routesCbo);

options.install = (Vue) => {
  if (options.installed) {
    console.warn('Vue Material is already installed.');
    return;
  }
  options.installed = true;

  values(options).forEach((component) => {
    Vue.use(component)
  });

};
export default options;