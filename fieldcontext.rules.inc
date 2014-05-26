<?php

/**
 * @file
 * Rules for Field context module.
 */

/**
 * Implements hook_rules_condition_info().
 */
function fieldcontext_rules_condition_info() {
  $conditions['entity_has_field_with_context'] = array(
    'label' => t('Entity has field with a context'),
    'parameter' => array(
      'entity' => array(
        'type' => 'entity',
        'label' => t('Entity'),
        'description' => t('Specifies the entity for which to evaluate the condition.'),
        'restriction' => 'selector',
      ),
      'context' => array(
        'type' => 'text',
        'label' => t('Field context'),
        'description' => t('Specifies the field context.'),
        'restriction' => 'input',
      ),
      'preg_match' => array(
        'type' => 'boolean',
        'label' => t('Use context as a regular expression.'),
        'description' => t('Specifies whether field context contains a regular expression.'),
        'default value' => FALSE,
        'restriction' => 'input',
      ),
    ),
    'group' => t('Entities'),
    'base' => 'fieldcontext_rules_condition_entity_has_field_with_context',
  );

  return $conditions;
}

/**
 * Implements hook_rules_action_info().
 */
function fieldcontext_rules_action_info() {
  $actions['field_get_from_context'] = array(
    'label' => t('Fetch field name by context'),
    'parameter' => array(
      'entity' => array(
        'type' => 'entity',
        'label' => t('Entity'),
        'description' => t('Specifies the entity, which contains the field.'),
        'restriction' => 'selector',
        'wrapped' => TRUE,
      ),
      'context' => array(
        'type' => 'text',
        'label' => t('Field context'),
        'description' => t('Specifies the field context.'),
        'restriction' => 'input',
      ),
      'preg_match' => array(
        'type' => 'boolean',
        'label' => t('Use context as a regular expression.'),
        'description' => t('Specifies whether field context contains a regular expression.'),
        'default value' => FALSE,
        'restriction' => 'input',
      ),
    ),
    'provides' => array(
      'field_name' => array(
        'type' => 'text',
        'label' => t('Field name'),
      ),
    ),
    'group' => t('Entities'),
    'base' => 'fieldcontext_rules_action_field_get_from_context',
  );

  return $actions;
}

/**
 * Condition: Entity has field with a context.
 */
function fieldcontext_rules_condition_entity_has_field_with_context(EntityDrupalWrapper $wrapper, $context, $preg_match) {
  // Get field name by context.
  $field_name = fieldcontext_get_field_name($context, $wrapper->type(), $wrapper->getBundle(), $preg_match);

  if (!empty($field_name)) {
    return TRUE;
  }

  return FALSE;
}

/**
 * Rules action: Return a field name by context.
 */
function fieldcontext_rules_action_field_get_from_context(EntityDrupalWrapper $wrapper, $context, $preg_match) {
  // Get field name by context.
  $field_name = fieldcontext_get_field_name($context, $wrapper->type(), $wrapper->getBundle(), $preg_match);

  return array(
    'field_name' => $field_name,
  );
}

/**
 * Assert that the entity has the field with a context.
 */
function fieldcontext_rules_action_field_get_from_context_assertions($element) {
  // Assert the field is there if the condition matches.
  if ($wrapper = $element->applyDataSelector($element->settings['entity:select'])) {
    // Get variables.
    $type = $wrapper->type();
    $context = $element->settings['context'];
    $preg_match_flag = $element->settings['preg_match'];
    // Get field properties.
    $field_properties = fieldcontext_get_field_name_multiple($context, $type, NULL, $preg_match_flag);
    // Get all possible properties and check whether we have one for the field.
    $properties = entity_get_all_property_info($type == 'entity' ? NULL : $type);

    if (!empty($field_properties[$type])) {
      $assertions = array();
      // Loop through all the bundles.
      foreach ($field_properties[$type] as $fieldcontext) {
        // Loop through fields with a context.
        foreach ($fieldcontext as $field_property) {
          // Add field property to property info list.
          if (isset($properties[$field_property])) {
            $assertions[$field_property] = $properties[$field_property];
          }
        }
      }

      return array($element->settings['entity:select'] => array('property info' => $assertions));
    }
  }
}
