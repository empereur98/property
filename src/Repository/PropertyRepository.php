<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\Searchdata;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
/**
 * @extends ServiceEntityRepository<Property>
 *
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    public function save(Property $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Property $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    /**
     * 
     *
     * @return Property[]
     */
    public function findfloor():array{
         return $this->createQueryBuilder('p')
                ->andWhere('p.floor=5')
                ->getQuery()
                ->getResult();
    }
    /**
     * Undocumented function
     *
     * @return Property[]
     */
    public function findlass():array{
return $this->connect()
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }
    public  function price(Searchdata $search){
        $query=$this->connect();
        if($search->getMaxprice()){
            $query=$query->andwhere('p.price<:maxprice')
                         ->setparameter('maxprice',$search->getMaxprice());
        }
        if($search->getMinsurface()){
            $query=$query->andWhere('p.surface>:price')
                         ->setParameter('price',$search->getMinsurface());
        }
        $searchs=$search->getOptions();
        if(isset($searchs)){
             if($searchs->count()==1){
                $query=$query->andWhere(':option MEMBER OF p.options')
                             ->setParameter('option',$searchs->getValues());
        }
        if($searchs->count()>1){
             for ($i=0; $i < $searchs->count(); $i++) { 
                $query=$query->andWhere(":option$i MEMBER OF p.options")
                             ->setParameter("option$i",$searchs->getValues()[$i]);
             }
        }
    }
        return $query->getQuery();
    }
    private function connect(){
        return $this->createQueryBuilder('p');
    }
    public function delete(Property $property):void
    {
         $this->remove($property,true);
        // returns an array of arrays (i.e. a raw data set)
    }
    
//    /**
//     * @return Property[] Returns an array of Property objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Property
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
