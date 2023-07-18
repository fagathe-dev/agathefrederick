<?php

namespace App\DataFixtures;

use App\Entity\Stack;
use Faker\Factory;
use App\Entity\User;
use App\Enum\RoleEnum;
use App\Utils\Data\StackData;
use App\Utils\FakerTrait;
use App\Utils\ServiceTrait;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    use FakerTrait, ServiceTrait;

    public function __construct(
        private UserPasswordHasherInterface $hasher,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $listUser = [];
        $listStack = [];

        for ($i = 0; $i < random_int(80, 200); $i++) {
            $user = new User;
            $roles = RoleEnum::cases();

            $user->setFirstname($faker->firstName())
                ->setLastname($faker->lastName())
                ->setEmail($faker->email())
                ->setUsername($faker->userName())
                ->setPassword($this->hasher->hashPassword($user, 'password'))
                ->setToken($this->generateToken())
                ->setCreatedAt($this->setDateTimeBetween('-400 days'))
                ->setUpdatedAt($this->setDateTimeAfter($user->getCreatedAt()))
                ->setRoles([$this->randomElement($roles)])
            ;

            $listUser = [...$listUser, $user];
            $manager->persist($user);
        }



        foreach (StackData::data() as $s) {
            $stack = new Stack;

            $manager->persist($stack->setName($s));
        }

        foreach ($listStack as $key => $value) {
            # code...
        }


        $manager->flush();
    }
}