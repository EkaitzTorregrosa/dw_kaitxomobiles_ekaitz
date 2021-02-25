<?php

namespace App\Repository;

use App\Entity\Mobiles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use Doctrine\ORM\EntityRepository;

class MobilesRepository extends EntityRepository
{
  public function findAllActive()
  {
    return $this->getEntityManager()
      ->createQuery(
        "SELECT * FROM App:Mobiles ORDER BY price ASC"
      )
      ->getResult();
  }
}
