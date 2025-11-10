<?php

namespace Drupal\simple_voting\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

class AdminController extends ControllerBase {
  public function index() {

    $links = [
      Link::fromTextAndUrl($this->t('Gerenciar Perguntas'), Url::fromRoute('entity.simple_voting_question.collection'))->toRenderable(),
      Link::fromTextAndUrl($this->t('Gerenciar Opções'), Url::fromRoute('entity.simple_voting_option.collection'))->toRenderable(),
      Link::fromTextAndUrl($this->t('Gerenciar Votos'), Url::fromRoute('entity.simple_voting_vote.collection'))->toRenderable(),
    ];

    foreach ($links as &$link) {
      $link['#attributes']['class'] = ['button', 'button--primary', 'button--small'];
    }

    $build = [
      '#theme' => 'item_list',
      '#title' => $this->t('Gerenciamento de Votação'),
      '#items' => $links,
      '#attributes' => [
        'class' => ['admin-list'],
      ],
    ];

    $build = [
      '#type' => 'container', // contêiner sem <ul>
      '#attributes' => [
        'class' => ['voting-admin-links'],
      ],
      'links' => $links,
    ];

    return $build;
  }
}
