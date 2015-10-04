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