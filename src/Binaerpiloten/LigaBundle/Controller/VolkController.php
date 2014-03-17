<?php

namespace Binaerpiloten\LigaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\LigaBundle\Entity\Volk;
use Binaerpiloten\LigaBundle\Form\VolkType;

/**
 * Volk controller.
 *
 * @Route("/volk")
 */
class VolkController extends Controller
{

    /**
     * Lists all Volk entities.
     *
     * @Route("/", name="volk")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BinaerpilotenLigaBundle:Volk')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Volk entity.
     *
     * @Route("/", name="volk_create")
     * @Method("POST")
     * @Template("BinaerpilotenLigaBundle:Volk:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Volk();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('volk_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Volk entity.
    *
    * @param Volk $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Volk $entity)
    {
        $form = $this->createForm(new VolkType(), $entity, array(
            'action' => $this->generateUrl('volk_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Volk entity.
     *
     * @Route("/new", name="volk_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Volk();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Volk entity.
     *
     * @Route("/{id}", name="volk_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenLigaBundle:Volk')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Volk entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Volk entity.
     *
     * @Route("/{id}/edit", name="volk_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenLigaBundle:Volk')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Volk entity.');
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
    * Creates a form to edit a Volk entity.
    *
    * @param Volk $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Volk $entity)
    {
        $form = $this->createForm(new VolkType(), $entity, array(
            'action' => $this->generateUrl('volk_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Volk entity.
     *
     * @Route("/{id}", name="volk_update")
     * @Method("PUT")
     * @Template("BinaerpilotenLigaBundle:Volk:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenLigaBundle:Volk')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Volk entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('volk_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Volk entity.
     *
     * @Route("/{id}", name="volk_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BinaerpilotenLigaBundle:Volk')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Volk entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('volk'));
    }

    /**
     * Creates a form to delete a Volk entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('volk_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
