import sysLanguageList from './sysLanguageList.vue';
import sysLanguageEdit from './sysLanguageEdit.vue';

import sysProfileEdit from './sysProfileEdit.vue';
import sysProfileList from './sysProfileList.vue';

import sysAuthorityPermitEdit from './sysAuthorityPermitEdit.vue';
import sysAuthorityPermitList from './sysAuthorityPermitList.vue';

import sysAuthorityRoleEdit from './sysAuthorityRoleEdit.vue';
import sysAuthorityRoleList from './sysAuthorityRoleList.vue';

import sysEntList from './sysEntList.vue';
import sysEntEdit from './sysEntEdit.vue';


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

  Vue.component('sysEntList', sysEntList);
  Vue.component('sysEntEdit', sysEntEdit);

  Vue.component('sysDtiCategoryEdit', sysDtiCategoryEdit);
  Vue.component('sysDtiCategoryList', sysDtiCategoryList);

  Vue.component('sysDtiParamEdit', sysDtiParamEdit);
  Vue.component('sysDtiParamList', sysDtiParamList);

  Vue.component('sysDtiLogList', sysDtiLogList);

  Vue.component('sysDtiItemEdit', sysDtiItemEdit);
  Vue.component('sysDtiItemList', sysDtiItemList);

  Vue.component('sysAuthorityPermitEdit', sysAuthorityPermitEdit);
  Vue.component('sysAuthorityPermitList', sysAuthorityPermitList);

  Vue.component('sysAuthorityRoleEdit', sysAuthorityRoleEdit);
  Vue.component('sysAuthorityRoleList', sysAuthorityRoleList);
}