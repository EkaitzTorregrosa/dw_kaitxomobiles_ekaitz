<?php

namespace App\Repository;

use App\Entity\Mobiles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use Doctrine\ORM\EntityRepository;

class MobilesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mobiles::class);
    }
  public function findAllActive()
  {
    return $this->getEntityManager()
      ->createQuery(
        "SELECT o FROM App:mobiles o ORDER BY o.price ASC"
      )
      ->getResult();
  }
}
