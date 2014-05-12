<?php

/**
 * Implements hook_fieldcontext_option_info().
 */
function hook_fieldcontext_option_info() {
  return array(
    /*
     * This option is not valid because option key does not match the validity pattern.
     *
     * @see fieldcontext_value_pattern()
     */
    'nove mber %' => array(
      'title' => t('November'),
    ),
    /*
     * The following options are valid and will be displayed in field instance edit form
     *
     * @see fieldcontext_value_pattern()
     */
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
