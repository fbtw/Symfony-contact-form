<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ContactFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SupController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        /*
         * @var $member Member

        $supportRequest = (new SupportRequest())
            ->setEmail($member->getEmail())
            ->setMember($member);
        */
        $form = $this->createForm(ContactFormType::class,null,[
        'action' => $this->generateUrl('handle_form_submission')]
        );
        return $this->render('default/index.html.twig', [
            'our_form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @Route("/form-submission", name="handle_form_submission")
     * @Method("POST")
     */
    public function handleFormSubmissionAction(Request $request)
    {
        $form = $this->createForm(ContactFormType::class,null,[]);
        $form->handleRequest($request);


        if (! $form->isSubmitted() || ! $form->isValid()) {
            return $this->redirectToRoute('homepage');
        }

        /*
         * @var $supportRequest SupportRequest
         */
        $supportRequest = $form->getData();

        dump($supportRequest);

        $message = \Swift_Message::newInstance()
            ->setSubject('Contact Form Submission')
            ->setFrom($supportRequest['de'])
            ->setTo('zxcasd@zxcasd.com')
            ->setBody(
                $supportRequest['mensaje'],
                'text/plain'
            );
        $this->get('mailer')->send($message);
        $this->addFlash('success', 'Tu mensaje se mando!');
        return $this->redirectToRoute('homepage');

    }
}
