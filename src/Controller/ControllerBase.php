<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ControllerBase extends AbstractController
{
    protected function sendJson(string $message, mixed $data = [], array $errors = [], int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        $timeFormat = 'Y-m-d\TH:i:s.uP';
        $editedData = [
            'meta' => [
                'time' => [
                    'raw' => time(),
                    'timezone' => date_default_timezone_get(),
                    'formatted' => date($timeFormat),
                    'format' => $timeFormat,
                ],
                'status' => $status,
            ],
            'message' => $message,
        ];

        if (!empty($data)) {
            $editedData['data'] = $data;
        }

        if (!empty($errors)) {
            $editedData['errors'] = $errors;
            if ($status === 200) {
                $status = 400;
            }
        }

        if (!empty($context)) {
            $editedData['meta']['context'] = $context;
        }

        return parent::json($editedData, $status, $headers, $context);
    }
}