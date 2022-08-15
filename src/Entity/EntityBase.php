<?php

namespace App\Entity;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class EntityBase {

    public function toArray(): array
    {
        return (array) $this;
    }

    public function toJson(): string
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);
        return $serializer->serialize($this, 'json');
    }

}