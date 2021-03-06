<?php
namespace App\Model;
use Doctrine\DBAL\Query\QueryBuilder;
use Silex\Application;

class clientModel
{
    private $db;

    public function __construct(Application $app) {
        $this->db = $app['db'];
    }

    public function getCoordonneesClientById($user)
    {
        $queryBuilder = new QueryBuilder($this->db);
        $queryBuilder
            ->select ('*')
            ->from('users')
            ->where('id = '.$user);

        return $queryBuilder->execute()->fetch();
    }

    public function editClient($donnees) {
        $queryBuilder = new QueryBuilder($this->db);
        $queryBuilder
            ->update('users')
            ->set('nom', '?')
            ->set('username','?')
            ->set('email','?')
            ->set('code_postal','?')
            ->set('adresse','?')
            ->set('ville','?')
            ->where('id= ?')
            ->setParameter(0, $donnees['nom'])
            ->setParameter(1, $donnees['username'])
            ->setParameter(2, $donnees['email'])
            ->setParameter(3, $donnees['code_postal'])
            ->setParameter(4, $donnees['adresse'])
            ->setParameter(5, $donnees['ville'])
            ->setParameter(6, $donnees['id']);
        return $queryBuilder->execute();
    }

    public function getAllClient()
    {
        $queryBuilder = new QueryBuilder($this->db);
        $queryBuilder
            ->select ('id','username','email','nom','adresse','ville','code_postal')
            ->from('users')
            ->where('roles = "ROLE_CLIENT"');

        return $queryBuilder->execute()->fetchAll();
    }

    public function addClient($donnees)
    {
        $queryBuilder = new QueryBuilder($this->db);
        $queryBuilder
            ->insert('users')
            ->values([
                'nom'=> '?',
                'username'=>'?',
                'email'=>'?',
                'code_postal'=>'?',
                'ville'=>'?',
                'adresse'=>'?',
                'motdepasse'=>'?',
                'password'=>'?'
            ])

            ->where('id= ?')
            ->setParameter(0, $donnees['nom'])
            ->setParameter(1, $donnees['username'])
            ->setParameter(2, $donnees['email'])
            ->setParameter(3, $donnees['code_postal'])
            ->setParameter(4, $donnees['ville'])
            ->setParameter(5, $donnees['adresse'])
            ->setParameter(6, $donnees['motdepasse'])
            ->setParameter(7, $donnees['password']);
        return $queryBuilder->execute();
    }

    public function deleteClient($id)
    {
        $queryBuilder = new QueryBuilder($this->db);
        $queryBuilder
            ->delete('users')
            ->where('id = :id')
            ->setParameter('id',(int)$id)
        ;
        return $queryBuilder->execute();
    }
}