<?php

namespace App\Controller;

use App\Entity\Mobiles;
use App\Form\MobilesType;
use App\Repository\MobilesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("mobiles")
 */
class MobilesController extends AbstractController {

    /**
     * @Route("/", name="mobiles_index", methods={"GET"})
     */
    public function index(MobilesRepository $mobilesRepository) {
        return $this->render('mobiles/index.html.twig', [
                    'mobiles' => $mobilesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="mobiles_new", methods={"GET","POST"})
     */
    public function new(Request $request) {
        $mobile = new Mobiles();
        $form = $this->createForm(MobilesType::class, $mobile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mobile);
            $entityManager->flush();

            return $this->redirectToRoute('mobiles_index', ['id' => $mobile->getId()]);
        }

        return $this->render('mobiles/new.html.twig', [
                    'mobile' => $mobile,
                    'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mobiles_show", methods={"GET"})
     */
    public function show(Request $request, $id) {
        $mobile = $this->getDoctrine()->getManager()->getRepository(Mobiles::class)->find($id);
        $deleteForm = $this->createDeleteForm($mobile);

        return $this->render('mobiles/show.html.twig', [
                    'mobile' => $mobile,
                    'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mobiles_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Mobiles $mobile) {
        $deleteForm = $this->createDeleteForm($mobile);

        $editForm = $this->createForm(MobilesType::class, $mobile);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mobiles_index', ['id' => $mobile->getId()]);
        }

        return $this->render('mobiles/edit.html.twig', [
                    'mobile' => $mobile,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="mobiles_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Mobiles $mobile) {
        $form = $this->createDeleteForm($mobile);
        $form->handleRequest($request);
        if ($this->isCsrfTokenValid('delete' . $mobile->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mobile);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mobiles_index');
    }

    private function createDeleteForm(Mobiles $mobile) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('mobiles_delete', ['id' => $mobile->getId()]))
                        ->setMethod('DELETE')
                        ->getForm();
    }

}
