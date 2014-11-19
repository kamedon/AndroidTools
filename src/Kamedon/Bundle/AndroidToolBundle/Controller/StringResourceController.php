<?php

namespace Kamedon\Bundle\AndroidToolBundle\Controller;

use Kamedon\Bundle\AndroidToolBundle\Entity\StringResource;
use Kamedon\Bundle\AndroidToolBundle\Form\ChildrenStringResourceType;
use Kamedon\Bundle\AndroidToolBundle\Form\DeleteStringResourceType;
use Kamedon\Bundle\AndroidToolBundle\Form\StringResourceType;
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
        $stringResource = new StringResource();
        $form = $this->createForm(new StringResourceType(), $stringResource);
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
        $repository = $this->getDoctrine()->getRepository('KamedonAndroidToolBundle:StringResource');
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
        $repository = $manger->getRepository("KamedonAndroidToolBundle:StringResource");
        $parentStringResource = $repository->find($id);
        if ($parentStringResource) {
            $stringResource = new StringResource();
            $stringResource->setParent($parentStringResource);
            $newForm = $this->createForm(new ChildrenStringResourceType(), $stringResource);
            $newForm->handleRequest($request);
            if ($newForm->isValid()) {
                $repository = $this->getDoctrine()->getRepository('KamedonAndroidToolBundle:StringResource');
                if (!$repository->isRegisteredLang($stringResource)) {
                    $em = $this->get('doctrine')->getManager();
                    $em->persist($stringResource);
                    $em->flush();
                    $this->get('session')->getFlashBag()->set('notice', '登録完了しました');
                } else {
                    $this->get('session')->getFlashBag()->set('error', 'すでに登録されています');
                }
            }

            $deleteForm = $this->createForm(new DeleteStringResourceType(), $parentStringResource);
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
