<?php

namespace Drupal\simple_voting\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\user\Entity\User;

class VoteApiController extends ControllerBase {
  public function registerVote(Request $request) {
    // Pega o header 'X-API-KEY' da requisição
    $header_api_key = $request->headers->get('X-API-KEY');

    if (!$header_api_key) {
      return new JsonResponse([
        'status' => 'error',
        'message' => 'API Key ausente.'
      ], JsonResponse::HTTP_FORBIDDEN);
    }

    // Busca o usuário que possui esta API Key
    $uids = \Drupal::entityQuery('user')
      ->accessCheck(FALSE)
      ->condition('field_api_key', $header_api_key)
      ->range(0, 1)
      ->execute();

    if (empty($uids)) {
      return new JsonResponse([
        'status' => 'error',
        'message' => 'API Key inválida.'
      ], JsonResponse::HTTP_FORBIDDEN);
    }

    $uid = reset($uids);
    $user_entity = User::load($uid);

    // Decodifica dados do POST
    $data = json_decode($request->getContent(), TRUE);

    if (empty($data['question_id']) || empty($data['option_id'])) {
      return new JsonResponse([
        'status' => 'error',
        'message' => 'Campos obrigatórios ausentes.'
      ], JsonResponse::HTTP_BAD_REQUEST);
    }

    $connection = Database::getConnection();

    // Verifica se o usuário já votou na pergunta
    $exists = $connection->select('simple_voting_vote', 'v')
      ->fields('v', ['id'])
      ->condition('user_id', $user_entity->id())
      ->condition('question_id', $data['question_id'])
      ->execute()
      ->fetchField();

    if ($exists) {
      return new JsonResponse([
        'status' => 'error',
        'message' => 'Você já votou nesta pergunta.'
      ], JsonResponse::HTTP_FORBIDDEN);
    }

    // Cria e salva o voto
    $vote = \Drupal::entityTypeManager()
      ->getStorage('simple_voting_vote')
      ->create([
        'user_id' => $user_entity->id(),
        'question_id' => $data['question_id'],
        'option_id' => $data['option_id'],
      ]);
    $vote->save();

    return new JsonResponse([
      'status' => 'success',
      'message' => 'Voto registrado com sucesso!',
      'vote_id' => $vote->id(),
      'user' => $user_entity->getDisplayName(),
    ], JsonResponse::HTTP_ACCEPTED);
  }

    public function getQuestions(Request $request) {
      $header_api_key = $request->headers->get('X-API-KEY');

      if (!$header_api_key) {
        return new JsonResponse([
          'status' => 'error',
          'message' => 'API Key ausente.'
        ], JsonResponse::HTTP_FORBIDDEN);
      }

      // Busca o usuário que possui esta API Key
      $uids = \Drupal::entityQuery('user')
        ->accessCheck(FALSE)
        ->condition('field_api_key', $header_api_key)
        ->range(0, 1)
        ->execute();

      if (empty($uids)) {
        return new JsonResponse([
          'status' => 'error',
          'message' => 'API Key inválida.'
        ], JsonResponse::HTTP_FORBIDDEN);
      }

      $questions = \Drupal::entityTypeManager()
          ->getStorage('simple_voting_question')
          ->loadMultiple();

      $result = [];
      foreach ($questions as $q) {
          $result[] = [
              'id' => $q->id(),
              'title' => $q->label(),
          ];
      }

      return new JsonResponse($result);
  }

  public function getOptions(Request $request, $question_id) {
    $header_api_key = $request->headers->get('X-API-KEY');

      if (!$header_api_key) {
        return new JsonResponse([
          'status' => 'error',
          'message' => 'API Key ausente.'
        ], JsonResponse::HTTP_FORBIDDEN);
      }

      // Busca o usuário que possui esta API Key
      $uids = \Drupal::entityQuery('user')
        ->accessCheck(FALSE)
        ->condition('field_api_key', $header_api_key)
        ->range(0, 1)
        ->execute();

      if (empty($uids)) {
        return new JsonResponse([
          'status' => 'error',
          'message' => 'API Key inválida.'
        ], JsonResponse::HTTP_FORBIDDEN);
      }
    
    $options = \Drupal::entityTypeManager()
          ->getStorage('simple_voting_option')
          ->loadByProperties(['question_id' => $question_id]);

      $result = [];
      foreach ($options as $o) {
          $result[] = [
              'id' => $o->id(),
              'title' => $o->label(),
          ];
      }

      return new JsonResponse($result);
  }

}
