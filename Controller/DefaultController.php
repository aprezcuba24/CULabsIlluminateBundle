<?php

namespace CULabs\IlluminateBundle\Controller;

use AppBundle\Jobs\SendReminderEmail;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name = 'Renier')
    {
        return $this->render('CULabsIlluminateBundle:Default:index.html.twig', array('name' => $name));
    }
}
