<?php
namespace App\Controller;

use App\Entity\User;
use App\Service\UserService;
use App\Breadcrumb\Breadcrumb;
use App\Form\User\EditInfosType;
use App\Form\User\CreateType;
use App\Breadcrumb\BreadcrumbItem;
use App\Form\User\EmailUpdateType;
use App\Form\User\ChangePasswordType;
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
    public function index(Request $request): Response
    {
        return $this->render('user/index.html.twig', $this->service->index($request));
    }

    #[Route('/add', name: 'add', methods: ['GET', 'POST'])]
    public function add(Request $request): Response
    {
        $breadcrumb = new Breadcrumb([
            new BreadcrumbItem('Liste des utilisateurs', $this->generateUrl('app_user_index')),
            new BreadcrumbItem('Ajouter un utilisateur')
        ]);

        $user = new User;
        $form = $this->createForm(CreateType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->service->add($user);

            return $this->redirectToRoute('app_user_index');
        }

        return $this->render('user/add.html.twig', compact('user', 'form', 'breadcrumb'));
    }

    #[Route('/{id}', name: 'edit', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function edit(User $user, Request $request): Response
    {
        $title = 'Modifier le compte ' . $user->getId();
        $breadcrumb = new Breadcrumb([
            new BreadcrumbItem('Liste des utilisateurs', $this->generateUrl('app_user_index')),
            new BreadcrumbItem('Modification de compte')
        ]);

        $formInfos = $this->createForm(EditInfosType::class, $user);
        $formInfos->handleRequest($request);

        if ($formInfos->isSubmitted() && $formInfos->isValid()) {
            $this->service->update($user);
        }

        $formEmail = $this->createForm(EmailUpdateType::class, $user);
        $formEmail->handleRequest($request);

        if ($formEmail->isSubmitted() && $formEmail->isValid()) {
            $this->service->update($user);
        }

        $formPassword = $this->createForm(ChangePasswordType::class, $user);
        $formPassword->handleRequest($request);

        if ($formPassword->isSubmitted() && $formPassword->isValid()) {
            $this->service->updatePassword($user);
        }

        return $this->render(
            'user/edit.html.twig',
            compact(
                'user',
                'title',
                'breadcrumb',
                'formInfos',
                'formEmail',
                'formPassword',
            )
        );
    }

}