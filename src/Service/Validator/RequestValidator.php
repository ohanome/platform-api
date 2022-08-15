<?php

namespace App\Service\Validator;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class RequestValidator
{
    public function validateUserCreateRequest(Request $request, ManagerRegistry $doctrine): array
    {
        $data = $request->toArray();
        $errors = [];

        if ($request->getMethod() !== 'POST') {
            $errors[] = 'Method must be POST';
        }

        if (!isset($data['email'])) {
            $errors[] = 'Email is required';
        }
        if (!isset($data['password'])) {
            $errors[] = 'Password is required';
        }
        if (!isset($data['username'])) {
            $errors[] = 'Username is required';
        }

        $existingUserByEmail = $doctrine->getRepository(User::class)->findOneBy(['email' => $data['email']]);
        if ($existingUserByEmail) {
            $errors[] = 'User with this email already exists';
        }

        $existingUserByUsername = $doctrine->getRepository(User::class)->findOneBy(['username' => $data['username']]);
        if ($existingUserByUsername) {
            $errors[] = 'User with this username already exists';
        }

        return $errors;
    }
}