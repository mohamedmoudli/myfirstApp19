<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\AdminRecipient;
use Symfony\Component\Notifier\Recipient\Recipient;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class InvoiceController extends AbstractController
{
    /**
     * @Route("/invoice/create")
     */
    public function create(NotifierInterface $notifier)
    {
        $user = $this->getUser();


        // ...
        // Create a Notification that has to be sent
        // using the "email" channel
        $notification = (new Notification('New Invoice', ['email']))
            ->content('You got a new invoice for 15 EUR.');

        $entityManager = $this->getDoctrine()->getManager();

        $recipient = new AdminRecipient(
        // The receiver of the Notification
            $user->getEmail(),
            $user->getPhonenumber()
        );
        // Send the notification to the recipient
        $notifier->send($notification, $recipient);
        // ...
    }

/**
 * @Route("/invoice/createg")
 */
public function invoice(NotifierInterface $notifier)
{
    // ...
    $notification = (new Notification('New Invoice'))
        ->content('You got a new invoice for 15 EUR.')
        ->importance(Notification::IMPORTANCE_HIGH);

    $notifier->send($notification, new Recipient('mohamedmouldi95@gmail.com'));

}
}