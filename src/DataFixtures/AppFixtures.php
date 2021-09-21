<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Client;
use App\Entity\Image;
use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Faker\Factory as FakerFactory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture implements FixtureGroupInterface
{

    private $encoder;
    private $faker;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        $this->faker = FakerFactory::create('fr_FR');
    }

    public static function getGroups(): array
    {
        // Cette fixture fait partie du groupe "test".
        // Cela permet de cibler seulement certains fixtures
        // quand on exécute la commande doctrine:fixtures:load.
        // Pour que la méthode statique getGroups() soit prise
        // en compte, il faut que la classe implémente
        // l'interface FixtureGroupInterface.
        return ['test'];
    }

    public function load(ObjectManager $manager)
    {
        $projectsCount = 15;
        $categorysCount = 15;
        $clientsCount = 15;
        $imagesCount = 15;

        $categorys = $this->loadCategory($manager, $categorysCount);
        $projects = $this->loadProject($manager,$categorys, $projectsCount);
        $clients = $this->loadClient($manager, $clientsCount);
        $images = $this->loadImage($manager, $imagesCount);
        $manager->flush();
    }
    
    public function LoadProject (ObjectManager $manager, Array $categorysParam, int $count)
    {

        for($i = 0; $i < $count; $i++){
            $projects=[];
            $project = new Project();
            $project->setMaintitle($this->faker->sentence(2));
            $project->setSubtitle($this->faker->text(5));
            $project->setBanner($this->faker->url());
            $project->setDescription($this->faker->text(30));
            $project->setDate($this->faker->dateTime($max = 'now'));
            $project->setState($this->faker->boolean());
            //$project->setCategory ($categorysParam [$categoryIndex]);
            if (!empty($categorysParam)){
                $category = array_shift($categorysParam);
                $project->setCategory($category);
            }

        $manager->persist($project);
        $projects[] = $project;
        }
    return $projects;
    }

    public function LoadCategory (ObjectManager $manager, int $count)
    {
        for($i = 0; $i < $count; $i++){
            $categorys=[];
            $category = new Category();
            $category->setName($this->faker->lastname());

        $manager->persist($category);
        $categorys[] = $category;
        }
    return $categorys;
    }

    public function LoadClient (ObjectManager $manager, int $count)
    {
        for($i = 0; $i < $count; $i++){
            $clients=[];
            $client = new Client();
            $client->setName($this->faker->lastname());

        $manager->persist($client);
        $clients[] = $client;
        }
    return $clients;
    }
    public function LoadImage (ObjectManager $manager, int $count)
    {
        for($i = 0; $i < $count; $i++){
            $images=[];
            $image = new Image();
            $image->setUrl($this->faker->url());

            $manager->persist($image);
            $images[] = $image;
        }
    }
}