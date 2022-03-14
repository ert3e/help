window.Vue = require('vue');

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import './functions';

import FileManager from "./components/FileManager";
import FileUpload from "./components/FileUpload";
import Sluggable from "./components/Sluggable";

new Vue({
    'el': '#app',
    'components': {
        'file-manager': FileManager,
        'file-upload': FileUpload,
        'sluggable': Sluggable,
    }
});
