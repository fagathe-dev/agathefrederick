<?php
namespace App\Controller;

use App\Entity\User;
use App\Service\UserService;
use App\Breadcrumb\Breadcrumb;
use App\Form\User\CreateUserType;
use App\Breadcrumb\BreadcrumbItem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/user', name: 'app_user_')]
final class UserController extends AbstractController
{

    public function __construct(
        private UserService $service
    ) {
    }

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        $breadcrumb = new Breadcrumb([
            new BreadcrumbItem('Liste des utilisateurs'),
        ]);

        return $this->render('user/index.html.twig', compact('breadcrumb'));
    }

    #[Route('/add', name: 'add', methods: ['GET', 'POST'])]
    public function add(Request $request): Response
    {
        $breadcrumb = new Breadcrumb([
            new BreadcrumbItem('Liste des utilisateurs', $this->generateUrl('app_user_index')),
            new BreadcrumbItem('Ajouter un utilisateur')
        ]);

        $user = new User;
        $form = $this->createForm(CreateUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->service->add($user);

            return $this->redirectToRoute('app_user_index');
        }

        return $this->render('user/add.html.twig', compact('user', 'form', 'breadcrumb'));
    }

}