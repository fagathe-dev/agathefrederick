<?php
namespace App\Service;

use App\Entity\User;
use App\Utils\ServiceTrait;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserService
{

    use ServiceTrait;

    private ?Session $session = null;

    public function __construct(
        private EntityManagerInterface $manager,
        private UserRepository $repository,
        private SerializerInterface $serializer,
        private UserPasswordHasherInterface $hasher,
    ) {
        $this->session = new Session;
    }

    public function add(User $user): void
    {
        $user->setPassword($this->hasher->hashPassword($user, $user->getPassword() ?? 'password'))
            ->setCreatedAt($this->now());
            
        if ($this->save($user)) {
            $this->session->getFlashBag()->add('success', 'Utilisateur ajouté avec succès 🚀');
        } else {
            $this->session->getFlashBag()->add('danger', 'Une erreur lors de la créattion de cet utilisateur !');
        }
    }

    /**
     * @param  mixed $user
     * @return bool
     */
    public function save(User $user): bool
    {
        try {
            $this->manager->persist($user);
            $this->manager->flush();
            return true;
        } catch (\Throwable $th) {
            # TODO: créer un système pour logger les exceptions
            sprintf($th->getMessage());
            return false;
        }
    }

}