<?php

namespace App\Repository;

use App\Entity\CodeLanguageSkill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CodeLanguageSkill>
 *
 * @method CodeLanguageSkill|null find($id, $lockMode = null, $lockVersion = null)
 * @method CodeLanguageSkill|null findOneBy(array $criteria, array $orderBy = null)
 * @method CodeLanguageSkill[]    findAll()
 * @method CodeLanguageSkill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CodeLanguageSkillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CodeLanguageSkill::class);
    }

    public function add(CodeLanguageSkill $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CodeLanguageSkill $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CodeLanguageSkill[] Returns an array of CodeLanguageSkill objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CodeLanguageSkill
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
