require('bootstrap');
require('./../css/site.scss');
import Vue from 'vue';

// import a component from a bundle, when needed
// import Mozaic from '../../../vendor/disjfa/mozaic-bundle/Resources/public/mozaic';

new Vue({
  el: '#base',

  components: {
    // connect component
    // Mozaic
  }
});

if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('/sw.js').then(registration => {
      console.log('SW registered: ', registration);
    }).catch(registrationError => {
      console.log('SW registration failed: ', registrationError);
    });
  });
}
