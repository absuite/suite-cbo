import Password from './Password.vue';
import User from './User.vue';
export default function install(Vue) {
  Vue.component(Password.name, Password);
  Vue.component(User.name, User);
}