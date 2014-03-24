<?php

namespace Binaerpiloten\LigaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\LigaBundle\Entity\Mission;
use Binaerpiloten\LigaBundle\Form\MissionType;

/**
 * Mission controller.
 *
 * @Route("/mission")
 */
class MissionController extends Controller
{

    /**
     * Lists all Mission entities.
     *
     * @Route("/", name="mission")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BinaerpilotenLigaBundle:Mission')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Mission entity.
     *
     * @Route("/", name="mission_create")
     * @Method("POST")
     * @Template("BinaerpilotenLigaBundle:Mission:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Mission();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('mission_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Mission entity.
    *
    * @param Mission $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Mission $entity)
    {
        $form = $this->createForm(new MissionType(), $entity, array(
            'action' => $this->generateUrl('mission_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Mission entity.
     *
     * @Route("/new", name="mission_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Mission();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Mission entity.
     *
     * @Route("/{id}", name="mission_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenLigaBundle:Mission')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mission entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Mission entity.
     *
     * @Route("/{id}/edit", name="mission_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenLigaBundle:Mission')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mission entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Mission entity.
    *
    * @param Mission $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Mission $entity)
    {
        $form = $this->createForm(new MissionType(), $entity, array(
            'action' => $this->generateUrl('mission_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Mission entity.
     *
     * @Route("/{id}", name="mission_update")
     * @Method("PUT")
     * @Template("BinaerpilotenLigaBundle:Mission:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenLigaBundle:Mission')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mission entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('mission_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Mission entity.
     *
     * @Route("/{id}", name="mission_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BinaerpilotenLigaBundle:Mission')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Mission entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('mission'));
    }

    /**
     * Creates a form to delete a Mission entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('mission_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
