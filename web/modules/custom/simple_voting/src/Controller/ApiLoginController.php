<?php

namespace Drupal\simple_voting\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Controller\ControllerBase;
use Drupal\user\Entity\User;
use Drupal\Core\Password\PasswordInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ApiLoginController extends ControllerBase {

  protected $passwordHasher;

  public function __construct(PasswordInterface $password_hasher) {
    $this->passwordHasher = $password_hasher;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('password')
    );
  }

  public function login(Request $request) {
    $data = json_decode($request->getContent(), TRUE);

    if (empty($data['username']) || empty($data['password'])) {
      return new JsonResponse(['error' => 'Campos obrigatórios ausentes'], 400);
    }

    $users = \Drupal::entityTypeManager()->getStorage('user')->loadByProperties([
      'name' => $data['username'],
    ]);

    if (!$users) {
      return new JsonResponse(['error' => 'Usuário não encontrado'], 404);
    }

    $user = reset($users);

    if (!$this->passwordHasher->check($data['password'], $user->getPassword())) {
      return new JsonResponse(['error' => 'Senha inválida'], 403);
    }

    // Gera ou recupera API key
    if ($user->hasField('field_api_key') && !$user->get('field_api_key')->value) {
      $api_key = bin2hex(random_bytes(16));
      $user->set('field_api_key', $api_key);
      $user->save();
    } else {
      $api_key = $user->get('field_api_key')->value;
    }

    return new JsonResponse([
      'status' => 'success',
      'api_key' => $api_key,
      'user_id' => $user->id(),
      'username' => $user->getAccountName(),
    ]);
  }
}
