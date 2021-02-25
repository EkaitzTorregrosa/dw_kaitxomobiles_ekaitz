<?php

namespace App\Controller;

use App\Entity\Mobiles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
      $mobiles = $this->getDoctrine()
        ->getRepository(Mobiles::class)
        ->findAllActive();

      return $this->render('default/index.html.twig', array(
        'mobiles' => $mobiles,
      ));
    }
}
