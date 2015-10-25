(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
var TypeInput = require('./modules/Type');

jQuery(document).ready(function($){

  $('#remindr-dtpicker').datetimepicker({
    format:'d.m.Y H:i:s',
  });

  var type = new TypeInput({
    el : '#remindr-type'
  })

});
},{"./modules/Type":2}],2:[function(require,module,exports){
module.exports = Backbone.View.extend({

  currentType: '',
  initialize: function () {

    this.render();
  },
  events: {
    'click input[type=radio]': 'handleClick'
  },
  render: function () {
    this.$adminmsg = jQuery('.remindr-noticemsg');
    this.$mailmsg = jQuery('.remindr-mailmsg');
    this.currentType = this.$('input[type=radio]:checked').val();

    this.handleState();
  },
  handleClick: function(event){
    this.currentType = this.$('input[type=radio]:checked').val();
    this.handleState();
  },
  handleState: function () {

    switch (this.currentType) {
      case 'any':
        this.$adminmsg.removeClass('remindr-hide');
        this.$mailmsg.removeClass('remindr-hide');
        break;
      case 'adminnotice':
        this.$adminmsg.removeClass('remindr-hide');
        this.$mailmsg.addClass('remindr-hide');
        break;
      case 'mail':
        this.$adminmsg.addClass('remindr-hide');
        this.$mailmsg.removeClass('remindr-hide');
        break;

    }

  }

});
},{}]},{},[1]);
