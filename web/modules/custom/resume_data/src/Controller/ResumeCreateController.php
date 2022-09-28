<?php
    namespace Drupal\resume_data\Controller;
    use Drupal\Core\Controller\ControllerBase;
    use Drupal\node\Entity\Node;

    class ResumeCreateController extends ControllerBase{
        public function createResume($nid){
          $transNode = Node::load($nid);
          $output = '<div class = "seller-details"><h6></h6>';
          $output.= '<p><b>Candidate Name : </b><span>' .$transNode->get('title')->value. '</span></p>';
          $output.= '<p><b>Candidate Email : </b><span>' .$transNode->get('field_email_id')->value. '</span></p>';
          $output.= '<p><b>Candidate Phone No : </b><span>'.$transNode->get('field_phone_no')->value. '</span></p>';
          $output.= '<p><b>Candidate DOB : </b><span>' .$transNode->get('field_dob')->value. '</span></p>';
          $output.= '<p><b>Candidate address : </b><span>' .$transNode->get('field_address')->value. '</span></p>';
          $output.= '<p><b>Candidate Objective : </b><span>' .$transNode->get('field_objective')->value. '</span></p>';
          $output.= '<p><b>Candidate Work Experience : </b><span>'.$transNode->get('field_work_experience')->value. '</span></p>';
          $output.= '<p><b>Candidate SSC Marks : </b><span>'.$transNode->get('field_ssc')->value. '</span></p>';
          $output.= '<p><b>Candidate HSC/Diploma Marks : </b><span>'.$transNode->get('field_hsc_diploma')->value. '</span></p>';
          $output.= '<p><b>Candidate Degree Marks : </b><span>'.$transNode->get('field_degree')->value. '</span></p>';
          $output.= '<p><b>Candidate Skills : </b><span>' .$transNode->get('field_skills')->value. '</span></p>';
          $output.= '<p><b>Language Known : </b><span>' .$transNode->get('field_language_known')->value. '</span></p>';
          //  $output.= '<p><b>Account Manager Name : </b><span>' . $acc_manager_name . '</span></p>';
          //  $output.= '<p><b>Account Manager Email : </b><span>' . $acc_manager_email . '</span></p>';
          $output.= '</div>';
        
            return [
              '#type' => 'markup',
              '#markup' => $output,
            ];
        
    }
}