<?php

/**
 * @file
 * API documentation for Field context module.
 */

/**
 * Implements hook_fieldcontext_option_info().
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
 * Implements hook_fieldcontext_option_group_info().
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
 */
function hook_fieldcontext_options_alter(&$options) {
  $options['foo'] = t('Bar');
}

/**
 * Alters allowed field context value pattern.
 */
function hook_fieldcontext_value_pattern_alter(&$pattern) {
  $pattern = '/^[A-Za-z0-9\-_.]+$/';
}

/**
 * Alter allowed field context value pattern description.
 */
function hook_fieldcontext_value_pattern_description_text_alter(&$text) {
  $text = t('alphanumeric values, underscores or dashes');
}
