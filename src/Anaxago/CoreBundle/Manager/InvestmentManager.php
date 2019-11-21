<?php

declare(strict_types=1);

/*
 * This file is part of a anaxago-starter-kit project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Anaxago\CoreBundle\Manager;

use Anaxago\CoreBundle\Repository\InvestmentRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class InvestmentManager.
 */
class InvestmentManager extends BaseManager
{
    /**
     * @var InvestmentRepository
     */
    private $investmentRepository;


    /**
     * ProjectManager constructor.
     * @param InvestmentRepository $investmentRepository
     * @param EntityManagerInterface $entityManager
     * @param string|null $className
     */
    public function __construct(InvestmentRepository $investmentRepository, EntityManagerInterface $entityManager, string $className = null)
    {
        parent::__construct($entityManager, $className);
        $this->investmentRepository = $investmentRepository;
    }
}
