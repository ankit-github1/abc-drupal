<?php

namespace Drupal\form_example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\form_example\Form\Normalizer;

/**
 * AjaxForm.
 */
class AjaxForm extends FormBase
{
  /**
   * The term Storage.
   *
   * @var \Drupal\taxonomy\TermStorageInterface
   */
  protected $termStorage;

  /**
   * {@inheritdoc}
   */
  public function __construct(EntityTypeManagerInterface $entity)
  {
    $this->termStorage = $entity->getStorage('taxonomy_term');
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container)
  {
    // Instantiates this form class.
    return new static(
      // Load the service required to construct this class.
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'ajax_form_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $params = NULL)
  {
    $countries = $this->termStorage->loadTree('Country', 0, 1, TRUE);
    $options = [];
    if ($countries) {
      foreach ($countries as $country) {
        $options[$country->id()] = $country->getName();
      }
    }
    $form['Country'] = array(
      '#type'    => 'select',
      '#title'   => $this->t('Country'),
      '#options' => $options,
      '#ajax'    => array(
        'callback' => [$this, 'selectCitiesAjax'],
        'wrapper'  => 'city_wrapper',
      ),
    );

    $form['city'] = array(
      '#type'      => 'select',
      '#title'     => $this->t('City'),
      '#options'   => ['_none' => $this->t('- Select a country before -')],
      '#prefix'    => '<div id="city_wrapper">',
      '#suffix'    => '</div>',
      '#validated' => TRUE,
    );

    $form['actions']['submit'] = [
      '#type'  => 'submit',
      '#value' => $this->t('Send'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
  }

  /**
   * Called via Ajax to populate the Model field according country.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   The form model field structure.
   */
  public function selectCitiesAjax(array &$form, FormStateInterface $form_state)
  {
    $options = [];

    $vocabulary = 'title';
    switch ($form_state->getValue('Country')) {
      case 'China':
        $vocabulary = 'China';
        break;
      case 'India':
        $vocabulary = 'India';
        break;
      case 'USA':
        $vocabulary = 'USA';
        break;
    }

    $cities = $this->termStorage->loadTree('Country', $form_state->getValue('Country'), 1, TRUE);
    //$cities = $this->termStorage->loadTree('Country', 7 ,1, TRUE);
    if ($cities) {
      foreach ($cities as $city) {
        $options[$city->id()] = $city->getName();
      }
    }
    $form['city']['#options'] = $options;

    return $form['city'];
  }
}
