<?php

namespace Binaerpiloten\LigaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\LigaBundle\Entity\Spiel;
use Binaerpiloten\LigaBundle\Form\SpielType;

/**
 * Spiel controller.
 *
 * @Route("/spiel")
 */
class SpielController extends Controller
{

    /**
     * Lists all Spiel entities.
     *
     * @Route("/", name="spiel")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BinaerpilotenLigaBundle:Spiel')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    
    /**
     * Lists all your Spiel entities.
     *
     * @Route("/player/{id}", name="spiel_you")
     * @Method("GET")
     * @Template("BinaerpilotenLigaBundle:Spiel:index.html.twig")
     */
    public function youAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    
    	$qspiele = $em->createQuery("SELECT r " .
    			"FROM Binaerpiloten\LigaBundle\Entity\Spiel r " .
    			"WHERE r.you = ".$id .
        	"OR r.enemy = ".$id );
    	
    	$entities = $qspiele->getResult();
    	
    	
    
    	return array(
    			'entities' => $entities,
    	);
    }
    
    /**
     * Creates a new Spiel entity.
     *
     * @Route("/", name="spiel_create")
     * @Method("POST")
     * @Template("BinaerpilotenLigaBundle:Spiel:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Spiel();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
        		$entity->setYou($this->getUser()); //creator is owner
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('spiel_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Spiel entity.
    *
    * @param Spiel $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Spiel $entity)
    {
        $form = $this->createForm(new SpielType(), $entity, array(
            'action' => $this->generateUrl('spiel_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Spiel entity.
     *
     * @Route("/new", name="spiel_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Spiel();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Spiel entity.
     *
     * @Route("/{id}", name="spiel_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenLigaBundle:Spiel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Spiel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Spiel entity.
     *
     * @Route("/{id}/edit", name="spiel_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenLigaBundle:Spiel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Spiel entity.');
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
    * Creates a form to edit a Spiel entity.
    *
    * @param Spiel $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Spiel $entity)
    {
        $form = $this->createForm(new SpielType(), $entity, array(
            'action' => $this->generateUrl('spiel_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Spiel entity.
     *
     * @Route("/{id}", name="spiel_update")
     * @Method("PUT")
     * @Template("BinaerpilotenLigaBundle:Spiel:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenLigaBundle:Spiel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Spiel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('spiel_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Spiel entity.
     *
     * @Route("/{id}", name="spiel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BinaerpilotenLigaBundle:Spiel')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Spiel entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('spiel'));
    }

    /**
     * Creates a form to delete a Spiel entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('spiel_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
