<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Contact;
use App\Entity\Post;
use App\Entity\Stack;
use Cocur\Slugify\Slugify;
use Faker\Factory;
use App\Entity\User;
use App\Enum\RoleEnum;
use App\Enum\StateEnum;
use App\Repository\CategoryRepository;
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
        $slugify = new Slugify;

        for ($i = 0; $i < random_int(50, 80); $i++) {
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

        for ($i = 0; $i < random_int(50, 200); $i++) {
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

        for ($i = 0; $i < random_int(9, 18); $i++) {
            $category = new Category;
            $listPost = [];

            $category->setName(ucfirst($faker->words(random_int(1, 3), true)))
                ->setDescription($i % random_int(1, 3) ? null : $this->surround($faker->sentences(random_int(1, 5))))
                ->setCreatedAt($this->setDateTimeBetween())
                ->setUpdatedAt($this->setDateTimeAfter($category->getCreatedAt()))
                ->setIsAvailable($i % random_int(1, 3) ? false : true)
                ->setSlug($slugify->slugify($category->getName()))
            ;

            for ($i = 0; $i < random_int(10, 20); $i++) {
                $post = new Post;
                $states = [
                    StateEnum::DRAFT,
                    StateEnum::NEW ,
                    StateEnum::PUBLISHED,
                    StateEnum::PUBLISHED,
                    StateEnum::ARCHIEVED,
                    StateEnum::PUBLISHED,
                    StateEnum::TO_VALIDATE
                ];

                $post->setTitle(ucfirst($faker->words(random_int(1, 3), true)))
                    ->setSlug($slugify->slugify($post->getTitle()))
                    ->setContent($this->surround($faker->paragraphs(random_int(2, 5))))
                    ->setState($this->randomElement($states))
                    ->setCreatedAt($this->setDateTimeAfter($category->getCreatedAt()))
                    ->setPublishedAt(
                        $post->getState() === StateEnum::PUBLISHED || $post->getState() === StateEnum::ARCHIEVED
                        ? $this->setDateTimeAfter($post->getCreatedAt())
                        : null
                    )
                    ->setUpdatedAt($this->setDateTimeAfter($post->getCreatedAt()))
                    ->setAuthor($this->randomElement($listUser))
                ;

                if ($post->getState() === StateEnum::PUBLISHED || $post->getState() === StateEnum::ARCHIEVED) {
                    for ($i = 0; $i < random_int(80, 150); $i++) {
                        $comment = new Comment();
                        $comment->setAuthor($this->randomElement($listUser))
                            ->setContent($this->surround($faker->sentences(random_int(1, 2))))
                            ->setCreatedAt($this->setDateTimeAfter($post->getPublishedAt()))
                            ->setFlags($i % random_int(1, 8) ? random_int(2, 5) : 0)
                            ->setIsFlaged($comment->getFlags() > 5)
                            ->setUpdatedAt($comment->getFlags() > 0 ? $comment->getCreatedAt() : null)
                        ;

                        $post->addComment($comment);
                    }
                }

                $category->addPost($post);
            }


            $manager->persist($category);
        }

        foreach (StackData::data() as $s) {
            $stack = new Stack;

            $manager->persist($stack->setName($s));

            $listStack = [...$listStack, $stack];
        }

        $manager->flush();
    }
}