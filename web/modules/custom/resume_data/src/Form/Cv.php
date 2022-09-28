<?php
 
namespace Drupal\resume_data\Form;
 
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Drupal\Core\Url;
use Drupal\Core\Routing;
use \Drupal\node\Entity\Node;
 
/**
 * Provides the form for adding countries.
 */
class Cv extends FormBase {
 
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'cv_form';
  }
 
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // $form_state->setMethod('GET');
    // if (isset($form_state['values']['fname'])) {
    //   $form['fname']['#default_value'] = $form_state['values']['fname'];
    // }
    // elseif (isset($parameters['fname'])) {
    //   $form['fname']['#default_value'] = $parameters['fname'];
    // }
 
    
    $form['fname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First Name'),
      '#required' => TRUE,
      '#maxlength' => 20,
      '#default_value' =>  '',
      // '#id' => fname,
    ];
	 $form['sname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last Name'),
      '#required' => TRUE,
      '#maxlength' => 20,
      '#default_value' =>  '',
      // '#id' => sname,
    ];
    $form['dob'] = [
      '#type' => 'date',
      '#title' => $this->t('DOB'),
      '#required' => TRUE,
      '#maxlength' => 20,
      '#default_value' =>  '',
      // '#id' => dob,
    ];
	$form['emailid'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email Id'),
      '#required' => TRUE,
      '#maxlength' => 50,
      '#default_value' => '',
      // '#id' => emailid,
    ];
	 $form['phone'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Phone No'),
      '#required' => TRUE,
      '#maxlength' => 10,
      '#default_value' => '',
      // '#id' => phone,
    ];
    $form['address'] = [
        '#type' => 'textarea',
        '#title' => $this->t('Address'),
        '#required' => TRUE,
        '#maxlength' => 200,
        '#default_value' => '',
        // '#id' => address,
      ];
      $form['objective'] = [
        '#type' => 'textarea',
        '#title' => $this->t('Objective'),
        '#required' => FALSE,
        '#maxlength' => 500,
        '#default_value' => '',
        // '#id' => objective,
      ];
      $form['workexperience'] = [
        '#type' => 'textarea',
        '#title' => $this->t('Work Experience'),
        '#required' => FALSE,
        '#maxlength' => 500,
        '#default_value' => '',
        // '#id' => workexperience,
      ];
      $form['ssc'] = [
        '#type' => 'textfield',
        '#title' => $this->t('SSC'),
        '#required' => TRUE,
        '#maxlength' => 3,
        '#default_value' => '',
        // '#id' => ssc,
      ];
      $form['hsc/diploma'] = [
        '#type' => 'textfield',
        '#title' => $this->t('HSC OR DIPLOMA'),
        '#required' => TRUE,
        '#maxlength' => 3,
        '#default_value' => '',
        '#id' => hsc_diploma,
      ];
      $form['degree'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Degree'),
        '#required' => TRUE,
        '#maxlength' => 3,
        '#default_value' => '',
        // '#id' => degree,
      ];
      $form['skills'] = [
        '#type' => 'textarea',
        '#title' => $this->t('Skills'),
        '#required' => FALSE,
        '#maxlength' => 300,
        '#default_value' => '',
        // '#id' => skills,
      ];
      $form['languageknown'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Language Known'),
        '#required' => FALSE,
        '#maxlength' => 50,
        '#default_value' => '',
      ];
	
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#button_type' => 'primary',
      '#default_value' => $this->t('Save') ,
    ];
    $form['actions']['reset'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Reset'),
      '#submit' => array('::resetForm'),
    );
	//$form['#validate'][] = 'studentFormValidate';
 
    return $form;
 
  }
  
   /**
   * {@inheritdoc}
   */
  public function validateForm(array & $form, FormStateInterface $form_state) {
       $field = $form_state->getValues();
	   
		$fields["fname"] = $field['fname'];
		if (!$form_state->getValue('fname') || empty($form_state->getValue('fname'))) {
            $form_state->setErrorByName('fname', $this->t('Provide First Name'));
        }
        $fields["sname"] = $field['sname'];
		if (!$form_state->getValue('sname') || empty($form_state->getValue('sname'))) {
            $form_state->setErrorByName('sname', $this->t('Provide Last Name'));
        }
		
		
  }
 
  /**
   * {@inheritdoc}
   */
  public function submitForm(array & $form, FormStateInterface $form_state) {
	// try{
		// $conn = Database::getConnection();
    // $dataa = [
    //   'field_address' => $form_state->getValue('sname'), 
    // ];
    // $node = \Drupal::entityTypeManager()
    //   ->getStorage('resume_form')
    //   ->create($dataa);
    // $node->save();
// 		$node = Node::create(['type' => $resumeform]);
//     $node->firstname = "fr";
//     $node->field_skills = $field['skills'];
//     $node->	field_dob = $field['DOB'];
//     $node->field_email_id = $field['email Id'];
//     $node->	field_phone_no = $field['phone no'];
//     $node->field_address = $field['address'];
//     $node->	field_objective = $field['objectives'];
//     $node->field_work_experience = $field['work_experience'];
//     $node->field_ssc = $field['ssc'];
//     $node->field_hsc_diploma = $field['hsc_diploma'];
//     $node->field_degree = $field['Degree'];
//     $node->field_skills = $field['skills'];
// $node->save();

// $nid = $node->id();
		$field = $form_state->getValues();
    $node = Node::create(['type' => 'resume_form']);
    $node->title = $field['fname'];
    $node->field_last_name = $field['sname'];
    $node->field_dob = $field['dob'];
    $node->field_email_id = $field['emailid'];
    $node->field_phone_no = $field['phone'];
    $node->field_address = $field['address'];
    $node->field_objective = $field['objective'];
    $node->field_work_experience = $field['workexperience'];
    $node->field_ssc = $field['ssc'];
    $node->field_hsc_diploma = $field['hsc/diploma'];
    $node->field_degree = $field['degree'];
    $node->field_skills = $field['skills'];
    $node->field_language_known = $field['languageknown'];
    $node->uid=\Drupal::currentUser()->id();
    
$node->save();
// $transNode = Node::load($nid);
// $transNode = $transNode->addTranslation("en");
// $transNode->title = $title_EN;
// $transNode->body= $body_EN;
// $transNode->field_1 = $field_1_EN;
// $transNode->save();

$nid=$node->id();
      \Drupal::messenger()->addMessage($this->t('Resume successfully Created'));
      $url = \Drupal\Core\Url::fromRoute('resume_data.resumecreate', ['nid' => $node->id()]);
     $form_state->setRedirectUrl($url);
	   
		// $fields["fname"] = $field['fname'];
		// $fields["sname"] = $field['sname'];
		// $fields["phoneno"] = $field['phoneno'];
		// $fields["emailid"] = $field['emailid'];
		
	// 	  $conn->insert('students')
	// 		   ->fields($fields)->execute();
	// 	  \Drupal::messenger()->addMessage($this->t('The Resume data has been succesfully saved'));
		 
	// } catch(Exception $ex){
	// 	\Drupal::logger('dn_students')->error($ex->getMessage());
	// }
    
 }

 }