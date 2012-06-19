<?php

namespace Rithis\LaunchpadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Rithis\LaunchpadBundle\Form\Type\AccountType;
use Rithis\LaunchpadBundle\Entity\Account;

class AccountsController extends Controller
{
    public function newAccountsAction()
    {
        $form = $this->createForm(new AccountType());

        return $this->render('RithisLaunchpadBundle:Accounts:newAccounts.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function postAccountsAction()
    {
        $form = $this->createForm(new AccountType());
        $form->bindRequest($this->getRequest());

        if ($form->isValid()) {
            $account = $form->getData();

            $encoder = $this->get('security.encoder_factory')->getEncoder($account);
            $account->encodePassword($encoder);

            $em = $this->getDoctrine()->getManager();
            $em->persist($account);
            $em->flush();

            return $this->redirect($this->generateUrl('rithis_launchpad_get_account', array(
                'username' => $account->getUsername(),
            )));
        }

        return $this->render('RithisLaunchpadBundle:Accounts:newAccounts.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function getAccountAction($username)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('RithisLaunchpadBundle:Account');
        $account = $repository->findOneByUsername($username);

        if (!$account) {
            throw $this->createNotFoundException(sprintf('Account "%s" not found', $username));
        }

        return $this->render('RithisLaunchpadBundle:Accounts:getAccount.html.twig', array(
            'account' => $account,
        ));
    }
}
