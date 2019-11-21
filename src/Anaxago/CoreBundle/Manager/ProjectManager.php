<?php

declare(strict_types=1);

/*
 * This file is part of a anaxago-starter-kit project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Anaxago\CoreBundle\Manager;

use Anaxago\CoreBundle\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ProjectManager.
 */
class ProjectManager extends BaseManager
{
    /**
     * @var ProjectRepository
     */
    private $projectRepository;


    /**
     * ProjectManager constructor.
     * @param ProjectRepository $projectRepository
     * @param EntityManagerInterface $entityManager
     * @param string|null $className
     */
    public function __construct(ProjectRepository $projectRepository, EntityManagerInterface $entityManager, string $className = null)
    {
        parent::__construct($entityManager, $className);
        $this->projectRepository = $projectRepository;
    }
}
