<?php

namespace Drupal\workflow_assignment\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldWidget\OptionsButtonsWidget;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\FieldableEntityInterface;

/**
 * Plugin implementation of the 'workflow_list_widget' widget.
 *
 * @FieldWidget(
 *   id = "workflow_list_widget",
 *   label = @Translation("Workflow List Selector"),
 *   field_types = {
 *     "entity_reference"
 *   }
 * )
 */
class WorkflowListWidget extends OptionsButtonsWidget {

  /**
   * {@inheritdoc}
   */
  protected function getOptions(FieldableEntityInterface $entity) {
    $options = parent::getOptions($entity);
    
    // Enhance the options with assignment information
    $enhanced_options = [];
    foreach ($options as $key => $label) {
      if ($key == '_none') {
        $enhanced_options[$key] = $label;
        continue;
      }
      
      // Load the workflow entity to get assignment details
      $workflow = \Drupal::entityTypeManager()
        ->getStorage('workflow_list')
        ->load($key);
        
      if ($workflow) {
        $assigned_label = $workflow->getAssignedLabel();
        $assigned_type = $workflow->getAssignedType();
        
        if ($assigned_label && $assigned_type) {
          $type_labels = [
            'user' => $this->t('User'),
            'group' => $this->t('Group'),
            'destination' => $this->t('Dest'),
          ];
          
          $type_label = isset($type_labels[$assigned_type]) ? $type_labels[$assigned_type] : $assigned_type;
          $enhanced_options[$key] = $workflow->label() . ' (' . $type_label . ': ' . $assigned_label . ')';
        }
        else {
          $enhanced_options[$key] = $workflow->label();
        }
      }
      else {
        $enhanced_options[$key] = $label;
      }
    }
    
    return $enhanced_options;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element = parent::formElement($items, $delta, $element, $form, $form_state);
    
    // Add help text and links
    $element['#description'] = $this->t('Select one or more workflows to assign to this content. View full workflow details on the Workflow tab.');
    
    // Add suffix with helpful links
    $element['#suffix'] = '<div class="workflow-widget-help">' . 
      '<div class="description">' . 
      $this->t('Need a new workflow? <a href="@url" target="_blank">Create one here</a>.', [
        '@url' => '/admin/structure/workflow-list/add',
      ]) . 
      '</div>' .
      '<div class="description"><em>' . 
      $this->t('Tip: Use the Workflow tab for a detailed table view of all assigned workflows.') . 
      '</em></div>' .
      '</div>';
    
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function massageFormValues(array $values, array $form, FormStateInterface $form_state) {
    // Filter out unchecked checkboxes (value = 0)
    // Checkboxes return 0 for unchecked, but entity reference fields
    // expect only valid entity IDs or NULL
    $filtered = [];
    
    foreach ($values as $value) {
      // Check if target_id exists and is not 0 or empty
      if (isset($value['target_id']) && $value['target_id'] !== 0 && $value['target_id'] !== '0' && !empty($value['target_id'])) {
        $filtered[] = $value;
      }
    }
    
    return $filtered;
  }

}