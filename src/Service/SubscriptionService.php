<?php

namespace App\Service;

use App\Entity\Subscription;
use App\Ohano;
use Doctrine\Persistence\ManagerRegistry;

class SubscriptionService
{
    public function __construct(private readonly ManagerRegistry $doctrine)
    {
    }

    public function setupSubscriptions(bool $force = false)
    {
        $createdEntities = false;
        $subscriptions = [
            [
                'name' => 'Basic',
                'price' => Ohano::PRICE_BASIC,
                'characteristics' => [],
            ],
            [
                'name' => 'Advanced',
                'price' => Ohano::PRICE_ADVANCED,
                'characteristics' => [],
            ],
            [
                'name' => 'Pro',
                'price' => Ohano::PRICE_PRO,
                'characteristics' => [],
            ],
            [
                'name' => 'Gold',
                'price' => Ohano::PRICE_GOLD,
                'characteristics' => [],
            ],
            [
                'name' => 'Diamond',
                'price' => Ohano::PRICE_DIAMOND,
                'characteristics' => [],
            ],
            [
                'name' => 'Basic+',
                'price' => Ohano::PRICE_BASIC_PLUS,
                'characteristics' => [],
            ],
            [
                'name' => 'Advanced+',
                'price' => Ohano::PRICE_ADVANCED_PLUS,
                'characteristics' => [],
            ],
            [
                'name' => 'Pro+',
                'price' => Ohano::PRICE_PRO_PLUS,
                'characteristics' => [],
            ],
            [
                'name' => 'Gold+',
                'price' => Ohano::PRICE_GOLD_PLUS,
                'characteristics' => [],
            ],
            [
                'name' => 'Diamond+',
                'price' => Ohano::PRICE_DIAMOND_PLUS,
                'characteristics' => [],
            ],
        ];

        if ($force) {
            $all = $this->doctrine->getManager()->getRepository(Subscription::class)->findAll();
            foreach ($all as $subscription) {
                $this->doctrine->getManager()->remove($subscription);
            }
            $this->doctrine->getManager()->flush();
        }

        foreach ($subscriptions as $subscription) {
            $exists = $this->doctrine->getRepository(Subscription::class)->findOneBy(['name' => $subscription['name']]);
            if (!$exists) {
                $subscriptionEntity = new Subscription();
                $subscriptionEntity->setName($subscription['name']);
                $subscriptionEntity->setPrice($subscription['price']);
                $subscriptionEntity->setCharacteristics($subscription['characteristics']);
                $this->doctrine->getManager()->persist($subscriptionEntity);
                $createdEntities = true;
            }
        }

        if ($createdEntities) {
            $this->doctrine->getManager()->flush();
        }
    }
}