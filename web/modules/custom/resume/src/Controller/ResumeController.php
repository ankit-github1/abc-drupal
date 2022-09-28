<?php

    namespace Drupal\resume\Controller;
    use Drupal\Core\Controller\ControllerBase;
    use Drupal\node\Entity\Node;

    class ResumeController extends ControllerBase{
        public function createResume($nid){
          $transNode = Node::load($nid);
        //   $output = '<div class = "student-details"><h6></h6>';
        //   $output.= '<p><b> Form Type : </b><span>' .$transNode->get('title')->value. '</span></p>';
        //   $output.= '<p><b> Full Name : </b><span>' .$transNode->get('field_full_name')->value. '</span></p>';
        //   $output.= '<p><b> Email Id : </b><span>'.$transNode->get('field_email_id')->value. '</span></p>';
        //   //$output.= '<p><b> Phone No : </b><span>' .$transNode->get('field_ph')->value. '</span></p>';
        //   //$output.= '<p><b> Address : </b><span>' .$transNode->get('field_address')->value. '</span></p>';
        //   $output.= '<p><b> Date of Birth : </b><span>' .$transNode->get('field_date_of_birth')->value. '</span></p>';
        //   $output.= '<p><b> Achievements : </b><span>'.$transNode->get('field_achievements')->value. '</span></p>';
        //   $output.= '<p><b> Gender : </b><span>'.$transNode->get('field_gender')->value. '</span></p>';
        //   $output.= '<p><b> SSC : </b><span>'.$transNode->get('field_ssc')->value. '</span></p>';
        //   $output.= '<p><b> HSC : </b><span>'.$transNode->get('field_hsc')->value. '</span></p>';
        //   $output.= '<p><b> UG/PG : </b><span>' .$transNode->get('field_ug')->value. '</span></p>';
        //   $output.= '</div>';


//         $output.= '</div>';

//         return [
//           '#type' => 'markup',
//           '#markup' => $output,
//         ];

// }
// }


          $resume_data = array(
            '#theme' => 'resumearray',
            '#xyz'=> $transNode,
          );
          return $resume_data;

    }
}