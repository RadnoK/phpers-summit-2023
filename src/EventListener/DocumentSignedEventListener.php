<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Event\DocumentSignedEvent;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

final readonly class DocumentSignedEventListener
{
    public function __construct(
        private MailerInterface $mailer,
    ) { }

    public function __invoke(DocumentSignedEvent $event): void
    {
        $this->mailer->send((new Email())
            ->from('system@example.com')
            ->to($event->clientEmail)
            ->text($event->comment)
        );
    }
}
