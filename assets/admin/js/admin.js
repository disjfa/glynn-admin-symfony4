require('bootstrap');
require('./../css/admin.scss');
import Vue from 'vue';
import Example from './../../../templates/admin/dashboard/example';

new Vue({
  el: '#base',

  components: {
    Example
  }
});
