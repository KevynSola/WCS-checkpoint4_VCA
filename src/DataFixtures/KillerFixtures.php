<?php

namespace App\DataFixtures;

use App\Entity\Killer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class KillerFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public const NB_KILLER = 6;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= self::NB_KILLER; $i++){
            $killer = new Killer();
            $killer->setAvatar('image_' . $i . '.jpg');
            $killer->setSkills(['knife', 'gun', 'fist']);
            $manager->persist($killer);
        }

        $manager->flush();
    }
}
