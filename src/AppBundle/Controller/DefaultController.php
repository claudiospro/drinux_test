<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Directory as Entidad;
use AppBundle\Form\DirectoryType as Formulario;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $lista = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:Directory')
                ->findAll();
        
        return $this->render('default/index.html.twig',[
            'lista' => $lista,
        ]);
    }

	/**
     * @Route("/directorio/add", name="admin_directorio_add")
     */
    public function addAction(Request $request)
	{
        $row = new Entidad();
        $form = $this->createForm(Formulario::class, $row);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted())
        {
            if ($form->isValid())
            {
                $this
                    ->getDoctrine()
                    ->getManager()
                    ->getRepository('AppBundle:Directory')
                    ->add($form, $row);
            }
            return $this->redirectToRoute('homepage');
        }
        
        return $this->render('default/add.html.twig', [
            'form' => $form->createView(),
        ]);
	}

	/**
     * @Route("/directorio/edit/{id}", name="admin_directorio_edit")
     */
    public function editAction(Request $request, $id)
	{
        $repo = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:Directory');

        $row = $repo->find($id);
		
        $form = $this->createForm(Formulario::class, $row);
        $form->handleRequest($request);
        
        if ($form->isSubmitted())
        {
            if ($form->isValid())
            {      
                $repo->edit($form, $row);
            }
            return $this->redirectToRoute('homepage');
        }
        
        return $this->render('default/add.html.twig', [
            'form' => $form->createView(),
        ]);
		
	}
	/**
     * @Route("/directorio/delete/{id}", name="admin_directorio_delete")
     */
    public function deleteAction(Request $request, $id)
	{
        $repo = $this
				->getDoctrine()
				->getManager()
				->getRepository('AppBundle:Directory');
		
		$row = $repo->find($id);
		$repo->delete($row);
        

		return $this->redirectToRoute('homepage');		
	}	
}
