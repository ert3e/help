import './functions';
import './main';

import './vue';

import IMask from 'imask';
let phoneLoginElement = document.getElementById('loginform');
let phoneUpdate = document.getElementById('phone');
let emailUpdate = document.getElementById('email');
if (phoneLoginElement) {
    let phoneLogin = IMask(phoneLoginElement, {
        mask: '+{0}(000)000-00-00',
        lazy: false,  // make placeholder always visible
        placeholderChar: '0'     // defaults to '_'
    });
}
if(phoneUpdate){
    let phoneUpdateElement = IMask(phoneUpdate, {
        mask: '+{0}(000)000-00-00',
        lazy: false,  // make placeholder always visible
        placeholderChar: '0'
    });
}
if(emailUpdate){
    let emailUpdateElement = IMask(emailUpdate, {
        mask: /^\S*@?\S*$/,
        lazy: false,  // make placeholder always visible

    });
}