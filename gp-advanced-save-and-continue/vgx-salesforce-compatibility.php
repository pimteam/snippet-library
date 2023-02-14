<?php

/**
 * Gravity Perks // File Renamer // VGX Salesforce Compatibility
 * https://gravitywiz.com/documentation/gravity-forms-file-renamer/
 *
 * Compatibility snippet to ensure that files are renamed by GP File Renamer before being
 * uploaded to the Salesforce API by VGX Salesforce.
 */

add_filter( 'plugins_loaded', function() {
	global $vxg_salesforce;

	if ( ! class_exists( 'vxg_salesforce' ) ) {
		return;
	}

	remove_action( 'gform_entry_created', array( $vxg_salesforce, 'gf_entry_created_before' ), 99 );
}, 11 ); // 11 so that this happens after vxg salesforce



add_filter( 'gform_entry_post_save', function( $entry, $form ) {
	global $vxg_salesforce;
	$vxg_salesforce->gf_entry_created_before( $entry, $form );

	return $entry;
}, 10, 2 ); // 10 so that this happens after GP-File-Renamer
