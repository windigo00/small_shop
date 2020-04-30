import Vue from 'vue';
import axios from 'axios';

var translations = window._translations | (()=>{
    let tr = [];
    return tr;
})();

Vue.filter('translate', (...arr) => {
//    console.log(arr);
//    return arr[0];

    let key = arr.shift();
    let translation = translations[key];

    if (!translation) {
        translation = key;
    }

    if (arr.length > 0) {
        return translation.replace(/\%[0-9sd]+/g, (...items) => {
            if (arr.length > 0) {
                return arr.shift();
            }
            return '';
        });
    }
    return translation;
});
