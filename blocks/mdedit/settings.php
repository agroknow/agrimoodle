<?php
# comment
$settings->add(new admin_setting_heading(
				'headerconfig',
				get_string('hdr_config', 'block_mdedit'),
				get_string('dsc_config', 'block_mdedit')
));


$settings->add(new admin_setting_configcheckbox(
				'mdedit/Contact_SAMGI',
				get_string('lbl_allowsamgi', 'block_mdedit'),
				get_string('dsc_allowsamgi', 'block_mdedit'),
				'0'
));
$settings->add(new admin_setting_configcheckbox(
				'mdedit/Contact_SAMGI',
				get_string('lbl_allowsamgi', 'block_mdedit'),
				get_string('dsc_allowsamgi', 'block_mdedit'),
				'0'
));
?>
