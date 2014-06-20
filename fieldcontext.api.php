<?php

/**
 * @file
 * API documentation for Field context module.
 */

/**
 * Returns predefined context options.
 *
 * Predefined context options allow users to select field context via drop down
 * menu rather than entering the field context manually.
 *
 * Each option array should be keyed by a valid field context value and contain
 * the following elements:
 *   1. title (required) - human readable context name;
 *   2. group (optional) - option group ("optgroup" in HTML "select" element);
 *   3. weight (optional) - option weight in option group.
 *
 * @return array
 *   An array containing predefined context options.
 */
function hook_fieldcontext_option_info() {
  return array(
    // This option is not valid because option key does not match the validity
    // pattern. See fieldcontext_value_pattern().
    'nove mber %' => array(
      'title' => t('November'),
    ),
    // The following options are valid and will be displayed in field instance
    // edit form.
    'december' => array(
      'title' => t('December'),
      'group' => 'winter',
      'weight' => 0,
    ),
    'january' => array(
      'title' => t('January'),
      'group' => 'winter',
      'weight' => 1,
    ),
    'february' => array(
      'title' => t('February'),
      'group' => 'winter',
      'weight' => 2,
    ),
    'march' => array(
      'title' => t('March'),
      'group' => 'spring',
      'weight' => 0,
    ),
    // The following options will not be grouped in select option as no "group"
    // attribute is specified.
    'april' => array(
      'title' => t('April'),
      'weight' => 0,
    ),
    'may' => array(
      'title' => t('May'),
      'weight' => 1,
    ),
  );
}

/**
 * Returns predefined context option groups.
 *
 * Predefined context option groups can be used to group together field context
 * options in drop down menu. Context option groups are displayed in optgroup
 * tag within predefined field context drop down menu.
 *
 * Each group array should be keyed by an arbitrary option group value and
 * contain the following elements:
 *   1. title (required) - human readable group name;
 *   2. weight (optional) - group weight in drop down menu.
 *
 * @return array
 *   An array containing predefined context option groups.
 */
function hook_fieldcontext_option_group_info() {
  return array(
    'winter' => array(
      'title' => t('Winter'),
      'weight' => 0,
    ),
    'spring' => array(
      'title' => t('Spring'),
      'weight' => 1,
    ),
  );
}

/**
 * Alter predefined field context options.
 *
 * @param array $options
 *   Predefined field context options.
 */
function hook_fieldcontext_options_alter(array &$options) {
  $options['foo'] = t('Bar');
}

/**
 * Alters allowed field context value pattern.
 *
 * @param string $pattern
 *   Regular expression pattern.
 */
function hook_fieldcontext_value_pattern_alter(&$pattern) {
  $pattern = '/^[A-Za-z0-9\-_.]+$/';
}

/**
 * Alter allowed field context value pattern description.
 *
 * @param string $text
 *   Human readable description of valid field context values.
 */
function hook_fieldcontext_value_pattern_description_text_alter(&$text) {
  $text = t('alphanumeric values, underscores or dashes');
}
