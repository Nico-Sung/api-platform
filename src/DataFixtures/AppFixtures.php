<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Media; // 👈 N'oublie pas cet import !
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        
        // Admin
        $admin = new User();
        $admin->setEmail('admin@test.com');
        $admin->setFirstName('Admin System');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'password'));
        $manager->persist($admin);

        // User Standard
        $user = new User();
        $user->setEmail('user@test.com');
        $user->setFirstName('John Doe');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
        $manager->persist($user);


        $medias = [];
        for ($i = 1; $i <= 10; $i++) {
            $media = new Media();
            $media->setFilePath("demo_image_$i.jpg"); 
            $manager->persist($media);
            $medias[] = $media;
        }
        
        $categories = [];
        $categoryNames = ['High-Tech', 'Maison', 'Jardin', 'Sports', 'Livres'];

        foreach ($categoryNames as $name) {
            $category = new Category();
            $category->setTitle($name);
            $manager->persist($category);
            $categories[] = $category;
        }

        for ($i = 1; $i <= 50; $i++) {
            $product = new Product();
            $product->setTitle("Produit N°$i");
            $product->setContent("Description détaillée du produit exemple numéro $i");
            
            $product->setPrice(mt_rand(1000, 50000) / 100);
            $product->setQuantity(mt_rand(0, 100));
            $product->setIsPublished(mt_rand(0, 1) === 1);
            
            $date = new \DateTime();
            $date->modify('-' . mt_rand(0, 180) . ' days');
            $product->setCreatedDate($date);

            $randomCategory = $categories[array_rand($categories)];
            $product->setCategory($randomCategory);

            $manager->persist($product);
        }

        $manager->flush();
    }
}