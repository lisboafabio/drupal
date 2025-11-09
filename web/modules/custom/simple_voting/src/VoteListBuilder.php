<?php

namespace Drupal\simple_voting;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;

/**
 * List builder for Vote entities.
 */
class VoteListBuilder extends EntityListBuilder {

  public function buildHeader() {
    $header['id'] = $this->t('ID');
    $header['user'] = $this->t('User');
    $header['question'] = $this->t('Question');
    $header['option'] = $this->t('Option');
    $header['created'] = $this->t('Date');
    return $header + parent::buildHeader();
  }

  public function buildRow(EntityInterface $entity) {
    /** @var \Drupal\simple_voting\Entity\Vote $entity */
    $row['id'] = $entity->id();

    $user = $entity->get('user_id')->entity;
    $question = $entity->get('question_id')->entity;
    $option = $entity->get('option_id')->entity;

    $row['user'] = $user ? $user->label() : $this->t('N/A');
    $row['question'] = $question ? $question->label() : $this->t('N/A');
    $row['option'] = $option ? $option->label() : $this->t('N/A');

    $row['created'] = \Drupal::service('date.formatter')->format($entity->get('created')->value, 'short');

    return $row + parent::buildRow($entity);
  }

  public function render() {
    $build = parent::render();

    // Adiciona o botão "Adicionar voto" acima da tabela.
    $build['table']['#empty'] = $this->t('Nenhum voto registrado ainda.');

    $build = [
    'add_link' => [
        '#type' => 'link',
        '#title' => $this->t('Adicionar voto'),
        '#url' => Url::fromRoute('entity.simple_voting_vote.add_form'),
        '#attributes' => ['class' => ['button', 'button--primary']],
    ],
    ] + parent::render();

    return $build;
  }

}
