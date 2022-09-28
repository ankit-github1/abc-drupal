<?php

namespace Drupal\form_example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides the form.
 */
class StudentForm extends FormBase
{
  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'student_form_form';
  }
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form['firstname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First Name'),
      '#required' => TRUE,
      '#maxlength' => 20,
      '#default_value' =>  '',
      '#id' => firstname,
    ];
    $form['lastname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Surname Name'),
      '#required' => TRUE,
      '#maxlength' => 20,
      '#default_value' =>  '',
      '#id' => lastname,
    ];
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#default_value' => '',
      '#required' => TRUE,
      '#id' => email,
    ];
    $form['age'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Age'),
      '#required' => TRUE,
      '#maxlength' => 20,
      '#default_value' => '',
      '#id' => age,
    ];
    $form['marks'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Marks'),
      '#required' => TRUE,
      '#maxlength' => 20,
      '#default_value' => '',
      '#id' => marks,
    ];
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Register'),
      '#button_type' => 'primary',
    );
    $form['actions']['reset'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Reset'),
      '#submit' => array('::resetForm'),
    );
    $query = \Drupal::database()->select('students', 'u');
    $query = $query->fields('u', ['id', 'fname', 'sname', 'age', 'marks']);
    $results = $query->execute()->fetchAll();

   // $rows = [];
    foreach ($results as $key => $value) {
      $rows['id'] = $value->id;
      $rows['firstname'] = $value->fname;
      $rows['surname'] = $value->sname;
      $rows['Age'] = $value->age;
      $rows['Marks'] = $value->marks;
      $rows[$key] = $rows;
    };
    $header = [
      'id' =>$this->t('id'),
      'firstname' => $this->t('fname'),
      'surname' => $this->t('sname'),
      'Age' => $this->t('Age'),
      'Marks' => $this->t('Marks'),
    ];
    //dpm($rows);
    $form['table'] = [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#empty' => $this->t('No users found'),
    ];
    //$form['#validate'][] = 'studentFormValidate';
    return $form;
  }
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    $field = $form_state->getValues();

    if (!$form_state->getValue('firstname') || empty($form_state->getValue('firstname'))) {
      $form_state->setErrorByName('firstname', $this->t('Provide First Name.'));
    }
    if (!is_numeric($form_state->getValue('age'))) {
      $form_state->setErrorByName('age', $this->t('Age must be numeric.'));
    }
    if (!is_numeric($form_state->getValue('marks'))) {
      $form_state->setErrorByName('marks', $this->t('Marks must be numeric.'));
    }
  }
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    try {
      $conn = \Drupal::database();
      $field = $form_state->getValues();
      $fields["fname"] = $field['firstname'];
      $fields["sname"] = $field['lastname'];
      //$fields["email"] = $field['email'];
      $fields["age"] = $field['age'];
      $fields["marks"] = $field['marks'];
      //$fields["created"] = strtotime(date('Y-m-d h:i:s'));
      $conn->insert('students')
        ->fields($fields)->execute();
      \Drupal::messenger()->addMessage($this->t('The Student data has been succesfully saved!'));
    } catch (Exception $ex) {
      \Drupal::logger('form_example')->error($ex->getMessage());
    }
  }
}
