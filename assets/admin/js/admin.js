require('bootstrap');
require('./../css/admin.scss');
import '@fortawesome/fontawesome';
import '@fortawesome/fontawesome-free-solid';
import Vue from 'vue';
import Example from './../../../templates/admin/dashboard/example';

new Vue({
  el: '#base',

  components: {
    Example
  }
});