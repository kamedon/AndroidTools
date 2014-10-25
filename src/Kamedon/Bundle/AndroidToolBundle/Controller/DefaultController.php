<?php

namespace Kamedon\Bundle\AndroidToolBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route ("/hello/{name}")
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($name)
    {
        return $this->render('KamedonAndroidToolBundle:Default:index.html.twig', array('name' => $name));
    }
}
