window.Vue = require('vue');

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import HelpForm from "./components/HelpForm";


new Vue({
    'el': '#app',
    'components': {
        'help-form': HelpForm,
    }
});

