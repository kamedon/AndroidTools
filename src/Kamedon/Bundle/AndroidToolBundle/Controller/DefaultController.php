<?php

namespace Kamedon\Bundle\AndroidToolBundle\Controller;

use Kamedon\Bundle\AndroidToolBundle\Entity\StringResource;
use Kamedon\Bundle\AndroidToolBundle\Form\TranslateStringResourceType;
use Kamedon\Bundle\AndroidToolBundle\Form\DeleteAndroidStringType;
use Kamedon\Bundle\AndroidToolBundle\Form\AndroidStringType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * @Route ("/", name="top")
     * @Template("KamedonAndroidToolBundle:Default:index.html.twig")
     */
    public function indexAction(Request $request)
    {

    }

}

