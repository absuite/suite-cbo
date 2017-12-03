import App from './App.vue';
import AppToolbar from './AppToolbar.vue';
import Dashboard from './Dashboard.vue';
import Entchange from './Entchange.vue';
export default function install(Vue) {
  Vue.component('App', App);
  Vue.component('AppToolbar', AppToolbar);
  Vue.component('Dashboard', Dashboard);
  Vue.component('Entchange', Entchange);
}