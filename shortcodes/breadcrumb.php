<?php
function breadcrumb_shortcode()
{
  // Get the current URL
  $url = get_permalink();
  // Remove the home URL to get the relative path
  $path = trim(str_replace(home_url('/'), '', $url), '/');
  // Build the breadcrumb trail
  $output = '<div style="display: flex; align-content: center; align-items: center; gap: 5px; font-size: 90%;" class="breadcrumbs">' . '<span><a href="/">' . esc_html('Home') . '</a></span>';
  // Separator icon >>
  $separator = ' <span class="elementor-icon-list-icon">
							<svg aria-hidden="true" class="e-font-icon-svg e-fas-angle-double-right" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34zm192-34l-136-136c-9.4-9.4-24.6-9.4-33.9 0l-22.6 22.6c-9.4 9.4-9.4 24.6 0 33.9l96.4 96.4-96.4 96.4c-9.4 9.4-9.4 24.6 0 33.9l22.6 22.6c9.4 9.4 24.6 9.4 33.9 0l136-136c9.4-9.2 9.4-24.4 0-33.8z"></path></svg>						</span> ';

  $current_url = home_url();
  $breadcrumbs = explode('/', $path);
  foreach ($breadcrumbs as $crumb) {
    $current_url .= '/' . $crumb;
    // var_dump($current_url);
    $output .= $separator . '<span><a style="text-transform:capitalize;" href="' . $current_url . '">' . esc_html(ucfirst(str_replace('-', ' ', $crumb))) . '</a></span>';
  }

  $output .= '</div>';

  return $output;
}

