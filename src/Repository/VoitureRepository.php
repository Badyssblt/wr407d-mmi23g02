<?php

namespace App\Repository;

use App\Entity\Voiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Voiture>
 */
class VoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voiture::class);
    }


    public function findByFilters(?string $ville, ?string $keyword)
    {
        $qb = $this->createQueryBuilder('v')
            ->leftJoin('v.garage', 'g')
            ->leftJoin('g.lieu', 'l');

        if ($ville) {
            $qb->andWhere('l.ville LIKE :ville')
                ->setParameter('ville', "%$ville%");
        }

        if ($keyword) {
            $qb->andWhere('v.titre LIKE :keyword OR v.description LIKE :keyword')
                ->setParameter('keyword', "%$keyword%");
        }

        return $qb->getQuery()->getResult();
    }
}
