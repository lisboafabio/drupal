<?php

namespace Drupal\simple_voting\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;

class VoteApiController extends ControllerBase {
  public function registerVote(Request $request) {
    $current_user = $this->currentUser();

    if ($current_user->isAnonymous()) {
      return new JsonResponse([
        'status' => 'error',
        'message' => 'Você precisa estar autenticado para votar.'
      ], JsonResponse::HTTP_FORBIDDEN);
    }

    $data = json_decode($request->getContent(), TRUE);

    if (empty($data['question_id']) || empty($data['option_id'])) {
      return new JsonResponse(['error' => 'Campos obrigatórios ausentes.'], JsonResponse::HTTP_BAD_REQUEST);
    }

    $connection = Database::getConnection();

    $exists = $connection->select('simple_voting_vote', 'v')
      ->fields('v', ['id'])
      ->condition('user_id', $current_user->id())
      ->condition('question_id', $data['question_id'])
      ->execute()
      ->fetchField();

    if ($exists) {
      return new JsonResponse([
        'status' => 'error',
        'message' => 'Você já votou nesta pergunta.'
      ], JsonResponse::HTTP_FORBIDDEN);
    }

    $vote = \Drupal::entityTypeManager()
      ->getStorage('simple_voting_vote')
      ->create([
        'user_id' => $current_user->id(),
        'question_id' => $data['question_id'],
        'option_id' => $data['option_id'],
      ]);
    $vote->save();

    return new JsonResponse([
      'status' => 'success',
      'message' => 'Voto registrado com sucesso!',
      'vote_id' => $vote->id(),
      'user' => $current_user->getDisplayName(),
    ], JsonResponse::HTTP_ACCEPTED);
  }

}
