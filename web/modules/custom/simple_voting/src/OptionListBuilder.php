<?php

namespace Drupal\simple_voting;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Defines a list builder for Option entities.
 */
class OptionListBuilder extends EntityListBuilder {

  public function buildHeader() {
    $header['id'] = $this->t('ID');
    $header['title'] = $this->t('Título');
    $header['question'] = $this->t('Pergunta');
    return $header + parent::buildHeader();
  }

  public function buildRow(EntityInterface $entity) {
    $question_label = '-';
    if ($entity->get('question_id')->entity) {
      $question_label = $entity->get('question_id')->entity->label();
    }

    $row['id'] = $entity->id();
    $row['title'] = Link::createFromRoute(
      $entity->label(),
      'entity.simple_voting_option.edit_form',
      ['simple_voting_option' => $entity->id()]
    );
    $row['question'] = $question_label;

    return $row + parent::buildRow($entity);
  }

  public function render() {
    $build['#type'] = 'container';
    $build['#attributes']['class'][] = 'simple-voting-option-list';

    // Botão para adicionar nova opção.
    $build['add_link'] = [
      '#type' => 'link',
      '#title' => $this->t('Adicionar Opção'),
      '#url' => Url::fromRoute('entity.simple_voting_option.add_form'),
      '#attributes' => [
        'class' => ['button', 'button--primary'],
      ],
    ];

    $build['list'] = parent::render();
    return $build;
  }
}
