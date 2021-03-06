import './functions';
import './main';

import './vue';

import IMask from 'imask';
let phoneLoginElement = document.getElementById('loginform');
let phoneUpdate = document.getElementById('phone');
let emailUpdate = document.getElementById('email');
if (phoneLoginElement) {
    let phoneLogin = IMask(phoneLoginElement, {
        mask: '+00(000)000-00-00',
        lazy: false,  // make placeholder always visible
        placeholderChar: '0'     // defaults to '_'
    });
}
if(phoneUpdate){
    let phoneUpdateElement = IMask(phoneUpdate, {
        mask: '+00(000)000-00-00',
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


    //getting text from P tag
    let copyText = document.getElementById("clipboard");
    if (copyText) {
        document.querySelector('#clipboard').addEventListener('click', function(e) {

            e.preventDefault();
            let input = document.createElement("textarea");
            //adding p tag text to textarea

            input.value = copyText.href;
            document.body.appendChild(input);
            input.select();
            document.execCommand("Copy");
            // removing textarea after copy
            input.remove();
            alert(input.value);
        });
        // creating textarea of html
    }


