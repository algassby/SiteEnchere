<?php

namespace App\DataFixtures;

use App\Entity\Achat;
use App\Entity\Enchere;
use App\Entity\HistoriqueEnchere;
use App\Entity\PackJeton;
use App\Entity\Produit;
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

        $faker=   \Faker\Factory::create("fr_FR");
        $role = new Role();
        $role->setNiveau('1')
             ->setDescription("ROLE_USER");



        $manager->persist($role);
        for ($i=0; $i < 20; $i++) {

            $utilisateur = new Utilisateur();
            $has = $this->encoder->encodePassword($utilisateur, 'password');
            #$utilisateur->setEmail("as@yahoo.fr n°$i")
            $utilisateur->setEmail($faker->email)
                ->setPassword($has)
            ;
            $manager->persist($utilisateur);

            $produit = new Produit();
            $produit->setReference($faker->text)
                ->setDescriptif($faker->text)
                ->setImage($faker->imageUrl($width = 200, $height = 150))
                ->setPrix($faker->randomDigit);

            $manager->persist($produit);


            $enchere = new Enchere();
            $enchere->setNumero($faker->numberBetween(10,20))
                ->setDateDebut($faker->dateTime)
                ->setDateFin($faker->dateTime)
            ->setProduit($produit);
            $manager->persist($enchere);

            $historiqueEnchere  = new HistoriqueEnchere();
            $historiqueEnchere->setPrix($faker->randomDigit)
                ->setUtilisateur($utilisateur)
                ->setEnchere($enchere)
                ->setDateEnchere($faker->dateTime);
            $manager->persist($historiqueEnchere);

            $packJeton = new PackJeton();
            $packJeton->setDescrption($faker->text)
                ->setNbJetons($faker->randomDigit)
           ->setPrix($faker->randomDigit);

            $manager->persist($packJeton);


            $achat = new Achat();
            $achat->setDateAchat($faker->dateTime)
                ->setPackJeton($packJeton)
                ->setUtilisateur($utilisateur);
            $manager->persist($achat);
        }
        $manager->flush();
    }
}
