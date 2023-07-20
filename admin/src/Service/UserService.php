<?php
namespace App\Service;

use App\Entity\User;
use App\Utils\ServiceTrait;
use App\Breadcrumb\Breadcrumb;
use App\Breadcrumb\BreadcrumbItem;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserService
{

    use ServiceTrait;

    public function __construct(
        private EntityManagerInterface $manager,
        private UserRepository $repository,
        private SerializerInterface $serializer,
        private UserPasswordHasherInterface $hasher,
        private ValidatorInterface $validator,
        private PaginatorInterface $paginator,
    ) {
    }

    /**
     * index
     *
     * @param  Request $request
     * @return array
     */
    public function index(Request $request): array
    {
        $breadcrumb = new Breadcrumb([
            new BreadcrumbItem('Liste des utilisateurs'),
        ]);

        $data = $this->repository->findAll(); #findUsersAdmin();

        $paginatedUsers = $this->paginator->paginate(
            $data, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            $request->query->getInt('nbItems', 15) /*limit per page*/
        );

        return compact('paginatedUsers', 'breadcrumb');
    }

    /**
     * add
     *
     * @param  mixed $user
     * @return void
     */
    public function add(User $user): void
    {
        $user->setPassword($this->hasher->hashPassword($user, $user->getPassword() ?? 'password'))
            ->setCreatedAt($this->now());

        if ($this->save($user)) {
            $this->addFlash('Utilisateur ajouté avec succès 🚀');
        } else {
            $this->addFlash('Une erreur lors de la créattion de cet utilisateur !', 'danger');
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