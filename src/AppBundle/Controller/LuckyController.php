<?php
// src/AppBundle/Controller/LuckyController.php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends Controller
{
    /**
     * @Route("/lucky/number")
     */
    public function numberAction()
    {
        $number = rand(0, 100);
		
		 // $message = \Swift_Message::newInstance()
        // ->setSubject('Hello Email')
        // ->setFrom('byutrg@gmail.com')
        // ->setTo('james.s.hayes@gmail.com')
        // ->setBody(
            // 'hello','text/html'
				// )
			// ;
			// $this->get('mailer')->send($message);
		
        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
}
