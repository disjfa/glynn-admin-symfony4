<?php

namespace App\Controller\Admin;

use App\Form\Type\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;

/**
 * @Route("/admin/users")
 */
class UserController extends Controller
{
    /**
     * @Route("", name="admin_user_index")
     *
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $this->get('fos_user.user_manager')->findUsers(),
        ]);
    }

    /**
     * @param User    $user
     * @param Request $request
     *
     * @return Response
     */
    private function handleUserForm(User $user, Request $request)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setEnabled(true);
            if (null === $user->getPassword()) {
                $user->setPassword(uniqid());
            }

            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_user_show', ['user' => $user->getId()]);
        }

        return $this->render('admin/user/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/create", name="admin_user_create")
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $user = $this->get('fos_user.user_manager')->createUser();

        return $this->handleUserForm($user, $request);
    }

    /**
     * @Route("/{user}", name="admin_user_show")
     */
    public function showAction(User $user)
    {
        return $this->render('admin/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{user}/edit", name="admin_user_edit")
     *
     * @param User    $user
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(User $user, Request $request)
    {
        return $this->handleUserForm($user, $request);
    }
}
