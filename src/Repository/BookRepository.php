<?php

namespace App\Repository;


use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function add(Book $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Book $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllByTitle(): array {
        $queryBuilder = $this->createQueryBuilder('book');

        return $queryBuilder 
            ->orderBy('book.title', 'DESC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult();
    }

    public function findAllByPrice(): array {
        $queryBuilder = $this->createQueryBuilder('book');

        return $queryBuilder 
            ->orderBy('book.price', 'DESC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult();
    }

    public function findAllByAuthor(int $id): array {
        $queryBuilder = $this->createQueryBuilder('book');

        return $queryBuilder 
            ->orderBy('author.name', 'DESC')
            ->leftJoin('book.author', 'author')
            ->andWhere('author.id = :id')
            ->setParameter('id', $id)
            ->setMaxResults(20)
            ->getQuery()
            ->getResult();
    }

    public function findAllByCategory(int $id): array {
        $queryBuilder = $this->createQueryBuilder('book');

        return $queryBuilder 
            ->orderBy('book.title', 'DESC')
            ->leftJoin('book.categories', 'category')
            ->andWhere('category.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Book[] Returns an array of Book objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Book
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
