<?php

/**
 * Add custom meta field to user
 * 
 */
add_action('show_user_profile', 'my_user_profile_edit_action');
add_action('edit_user_profile', 'my_user_profile_edit_action');
add_action('personal_options_update', 'save_custom_metafield');
add_action('edit_user_profile_update', 'save_custom_metafield');

function my_user_profile_edit_action($user)
{
  $custom_metafield = get_user_meta($user->ID, 'custom_metafield', true);
?>
  <h3>User Code</h3>
  <table class="form-table">
    <tr>
      <th><label for="custom_metafield">User Code</label></th>
      <td>
        <input name="custom_metafield" type="text" id="custom_metafield" value="<?php echo esc_attr($custom_metafield); ?>">
        <p class="description">Enter your unique code.</p>
      </td>
    </tr>
  </table>
<?php
}

function save_custom_metafield($user_id)
{
  if (!current_user_can('edit_user', $user_id)) {
    return false;
  }

  if (isset($_POST['custom_metafield'])) {
    update_user_meta($user_id, 'custom_metafield', sanitize_text_field($_POST['custom_metafield']));
  }
}


/**
 * Create random numbers fields to customizer
 */
function neild_random_number_customizer_settings($wp_customize)
{
  // Add a new section
  $wp_customize->add_section('random_access_key_section', array(
    'title'    => __('Random Access Keys', 'textdomain'),
    'priority' => 10,
  ));

  // Add a setting for a Random key 1
  $wp_customize->add_setting('randome_key_1', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));

  // Add a control for the Random key 1
  $wp_customize->add_control('randome_key_1', array(
    'label'    => __('Random key 1', 'textdomain'),
    'section'  => 'random_access_key_section',
    'settings' => 'randome_key_1',
    'type'     => 'text',
  ));

  // Add a setting for a Random key 2
  $wp_customize->add_setting('randome_key_2', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));

  // Add a control for the Random key 2
  $wp_customize->add_control('randome_key_2', array(
    'label'    => __('Random key 2', 'textdomain'),
    'section'  => 'random_access_key_section',
    'settings' => 'randome_key_2',
    'type'     => 'text',
  ));

  // Add a setting for a Random key 3
  $wp_customize->add_setting('randome_key_3', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));

  // Add a control for the Random key 3
  $wp_customize->add_control('randome_key_3', array(
    'label'    => __('Random key 3', 'textdomain'),
    'section'  => 'random_access_key_section',
    'settings' => 'randome_key_3',
    'type'     => 'text',
  ));
}

add_action('customize_register', 'neild_random_number_customizer_settings');

/**
 *  Random number from customization
 *  Custom random number validattion ajax
 * */

add_action('wp_ajax_process_ajax', 'process_ajax');
add_action('wp_ajax_nopriv_process_ajax', 'process_ajax'); // If you want to handle non-logged in users

function process_ajax()
{
  // Get the input value sent via AJAX
  $inputValue = sanitize_text_field($_POST['inputValue']);


  $accessKeys = [
    get_theme_mod('randome_key_1'),
    get_theme_mod('randome_key_2'),
    get_theme_mod('randome_key_3'),
  ];


  // Send the response
  echo json_encode([
    'data' => $accessKeys,
    'status' => true,
    'input_value' => $inputValue,
    'key_found' => in_array($inputValue, $accessKeys),
  ]);

  // Always exit to avoid extra output
  wp_die();
}




