<?php
namespace Drupal\welcome_module\Controller;

class WelcomemoduleController
{
    public function welcome()
    {
        $element = array('#markup'=>'Ankit Mishra First Page',);

        date_default_timezone_set('Asia/Kolkata');
         $date = date('d-m-y h:i:s');
         echo $date;
        return $element;
    }
}
