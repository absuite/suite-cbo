import sysLanguageList from './sysLanguageList.vue';
import sysLanguageEdit from './sysLanguageEdit.vue';

import sysProfileEdit from './sysProfileEdit.vue';
import sysProfileList from './sysProfileList.vue';

import sysPermitEdit from './sysPermitEdit.vue';
import sysPermitList from './sysPermitList.vue';

import sysRoleEdit from './sysRoleEdit.vue';
import sysRoleList from './sysRoleList.vue';

import sysEntList from './sysEntList.vue';


import sysDtiCategoryEdit from './sysDtiCategoryEdit.vue';
import sysDtiCategoryList from './sysDtiCategoryList.vue';


import sysDtiParamEdit from './sysDtiParamEdit.vue';
import sysDtiParamList from './sysDtiParamList.vue';

import sysDtiLogList from './sysDtiLogList.vue';

import sysDtiItemEdit from './sysDtiItemEdit.vue';
import sysDtiItemList from './sysDtiItemList.vue';

export default function install(Vue) {
  Vue.component('sysLanguageList', sysLanguageList);
  Vue.component('sysLanguageEdit', sysLanguageEdit);

  Vue.component('sysProfileEdit', sysProfileEdit);
  Vue.component('sysProfileList', sysProfileList);

  Vue.component('sysPermitEdit', sysPermitEdit);
  Vue.component('sysPermitList', sysPermitList);

  Vue.component('sysRoleEdit', sysRoleEdit);
  Vue.component('sysRoleList', sysRoleList);

  Vue.component('sysEntList', sysEntList);

  Vue.component('sysDtiCategoryEdit', sysDtiCategoryEdit);
  Vue.component('sysDtiCategoryList', sysDtiCategoryList);

  Vue.component('sysDtiParamEdit', sysDtiParamEdit);
  Vue.component('sysDtiParamList', sysDtiParamList);

  Vue.component('sysDtiLogList', sysDtiLogList);

  Vue.component('sysDtiItemEdit', sysDtiItemEdit);
  Vue.component('sysDtiItemList', sysDtiItemList);
}