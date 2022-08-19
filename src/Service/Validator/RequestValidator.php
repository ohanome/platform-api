<?php

namespace App\Service\Validator;

use App\Blocklist;
use App\Entity\User;
use App\Error\AccountNotActivatedError;
use App\Error\AccountNotVerifiedError;
use App\Error\EmailAlreadyExistsError;
use App\Error\EmailMissingError;
use App\Error\ErrorInterface;
use App\Error\MethodMustBePostError;
use App\Error\PasswordMissingError;
use App\Error\UsernameAlreadyExistsError;
use App\Error\UsernameBlockedError;
use App\Error\UsernameInvalidError;
use App\Error\UsernameMissingError;
use App\Ohano;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class RequestValidator
{
    public function __construct()
    {
    }

    public function validateUserCreateRequest(Request $request, ManagerRegistry $doctrine): array
    {
        $data = $request->toArray();
        $errors = [];

        if ($request->getMethod() !== 'POST') {
            $errors[] = new MethodMustBePostError();
        }

        if (!isset($data['email'])) {
            $errors[] = new EmailMissingError();
        }
        if (!isset($data['password'])) {
            $errors[] = new PasswordMissingError();
        }
        if (!isset($data['username'])) {
            $errors[] = new UsernameMissingError();
        }

        $existingUserByEmail = $doctrine->getRepository(User::class)->findOneBy(['email' => $data['email']]);
        if ($existingUserByEmail) {
            $errors[] = new EmailAlreadyExistsError();
        }

        if (in_array($data['username'], Blocklist::USERNAME)) {
            $errors[] = new UsernameBlockedError();
        }

        if (count(str_split($data['username'])) < 6 || count(str_split($data['username'])) > 20 || !preg_match('/^[a-zA-Z\d_\-]+$/', $data['username'])) {
            $errors[] = new UsernameInvalidError();
        }

        $existingUserByUsername = $doctrine->getRepository(User::class)->findOneBy(['username' => $data['username']]);
        if ($existingUserByUsername) {
            $errors[] = new UsernameAlreadyExistsError();
        }

        return $errors;
    }

    public function validateRequest(Request $request, UserInterface $currentUser, array $flags = [], bool $returnOnFirstError = false): array
    {
        $errors = [];
        if (in_array(Ohano::FLAG_MUST_BE_ACTIVATED, $flags) && ($currentUser instanceof User && !$currentUser->isActive())) {
            $errors[] = new AccountNotActivatedError();
            if ($returnOnFirstError) {
                return $errors;
            }
        }

        if (in_array(Ohano::FLAG_MUST_BE_VERIFIED, $flags) && ($currentUser instanceof User && !$currentUser->isVerified())) {
            $errors[] = new AccountNotVerifiedError();
            if ($returnOnFirstError) {
                return $errors;
            }
        }

        return $errors;
    }
}