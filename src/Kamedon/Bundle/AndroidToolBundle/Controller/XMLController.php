<?php

namespace Kamedon\Bundle\AndroidToolBundle\Controller;

use Kamedon\Bundle\AndroidToolBundle\Entity\StringResource;
use Kamedon\Bundle\AndroidToolBundle\Entity\UploadFile;
use Kamedon\Bundle\AndroidToolBundle\Form\ChildrenStringResourceType;
use Kamedon\Bundle\AndroidToolBundle\Form\DeleteStringResourceType;
use Kamedon\Bundle\AndroidToolBundle\Form\StringResourceType;
use Kamedon\Bundle\AndroidToolBundle\Form\UploadFileType;
use Kamedon\Bundle\AndroidToolBundle\Utility\Android\LoadStringXmlResource;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * @Route("/xml")
 */
class XMLController extends Controller
{
    /**
     * @Route ("/new", name="register_by_xml")
     * @Template("KamedonAndroidToolBundle:Resource:Xml/index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $file = new UploadFile();
        $form = $this->createForm(new UploadFileType(), $file);
        $form->handleRequest($request);
        if ($form->isValid()) {
            try {
                /** @var File $uploadFile */
                $uploadFile = $form['file']->getData();
                $dir = $this->get('kernel')->getCacheDir();
                $f = $uploadFile->move($dir, $uploadFile->getBasename());
                $repository = $this->get('doctrine')->getRepository('KamedonAndroidToolBundle:StringResource');
                $repository->register(LoadStringXmlResource::loadZip($f->getPathname(), $dir));
                $this->get('session')->getFlashBag()->set('notice','保存完了');
                system("rm -rf {$f->getPathname()}");
            } catch (\Exception $e) {
                $this->get('session')->getFlashBag()->set('error','保存できませんでした');
            }
        }
        return ['form' => $form->createView()];
    }

}

