import cboFileImport from './cboFileImport.vue';
import cboLogo from './cboLogo.vue';
export default function install(Vue) {
    Vue.component(cboFileImport.name, cboFileImport);
    Vue.component(cboLogo.name, cboLogo);
}
