<?php

namespace UserBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class UserController extends Controller
{

    /**
     * @Config\Route("/search", name="search")
     * @Config\Security("is_granted('ROLE_USER')")
     */
    public function getSearchUserAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $request->request->replace($data);
        $form = $request->request->get('query');

        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('UserBundle:User');
        $users = $userRepository->getSearch($form);

        return new JsonResponse(array('autousers' => $users));

    }

    /**
     * @Config\Route("/add-user-project", name="user_project")
     * @Config\Security("is_granted('ROLE_USER')")
     */
    public function addUserToProjectAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $request->request->replace($data);
        $user = $request->request->get('user');
        $project = $request->request->get('project');
        $em = $this->getDoctrine()->getManager();
        $projectRepository = $em->getRepository('AppBundle:Project');
        $userRepository = $em->getRepository('UserBundle:User');
        $name = $userRepository->findBy(['username'=> $user]);
        $project = $projectRepository->find($project);
        $project->addUser($name[0]);
        $em->persist($project);
        $em->flush();





        return new JsonResponse(array('autousers' => 'LOL'));

    }

}
