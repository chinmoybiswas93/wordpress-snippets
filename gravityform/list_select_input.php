<?php

/**
 * Format: gform_column_input_FORMID_FIELDID_COLUMN.
 * gform_column_input_3_189_4 Update this to fied input and column
 */


// Format: gform_column_input_FORMID_FIELDID_COLUMN.
add_filter('gform_column_input_3_189_4', 'pbj_pb_selections');
function pbj_pb_selections()
{

	$pb_types = array(
		'type'    => 'select',
		'choices' => array('Yes', 'No'),
	);

	return $pb_types;
}
