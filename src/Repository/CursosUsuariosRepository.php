<?php

namespace App\Repository;

use App\Entity\CursosUsuarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CursosUsuarios>
 *
 * @method CursosUsuarios|null find($id, $lockMode = null, $lockVersion = null)
 * @method CursosUsuarios|null findOneBy(array $criteria, array $orderBy = null)
 * @method CursosUsuarios[]    findAll()
 * @method CursosUsuarios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CursosUsuariosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CursosUsuarios::class);
    }

    public function add(CursosUsuarios $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CursosUsuarios $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return CursosUsuarios[] Returns an array of CursosUsuarios objects
     */
    public function findByCursoId($value): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.curso = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
/*
    public function findByCursoId($id): ?array
    {
        return $this->createQueryBuilder('c')
            ->select('c.alumno')
            ->setParameter('val', $id)
            ->innerJoin('c.alumno', 'al')
            ->where('c.curso = :val')
            ->getQuery()
            ->getArrayResult()
        ;
    }*/
}
