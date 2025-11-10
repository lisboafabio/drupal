<?php

namespace Drupal\simple_voting\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines the Question entity.
 *
 * @ContentEntityType(
 *   id = "simple_voting_question",
 *   label = @Translation("Question"),
 *   base_table = "simple_voting_question",
 *   handlers = {
 *     "form" = {
 *       "default" = "Drupal\simple_voting\Form\QuestionForm",
 *       "add" = "Drupal\simple_voting\Form\QuestionForm",
 *       "edit" = "Drupal\simple_voting\Form\QuestionForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"
 *     },
 *     "list_builder" = "Drupal\simple_voting\QuestionListBuilder"
 *   },
 *   admin_permission = "administer simple voting",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "label" = "title"
 *   },
 *   links = {
 *     "add-form" = "/admin/content/simple-voting/questions/add",
 *     "edit-form" = "/admin/content/simple-voting/questions/{simple_voting_question}/edit",
 *     "delete-form" = "/admin/content/simple-voting/questions/{simple_voting_question}/delete",
 *     "collection" = "/admin/content/simple-voting/questions"
 *   }
 * )
 */
class Question extends ContentEntityBase {
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Título'))
      ->setRequired(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE);

    $fields['show_results'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Mostrar resultados após votação'))
      ->setDefaultValue(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
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
