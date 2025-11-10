<?php

namespace Drupal\simple_voting\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Vote entity.
 */
class VoteForm extends ContentEntityForm {

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);

    $user_id = \Drupal::currentUser()->id();

    $question_id = $form_state->getValue('question_id');
    if (is_array($question_id) && isset($question_id[0]['target_id'])) {
      $question_id = $question_id[0]['target_id'];
    }

    if ($user_id && $question_id) {
      $existing_vote = \Drupal::entityTypeManager()
        ->getStorage('simple_voting_vote')
        ->loadByProperties([
          'user_id' => $user_id,
          'question_id' => $question_id,
        ]);

      if (!empty($existing_vote)) {
        $form_state->setErrorByName(
          'question_id',
          $this->t('Você já votou nesta pergunta.')
        );
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $status = parent::save($form, $form_state);

    if ($status == SAVED_NEW) {
      $this->messenger()->addStatus($this->t('Voto registrado com sucesso.'));
    }
    else {
      $this->messenger()->addStatus($this->t('Voto atualizado.'));
    }

    $question = $entity->get('question_id')->entity;
    $show_results = $question ? $question->get('show_results')->value : FALSE;

    if ($show_results && $question) {
        $options = \Drupal::entityTypeManager()
        ->getStorage('simple_voting_option')
        ->loadByProperties(['question_id' => $question->id()]);

        $votes = \Drupal::entityTypeManager()
        ->getStorage('simple_voting_vote')
        ->loadByProperties(['question_id' => $question->id()]);

        $total_votes = count($votes);

        if ($total_votes > 0 && !empty($options)) {
        // Monta o resultado em uma única string.
        $message = '<strong>' . $this->t('Resultados da votação:') . '</strong><br>';

        foreach ($options as $option) {
            $option_votes = array_filter($votes, function ($vote) use ($option) {
            return $vote->get('option_id')->target_id == $option->id();
            });
            $percent = round((count($option_votes) / $total_votes) * 100, 1);
            $message .= $option->label() . ': ' . count($option_votes) . ' votos (' . $percent . '%)<br>';
        }

        // Adiciona uma única mensagem com HTML.
        $this->messenger()->addStatus($message);
        }
        else {
        $this->messenger()->addStatus($this->t('Ainda não há votos suficientes para exibir resultados.'));
        }
    }


    $form_state->setRedirect('entity.simple_voting_vote.collection');
  }
}
