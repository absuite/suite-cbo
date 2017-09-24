import mdApp from './mdApp.vue';
import mdAppContent from './mdAppContent.vue';
import mdAppFooter from './mdAppFooter.vue';
import mdAppMenu from './mdAppMenu.vue';
import mdAppToolbar from './mdAppToolbar.vue';
import mdDashboard from './mdDashboard.vue';
import mdEntchange from './mdEntchange.vue';
export default function install(Vue) {
  Vue.component('app', mdApp);
  Vue.component('appContent', mdAppContent);
  Vue.component('appFooter', mdAppFooter);
  Vue.component('appMenu', mdAppMenu);
  Vue.component('appToolbar', mdAppToolbar);
  Vue.component('dashboard', mdDashboard);
  Vue.component('entchange', mdEntchange);
}