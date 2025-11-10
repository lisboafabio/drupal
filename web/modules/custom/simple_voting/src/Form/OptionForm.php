<?php

namespace Drupal\simple_voting\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Option entity.
 */
class OptionForm extends ContentEntityForm {

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addMessage($this->t('Nova opção criada: %label', ['%label' => $entity->label()]));
        break;

      default:
        $this->messenger()->addMessage($this->t('Opção atualizada: %label', ['%label' => $entity->label()]));
    }

    $form_state->setRedirect('entity.simple_voting_option.collection');
  }
}
