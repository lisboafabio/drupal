<?php

namespace Drupal\simple_voting;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Define a list builder for Question entities.
 */
class QuestionListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('ID');
    $header['title'] = $this->t('Título');
    $header['status'] = $this->t('Ativa');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['id'] = $entity->id();
    $row['title'] = Link::createFromRoute(
      $entity->label(),
      'entity.simple_voting_question.edit_form',
      ['simple_voting_question' => $entity->id()]
    );
    $row['status'] = $entity->get('status')->value ? $this->t('Sim') : $this->t('Não');
    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritdoc}
   */
  public function render() {
    $build['#type'] = 'container';
    $build['#attributes']['class'][] = 'simple-voting-question-list';

    // Botão para adicionar nova pergunta.
    $build['add_link'] = [
      '#type' => 'link',
      '#title' => $this->t('Adicionar Pergunta'),
      '#url' => Url::fromRoute('entity.simple_voting_question.add_form'),
      '#attributes' => [
        'class' => ['button', 'button--primary'],
      ],
    ];

    $build['list'] = parent::render();
    return $build;
  }
}
