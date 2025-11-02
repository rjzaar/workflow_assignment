<?php

namespace Drupal\workflow_assignment\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Drupal\node\NodeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * Controller for the workflow tab on nodes.
 */
class NodeWorkflowController extends ControllerBase {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The module handler.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  protected $moduleHandler;

  /**
   * Constructs a NodeWorkflowController object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, ModuleHandlerInterface $module_handler) {
    $this->entityTypeManager = $entity_type_manager;
    $this->moduleHandler = $module_handler;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('module_handler')
    );
  }

  /**
   * Displays the workflow tab content.
   *
   * @param \Drupal\node\NodeInterface $node
   *   The node entity.
   *
   * @return array
   *   A render array.
   */
  public function workflowTab(NodeInterface $node) {
    // Get all assigned workflows
    $workflow_ids = [];
    if ($node->hasField('field_workflow_list')) {
      foreach ($node->get('field_workflow_list') as $item) {
        if (!empty($item->value)) {
          $workflow_ids[] = $item->value;
        }
      }
    }

    $workflows = [];
    if (!empty($workflow_ids)) {
      // Load all workflows
      $workflows = $this->entityTypeManager
        ->getStorage('workflow_list')
        ->loadMultiple($workflow_ids);
    }

    $can_edit = $this->currentUser()->hasPermission('assign workflow lists to content');

    // Render using template
    $build = [
      '#theme' => 'workflow_tab_content',
      '#workflows' => $workflows,
      '#node' => $node,
      '#can_edit' => $can_edit,
      '#attached' => [
        'library' => ['workflow_assignment/workflow_tab'],
      ],
    ];

    return $build;
  }
}
