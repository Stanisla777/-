$(document).ready(function() {
  
  if($('#example1').length) {
    $('#example1').ketchup();
  }
  
  if($('#example2').length) {
    $('#example2').ketchup({
      validationAttribute: 'rel',
      errorContainer: $('<div>', {
        'class': 'ketchup-error-container-alt',
        html: '<ol></ol>'
      }),
      initialPositionContainer: function(errorContainer, field) {
       },
      positionContainer: function(errorContainer, field) {},
      showContainer: function(errorContainer) {
        errorContainer.slideDown('fast');
      },
      hideContainer: function(errorContainer) {
        errorContainer.slideUp('fast');
      }
    });
  }
  
  if($('#example3').length) {
    $('#example3').ketchup();
  }
  
  if($('#example4').length) {
    $('#example4').ketchup();
  }
});