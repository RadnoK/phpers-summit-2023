<?php

declare(strict_types=1);

namespace App\Documents\Signing\Actions;

use App\Entity\Document;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

final class SendEmailAfterSuccessfulSignatureAction
{
    public function __construct(
        private readonly MailerInterface $mailer,
    ) { }

    public function __invoke(Document $document): void
    {
        $this->mailer->send((new Email())
            ->from('system@example.com')
            ->to($document->getClient()->getEmail())
            ->text($document->getComment())
        );
    }
}
