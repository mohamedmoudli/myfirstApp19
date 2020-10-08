<?php


namespace App\Notifier;

use Symfony\Component\Notifier\Message\ChatMessage;
use Symfony\Component\Notifier\Notification\ChatNotificationInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\Recipient\Recipient;

class InvoiceNotification extends Notification implements ChatNotificationInterface
{
    private $price;

    public function __construct(int $price)
    {
        $this->price = $price;
    }

    public function asChatMessage(Recipient $recipient, string $transport = null): ?ChatMessage
    {
        // Add a custom emoji if the message is sent to Slack
        if ('slack' === $transport) {
            return (new ChatMessage('You\'re invoiced '.$this->price.' EUR.'))
                ->emoji('money');
        }

        // If you return null, the Notifier will create the ChatMessage
        // based on this notification as it would without this method.
        return null;
    }
}