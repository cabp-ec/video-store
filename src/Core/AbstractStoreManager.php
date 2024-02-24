<?php

declare(strict_types=1);

namespace Core;

use Core\Interfaces\KartInterface;
use Core\Interfaces\StoreManagerInterface;
use Services\ClassificationService;
use Services\Interfaces\TransactionalServiceInterface;
use Services\ReportingService;
use Services\SubscriptionService;

abstract class AbstractStoreManager implements StoreManagerInterface
{
    /**
     * Store Manager Constructor
     *
     * @param TransactionalServiceInterface $classificationService
     * @param TransactionalServiceInterface $subscriptionService
     * @param ReportingService $reportingService
     * @param KartInterface $kart
     */
    public function __construct(
        protected TransactionalServiceInterface $classificationService = new ClassificationService(),
        protected TransactionalServiceInterface $subscriptionService = new SubscriptionService(),
        protected ReportingService              $reportingService = new ReportingService(),
        protected readonly KartInterface        $kart = new Kart()
    )
    {
    }
}
