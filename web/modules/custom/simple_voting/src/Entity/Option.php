<?php

namespace Drupal\simple_voting\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines the Option entity.
 *
 * @ContentEntityType(
 *   id = "simple_voting_option",
 *   label = @Translation("Option"),
 *   base_table = "simple_voting_option",
 *   handlers = {
 *     "form" = {
 *       "default" = "Drupal\simple_voting\Form\OptionForm",
 *       "add" = "Drupal\simple_voting\Form\OptionForm",
 *       "edit" = "Drupal\simple_voting\Form\OptionForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"
 *     },
 *     "list_builder" = "Drupal\simple_voting\OptionListBuilder"
 *   },
 *   admin_permission = "administer simple voting",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "label" = "title"
 *   },
 *   links = {
 *     "add-form" = "/admin/content/simple-voting/options/add",
 *     "edit-form" = "/admin/content/simple-voting/options/{simple_voting_option}/edit",
 *     "delete-form" = "/admin/content/simple-voting/options/{simple_voting_option}/delete",
 *     "collection" = "/admin/content/simple-voting/options"
 *   }
 * )
 */

class Option extends ContentEntityBase {
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Título da opção'))
      ->setRequired(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE);

    $fields['question_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Pergunta'))
      ->setRequired(TRUE)
      ->setSetting('target_type', 'simple_voting_question')
      ->setDisplayOptions('form', [
        'type' => 'options_select',
        'weight' => 1,
      ])
      ->setDisplayConfigurable('form', TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Ativa'))
      ->setDefaultValue(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => 2,
      ])
      ->setDisplayConfigurable('form', TRUE);

    return $fields;
  }

}
