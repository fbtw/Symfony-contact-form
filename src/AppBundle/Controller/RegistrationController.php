<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Entity;
use AppBundle\Form\Type\EntityType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="registration")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \LogicException
     * @throws \InvalidArgumentException
     */
    public function registerAction(Request $request)
    {
        $enty = new Entity();
        $form = $this->createForm(EntityType::class, $enty );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this
                ->get('security.password_encoder')
                ->encodePassword(
                    $enty,
                    $enty->getPlainPassword()
                )
            ;

            $enty->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($enty);
            $em->flush();
            $this->addFlash('success', 'Usuario registrado');
            return $this->redirectToRoute('homepage');
        }

        return $this->render('registration/register.html.twig', [
            'registrar' => $form->createView(),
        ]);
    }
}