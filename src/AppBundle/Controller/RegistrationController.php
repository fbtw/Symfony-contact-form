<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Entity;
use AppBundle\Form\Type\EntityType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="registration")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction()
    {

        $form = $this->createForm(EntityType::class, new Entity);

        return $this->render('registration/register.html.twig', [
            'registrar' => $form->createView(),
        ]);
    }
}