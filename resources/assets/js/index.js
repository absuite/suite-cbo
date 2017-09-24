

import components from './components';
import oauth from './oauth';
import sys from './sys';
import layouts from './layouts';
const options = {
    components,
    oauth,
    sys,
    layouts
};

options.install = (Vue) => {
    if (options.installed) {
        console.warn('Vue Material is already installed.');
        return;
    }
    for (let component in options) {
        const componentInstaller = options[component];

        if (componentInstaller && component !== 'install') {
            Vue.use(componentInstaller);
        }
    }
    options.installed = true;
};
export default options;