jQuery(document).ready(function($) {
    $('#imc-calculator-form').on('submit', function(event) {
      event.preventDefault();
      var form_data = $(this).serialize();
      $.ajax({
        url: imc_ajax_object.ajax_url,
        method: 'POST',
        data: form_data + '&action=imc_ajax_calculator',
        success: function(response) {
          $('#result').html('Your IMC is: ' + response);
        },
        error: function (error) { 
            $('#result').html(error);
         }
      });
    });
  });