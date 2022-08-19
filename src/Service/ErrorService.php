<?php

namespace App\Service;

use App\Error\ErrorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class ErrorService
{
    public function __construct(private readonly TranslatorInterface $translator)
    {
    }

    public function buildErrorMessage(ErrorInterface $error): string
    {
        return 'ERROR ' . $error->getCode() . ' - ' . $this->translator->trans($error->getMessage());
    }

    /**
     * @param ErrorInterface[] $errors
     * @return array
     */
    public function buildErrorMessages(array $errors): array
    {
        $built = [];
        foreach ($errors as $error) {
            if (!$error instanceof ErrorInterface) {
                continue;
            }

            $built[] = [
                'message' => $this->buildErrorMessage($error),
                'description' => $this->translator->trans($error->getDescription()),
            ];
        }

        return $built;
    }
}