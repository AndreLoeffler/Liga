<?php

namespace Binaerpiloten\LigaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\LigaBundle\Entity\Armee;
use Binaerpiloten\LigaBundle\Form\ArmeeType;

/**
 * Armee controller.
 *
 * @Route("/armee")
 */
class ArmeeController extends Controller
{

    /**
     * Lists all Armee entities.
     *
     * @Route("/", name="armee")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
				$user = $this->get('security.context')->getToken()->getUser();
				

        if ($user->hasRole('ROLE_ADMIN')) {
        	$entities = $em->getRepository('BinaerpilotenLigaBundle:Armee')->findAll();
        } else {
        	$qarmeen = $em->createQuery("SELECT r " .
        			"FROM Binaerpiloten\LigaBundle\Entity\Armee r " .
        			"WHERE r.user = ".$this->getUser()->getId() );
        	
        	$entities = $qarmeen->getResult();
        }
        
        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Armee entity.
     *
     * @Route("/", name="armee_create")
     * @Method("POST")
     * @Template("BinaerpilotenLigaBundle:Armee:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Armee();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
        		$entity->setUser($this->getUser()); //set creator as owner
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('armee_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Armee entity.
    *
    * @param Armee $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Armee $entity)
    {
        $form = $this->createForm(new ArmeeType(), $entity, array(
            'action' => $this->generateUrl('armee_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Armee entity.
     *
     * @Route("/new", name="armee_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Armee();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Armee entity.
     *
     * @Route("/{id}", name="armee_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenLigaBundle:Armee')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Armee entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Armee entity.
     *
     * @Route("/{id}/edit", name="armee_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenLigaBundle:Armee')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Armee entity.');
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
    * Creates a form to edit a Armee entity.
    *
    * @param Armee $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Armee $entity)
    {
        $form = $this->createForm(new ArmeeType(), $entity, array(
            'action' => $this->generateUrl('armee_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Armee entity.
     *
     * @Route("/{id}", name="armee_update")
     * @Method("PUT")
     * @Template("BinaerpilotenLigaBundle:Armee:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenLigaBundle:Armee')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Armee entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('armee_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Armee entity.
     *
     * @Route("/{id}", name="armee_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BinaerpilotenLigaBundle:Armee')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Armee entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('armee'));
    }

    /**
     * Creates a form to delete a Armee entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('armee_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
