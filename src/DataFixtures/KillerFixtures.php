<?php

namespace App\DataFixtures;

use App\Entity\Killer;
use App\Entity\User;
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
            $killer->setBiography('Lorem ipsum dolor sit amet consectetur adipisicing elit. Error facere quam esse quae praesentium, dolore maxime repudiandae, necessitatibus, libero laboriosam architecto beatae? Dolorem deleniti, possimus ipsam minus deserunt architecto quas blanditiis fuga fugiat hic et in maxime, consequatur est. Recusandae excepturi, cupiditate porro minima harum sed odit consequuntur voluptas officia quas ullam rerum nam ea accusamus. Odit eligendi deleniti, sint quo saepe ducimus voluptatum dicta magnam doloribus aspernatur impedit animi, et cumque eos ex pariatur ullam unde ab repudiandae quos beatae quam minima. Nesciunt odio aut vero deserunt nihil consequuntur natus alias dignissimos ipsa quis, corporis expedita ab commodi provident!');
            $manager->persist($killer);
        }

        $manager->flush();
    }
}
