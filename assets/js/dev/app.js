var TypeInput = require('./modules/Type');

jQuery(document).ready(function($){

  $('#remindr-dtpicker').datetimepicker({
    format:'d.m.Y H:i:s',
  });

  var type = new TypeInput({
    el : '#remindr-type'
  })

});