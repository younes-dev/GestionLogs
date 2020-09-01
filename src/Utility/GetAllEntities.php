<?php


namespace App\Utility;


use Doctrine\ORM\EntityManagerInterface;

/**
 * Class GetAllEntities
 * @package App\Utility
 */
class GetAllEntities
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * GetAllEntities constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return array
     */
    public function GetEntities():array
    {
        // lien de tuto : https://abendstille.at/blog/?p=163
        $entities = array();
        $em = $this->manager;
        $meta = $em->getMetadataFactory()->getAllMetadata();
        $search="App\Entity\\";
        foreach ($meta as $m) {
            $entities[] = str_replace($search, '', $m->getName());
        }

        return $entities;
    }

}