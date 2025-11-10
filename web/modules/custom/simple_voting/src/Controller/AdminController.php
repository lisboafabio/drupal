<?php

namespace Drupal\simple_voting\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

class AdminController extends ControllerBase {
  public function index() {
    $build = [
      '#theme' => 'item_list',
      '#title' => $this->t('Gerenciamento de Votação'),
      '#items' => [
        Link::fromTextAndUrl($this->t('Gerenciar Perguntas'), Url::fromRoute('entity.simple_voting_question.collection')),
        Link::fromTextAndUrl($this->t('Gerenciar Opções'), Url::fromRoute('entity.simple_voting_option.collection')),
        Link::fromTextAndUrl($this->t('Gerenciar Votos'), Url::fromRoute('entity.simple_voting_vote.collection')),
      ],
    ];
    return $build;
  }
}
