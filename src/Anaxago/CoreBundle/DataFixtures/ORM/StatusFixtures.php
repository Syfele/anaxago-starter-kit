<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 17/11/19
 * Time: 13:00
 */

namespace Anaxago\CoreBundle\DataFixtures\ORM;

use Anaxago\CoreBundle\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * @licence proprietary anaxago.com
 * Class ProjectFixtures
 * @package Anaxago\CoreBundle\DataFixtures\ORM
 */
class StatusFixtures extends Fixture
{
    public const FUNDED_REFERENCE = 'funded';
    public const UNFUNDED_REFERENCE = 'unfunded';

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getStatus() as $key => $status) {
            $statusToPersist = (new Status())
                ->setLabel($status['label']);
            $manager->persist($statusToPersist);
            $reference = ($key%2) === 0 ? self::FUNDED_REFERENCE : self::UNFUNDED_REFERENCE;
            $this->addReference($reference, $statusToPersist);
        }
        $manager->flush();
    }

    /**
     * @return array
     */
    public function getStatus(): array
    {
        return [
            [
                'label' => 'financé',
            ],
            [
                'label' => 'non-financé',
            ]
        ];
    }
}
