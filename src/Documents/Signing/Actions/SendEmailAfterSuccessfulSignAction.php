<?php

declare(strict_types=1);

namespace App\Documents\Signing\Actions;

use App\Documents\Signing\Payload\SignaturePayload;
use App\Entity\Document;
use App\Mailer\ClientEmail\Content;
use App\Mailer\ClientEmail\MailerService;

final class SendEmailAfterSuccessfulSignAction implements ActionInterface {
    public function __construct(
        private readonly MailerService $mailerService,
    ) { }

    public function __invoke(Document $document): void {
        $this->mailerService->send(
            $document->getClient()->getEmail(),
            new Content(
                subject: 'Document signed',
                hero: 'Your document has been signed',
                content: 'Your document has been signed by all parties.',
                callToAction: 'Download the document',
            )
        );
    }

    public function isEligible(Document $document, SignaturePayload $signature): bool {
        return $document->getSignedAt() !== null;
    }
}
