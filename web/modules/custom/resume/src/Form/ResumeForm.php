<?php
/**
 * @file
 * Contains \Drupal\resume\Form\ResumeForm.
 */
namespace Drupal\resume\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;
use Drupal\Core\Routing;

class ResumeForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'resume_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['form_type'] = array (
      '#type' => 'select',
      '#title' => ('Form Type'),
      '#required' => TRUE,
      '#options' => array(
        'Resume Form' => t('Resume Form'),
      ),
    );

    $form['full_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Full Name:'),
      '#required' => TRUE,
      '#maxlength' => 25,


    );


    $form['candidate_gender'] = array (
      '#type' => 'select',
      '#title' => ('Gender'),
      '#options' => array(
        'Select' =>t('Select'),
        'Male' => t('Male'),
        'Female' => t('Female'),
      ),
    );

    $form['email_id'] = array(
      '#type' => 'email',
      '#title' => t('Email ID:'),
      '#required' => TRUE,
    );

    $form['phone_number'] = array(
      '#type' => 'textfield',
      '#title' => t('Phone no'),
      '#required' => TRUE,
      '#maxlength' => 12,
      '#attributes' => array('placeholder' => t('Enter Your Mobile Number'),)
    );

    $form['candidate_address'] = array (
      //'#type' => 'multivalue',
      '#type' => 'textarea',
      '#title' => t('Address'),
      '#attributes' => array('placeholder' => t('Enter your current address!'),)
    );
    $form['candidate_dob'] = array (
      '#type' => 'date',
      '#title' => t('Date of Birth'),

    );
    $form['achievements'] = array(
      '#type' => 'textarea',
      '#title' => t('Achievements'),
      '#required' => TRUE,
      '#maxlength' => 10,
    );
    $form['ssc'] = array(
      '#type' => 'textfield',
      '#title' => t('SSC'),
      '#required' => TRUE,
      '#maxlength' => 3,
    );
    $form['hsc'] = array(
      '#type' => 'textfield',
      '#title' => t('HSC'),
      '#required' => TRUE,
      '#maxlength' => 3,
    );
    $form['ug_pg'] = array(
      '#type' => 'textfield',
      '#title' => t('UG/PG'),
      '#required' => TRUE,
      '#maxlength' => 10,
    );

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit Resume'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
    // public function validateForm(array &$form, FormStateInterface $form_state) {

    //   // if (strlen($form_state->getValue('candidate_number')) < 10) {
    //   //   $form_state->setErrorByName('candidate_number', $this->t('Mobile number is too short.'));
    //   // }

    // }

  /**
   * {@inheritdoc}
   */

public function submitForm(array &$form, FormStateInterface $form_state) {
      //foreach ($form_state->getValues() as $key => $value) {
       //\Drupal::messenger()->addMessage($this->t($key . ': ' . $value));

       $node = Node::create(['type' => create_resume]);
       $node->title= $form_state->getValue('form_type');
       $node->field_full_name= $form_state->getValue('full_name');
       $node->field_email_id= $form_state->getValue('email_id');
       $node->field_ph= $form_state->getValue('phone_number');
       $node->field_address= $form_state->getValue('candidate_address');
       $node->field_date_of_birth= $form_state->getValue('candidate_dob');
       $node->field_achievements= $form_state->getValue('achievements');
       $node->field_gender= $form_state->getValue('candidate_gender');
       $node->field_ssc= $form_state->getValue('ssc');
       $node->field_hsc= $form_state->getValue('hsc');
       $node->field_ug= $form_state->getValue('ug_pg');

$node->save();
$nid=$node->id();
      \Drupal::messenger()->addMessage($this->t('Resume data has been saved!'));
      $url = \Drupal\Core\Url::fromRoute('resume.resumecreate', ['nid' => $node->id()]);
     $form_state->setRedirectUrl($url);
 }

 }
