<?php

namespace Binaerpiloten\LigaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\LigaBundle\Entity\Spiel;
use Binaerpiloten\LigaBundle\Entity\User as User;
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
     * @Route("/player/{name}", name="spiel_you")
     * @Method("GET")
     * @Template("BinaerpilotenLigaBundle:Spiel:index.html.twig")
     */
    public function youAction($name)
    {
    	$em = $this->getDoctrine()->getManager();
    	
    	$qid = $em->createQuery("SELECT r.id " .
    			"FROM Binaerpiloten\LigaBundle\Entity\User r " .
    			"WHERE r.username = '".$name."'" );
    	 
    	$id = $qid->getResult();
    	$qspiele = $em->createQuery("SELECT r " .
    			"FROM Binaerpiloten\LigaBundle\Entity\Spiel r " .
    			"WHERE r.you = ".$id[0]['id'] .
        	"OR r.enemy = ".$id[0]['id'] );
    	
    	$entities = $qspiele->getResult();
    	
    	
    
    	return array(
    			'entities' => $entities,
    	);
    }
    
    /**
     * Creates a new Spiel entity.
     *
     * @Route("/{name}", name="spiel_create")
     * @Method("POST")
     * @Template("BinaerpilotenLigaBundle:Spiel:new.html.twig")
     */
    public function createAction(Request $request,$name)
    {
        $entity = new Spiel();
        
        $em = $this->getDoctrine()->getManager();
        $quser = $em->createQuery("SELECT r " .
        		"FROM Binaerpiloten\LigaBundle\Entity\User r " .
        		"WHERE r.username = '".$name."'");
         
        $enemy = $quser->getResult()[0];
        $you = $this->getUser();
        
        if ($enemy == $you) {
        	throw $this->createNotFoundException('Cannot challenge yourself.');
        }
        
        $entity->setEnemy($enemy); //enemy from route
        $entity->setYou($you); //creator is owner
        
        $form = $this->createCreateForm($entity,$you,$enemy);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
        		// calculate score-change
        		if ($entity->getYoupunkte() > $entity->getEnemypunkte()) {
        			$entity->getYouarmee()->won();
        			$entity->getEnemyarmee()->lost();
        		} else if ($entity->getYoupunkte() < $entity->getEnemypunkte()) {
        			$entity->getEnemyarmee()->won();
        			$entity->getYouarmee()->lost();
        		} else {
        			$entity->getEnemyarmee()->tied();
        			$entity->getYouarmee()->tied();
        		}
        		$entity->setYouvolk($entity->getYouarmee()->getVolk());
        		$entity->setEnemyvolk($entity->getEnemyarmee()->getVolk());
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
    private function createCreateForm(Spiel $entity, User $you, User $enemy)
    {
        $form = $this->createForm(new SpielType($this->getDoctrine()->getManager(), $you, $enemy), $entity, array(
            'action' => $this->generateUrl('spiel_create', array('name' => $enemy->getUsername())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Spiel entity.
     *
     * @Route("/new/{name}", name="spiel_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($name)
    {
        $entity = new Spiel();
        
        $em = $this->getDoctrine()->getManager();
        $quser = $em->createQuery("SELECT r " .
        		"FROM Binaerpiloten\LigaBundle\Entity\User r " .
        		"WHERE r.username = '".$name."'");
         
        $enemy = $quser->getResult()[0];
        $you = $this->getUser();
        
        $entity->setEnemy($enemy); //enemy from route
        $entity->setYou($you); //creator is owner

        if ($enemy == $you) {
        	throw $this->createNotFoundException('Cannot challenge yourself.');
        }
        
        $form   = $this->createCreateForm($entity,$you,$enemy);

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
