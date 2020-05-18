<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{

    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder= $encoder;
    }
    public function load(ObjectManager $manager)
    {

        $faker=   \Faker\Factory::create();
        $role = new Role();
        $role->setNiveau('1')
             ->setDescription("ROLE_USER");

        $manager->persist($role);
        for ($i=0; $i < 20; $i++) {

            $utilisateur = new Utilisateur();
            $has = $this->encoder->encodePassword($utilisateur, 'passwodr');
            #$utilisateur->setEmail("as@yahoo.fr n°$i")
            $utilisateur->setEmail($faker->email)
                ->setPassword($has)
            ;


            $manager->persist($utilisateur);
        }
        $manager->flush();
    }
}
