<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use App\Entity\Stack;
use Faker\Factory;
use App\Entity\User;
use App\Enum\RoleEnum;
use App\Enum\StateEnum;
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

        for ($i = 0; $i < random_int(50, 100); $i++) {
            $states = [StateEnum::NEW , StateEnum::READ, StateEnum::PENDING, StateEnum::CLOSED];

            $contact = new Contact;

            $contact
                ->setFullname($faker->firstName() . ' ' . $faker->lastName())
                ->setEmail($faker->email())
                ->setTelephone($faker->mobileNumber())
                ->setCreatedAt($this->setDateTimeBetween())
                ->setState($this->randomElement($states))
                ->setMessage($this->surround($faker->sentences(random_int(1, 5))))
                ->setObject(ucfirst($faker->words(random_int(1, 5), true)))
                ->setUpdatedAt($contact->getState() !== StateEnum::NEW ? $this->setDateTimeAfter($contact->getCreatedAt()) : null)
            ;

            $manager->persist($contact);
        }

        for ($i = 0; $i < random_int(100, 180); $i++) {
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