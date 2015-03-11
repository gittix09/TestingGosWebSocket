<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JtestController extends Controller
{
    public function basicAction()
    {
        return $this->render('AcmeDemoBundle:Jtest:basic.html.twig', array(
                // ...
            ));    }

}
