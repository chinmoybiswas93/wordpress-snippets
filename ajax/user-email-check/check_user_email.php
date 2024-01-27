<?php

function check_user_email()
{
  // Get the email from the AJAX request
  $email = $_POST['email'];

  // Check if the email exists in the user database
  $user = get_user_by('email', $email);

  // Send a JSON response back to the client
  if ($user) {
    wp_send_json(['exists' => true]);
  } else {
    wp_send_json(['exists' => false]);
  }

  // Make sure to exit after sending the JSON response
  exit;
}

// Hook for handling the AJAX request
add_action('wp_ajax_check_user_email', 'check_user_email');
add_action('wp_ajax_nopriv_check_user_email', 'check_user_email');
