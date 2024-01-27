jQuery(document).ready(function ($) {
  var errorMessage = jQuery("#error-message");
  console.log("loaded");
  // Attach an event listener to the input field
  jQuery("#validation_form").on("submit", function () {
    // Get the value of the input field
    var inputValue = jQuery("#form-field-name").val();

    // Perform an AJAX call using the admin-ajax.php file
    jQuery.ajax({
      type: "POST",
      url: "/wp-admin/admin-ajax.php", // WordPress admin-ajax.php URL
      data: {
        action: "process_ajax", // Action to trigger in your functions.php
        inputValue: inputValue, // Pass the input value to the server
      },
      success: function (response) {
        // Handle the response from the server

        console.log(typeof response);
        var response_obj = JSON.parse(response);

        if (response_obj.key_found === true) {
          console.log(
            "Match found: Custom Metafield exists for at least one user."
          );
          errorMessage.hide();

          // Store in local storage
          localStorage.setItem("code", "true");

          window.location.href = "/";
        } else {
          console.log(
            "No match found: Custom Metafield does not exist for any user."
          );
          errorMessage.show();

          // Remove from local storage
          localStorage.removeItem("code");
        }
      },
    });
  });
});
