<?php

namespace Kamedon\Bundle\AndroidToolBundle\Controller;

use Kamedon\Bundle\AndroidToolBundle\Entity\AndroidString;
use Kamedon\Bundle\AndroidToolBundle\Entity\AndroidStringRepository;
use Kamedon\Bundle\AndroidToolBundle\Form\TranslateStringResourceType;
use Kamedon\Bundle\AndroidToolBundle\Form\DeleteAndroidStringType;
use Kamedon\Bundle\AndroidToolBundle\Form\AndroidStringType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/resource/string")
 */
class StringResourceController extends Controller
{
    /**
     * @Route ("/", name="new_string_resource")
     * @Template("KamedonAndroidToolBundle:Resource:String/index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $stringResource = new AndroidString();
        $form = $this->createForm(new AndroidStringType(), $stringResource);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->get('doctrine')->getManager();
            $em->persist($stringResource);
            $em->flush();
            $this->get('session')->getFlashBag()->set('notice', '更新しました。');
            return $this->redirect($this->generateUrl('new_children_string_resource', array('id' => $stringResource->getId())));
        }
        return ['form' => $form->createView()];
    }

    /**
     * @Route ("/list", name="list_string_resource")
     * @Template("KamedonAndroidToolBundle:Resource:String/list.html.twig")
     */
    public function listAction(Request $request)
    {
        /** @var AndroidStringRepository $repository */
        $repository = $this->getDoctrine()->getRepository('KamedonAndroidToolBundle:AndroidString');
        $parents = $repository->getParents();
        return ['strings' => $parents];
    }

    /**
     * @Route ("/{id}/new", name="new_children_string_resource")
     * @Template("KamedonAndroidToolBundle:Resource:String/new.html.twig")
     */
    public function newAction(Request $request, $id)
    {
        $manger = $this->getDoctrine()->getManager();
        $repository = $manger->getRepository("KamedonAndroidToolBundle:AndroidString");
        $parentStringResource = $repository->find($id);
        if ($parentStringResource) {
            $stringResource = new AndroidString();
            $stringResource->setParent($parentStringResource);
            $newForm = $this->createForm(new TranslateStringResourceType(), $stringResource);
            $newForm->handleRequest($request);
            if ($newForm->isValid()) {
                if (!$repository->isRegisteredLang($stringResource)) {
                    $em = $this->get('doctrine')->getManager();
                    $em->persist($stringResource);
                    $em->flush();
                    $this->get('session')->getFlashBag()->set('notice', '登録完了しました');
                } else {
                    $this->get('session')->getFlashBag()->set('error', 'すでに登録されています');
                }
            }

            $deleteForm = $this->createForm(new DeleteAndroidStringType(), $parentStringResource);
            $deleteForm->handleRequest($request);
            if ($deleteForm->isValid()) {
                $em = $this->get('doctrine')->getManager();
                $em->remove($parentStringResource);
                $em->flush();
                $this->get('session')->getFlashBag()->set('notice', '削除しました');
                return $this->redirect($this->generateUrl('new_string_resource'));
            }
        } else {
            return $this->redirect($this->generateUrl('new_string_resource'));
        }
        return ['newForm' => $newForm->createView(), 'deleteForm' => $deleteForm->createView(), 'parentStringResource' => $parentStringResource];
    }
}
