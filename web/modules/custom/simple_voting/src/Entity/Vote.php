<?php

namespace Drupal\simple_voting\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines the Vote entity.
 *
 * @ContentEntityType(
 *   id = "simple_voting_vote",
 *   label = @Translation("Vote"),
 *   base_table = "simple_voting_vote",
 *   handlers = {
 *     "form" = {
 *       "default" = "Drupal\simple_voting\Form\VoteForm",
 *       "add" = "Drupal\simple_voting\Form\VoteForm",
 *       "edit" = "Drupal\simple_voting\Form\VoteForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"
 *     },
 *     "list_builder" = "Drupal\simple_voting\VoteListBuilder"
 *   },
 *   admin_permission = "administer simple voting",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "add-form" = "/admin/content/simple-voting/votes/add",
 *     "edit-form" = "/admin/content/simple-voting/votes/{simple_voting_vote}/edit",
 *     "delete-form" = "/admin/content/simple-voting/votes/{simple_voting_vote}/delete",
 *     "collection" = "/admin/content/simple-voting/votes"
 *   }
 * )
 */
class Vote extends ContentEntityBase {


  public function preSave(\Drupal\Core\Entity\EntityStorageInterface $storage) {
    parent::preSave($storage);

    // Define automaticamente o usuário logado se não estiver setado.
    if ($this->get('user_id')->isEmpty() && \Drupal::currentUser()->isAuthenticated()) {
        $this->set('user_id', \Drupal::currentUser()->id());
    }
  }

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);
    
    // Usuário que votou.
    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
    ->setLabel(t('User'))
    ->setSetting('target_type', 'user')
    ->setRequired(TRUE)
    ->setDisplayConfigurable('form', TRUE)
    ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
    ]);

    // Pergunta relacionada.
    $fields['question_id'] = BaseFieldDefinition::create('entity_reference')
        ->setLabel(t('Question'))
        ->setSetting('target_type', 'simple_voting_question')
        ->setRequired(TRUE)
        ->setDisplayOptions('form', [
        'type' => 'options_select',
        'weight' => 1,
        ])
        ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'entity_reference_label',
        'weight' => 1,
        ]);

    // Opção escolhida.
    $fields['option_id'] = BaseFieldDefinition::create('entity_reference')
        ->setLabel(t('Option'))
        ->setSetting('target_type', 'simple_voting_option')
        ->setRequired(TRUE)
        ->setDisplayOptions('form', [
        'type' => 'options_select',
        'weight' => 2,
        ])
        ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'entity_reference_label',
        'weight' => 2,
        ]);

    // Data de criação.
    $fields['created'] = BaseFieldDefinition::create('created')
        ->setLabel(t('Created'))
        ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'timestamp',
        'weight' => 3,
        ]);

    return $fields;
  }
}
