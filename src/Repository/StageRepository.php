<?php

namespace App\Repository;

use App\Entity\Stage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Stage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stage[]    findAll()
 * @method Stage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Stage::class);
    }


    /**
     * @return Stage[] Returns an array of Stage objects
     */

    public function findStagesByEntreprise($nom)
    {
      //Récupérer le gestionnaire d'entiter
        $gestionnaireEntiter = $this->getEntityManager();

      //Définir requête DQL
        $requete = $gestionnaireEntiter->createQuery(
            'SELECT s,e
             FROM App\Entity\Stage s
             JOIN s.entreprise e
             WHERE e.nom = :nom
             ORDER BY s.titre ASC');

      //Définition de la valeur en paramètre
        $requete->setParameter('nom', $nom);

      //Executer la requete
        return $requete->execute();

    }
    
    /**
     * @return Stage[] Returns an array of Stage objects
     */

    public function findStagesByFormation($nom)
    {
      return $this->createQueryBuilder('s')
                  ->join('s.formations', 'f')
                  ->where('f.nomCourt = :nom')
                  ->orderBy('s.titre','ASC')
                  ->setParameter('nom', $nom)
                  ->getQuery()
                  ->getResult()
      ;
    }


    /**
     * @return Stage[] Returns an array of Stage objects
     */

   public function findAllByAlphabeticOrder()
   {
       return $this->createQueryBuilder('s')
           ->orderBy('s.titre', 'ASC')
           ->getQuery()
           ->getResult()
       ;
   }


   /**
    * @return Stage[] Returns an array of Stage objects
    */

    public function findAllByAlphabeticOrderDQL(){
      //Récupérer le gestionnaire d'entiter
        $gestionnaireEntiter = $this->getEntityManager();

      //Définir la requette
        $requete = $gestionnaireEntiter->createQuery(
          'SELECT s
           FROM App\Entity\Stage s
           ORDER BY s.titre ASC'
        );

      //Exécuter et envoyer la requette
        return $requete->execute();

    }

    /*
    public function findOneBySomeField($value): ?Stage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
