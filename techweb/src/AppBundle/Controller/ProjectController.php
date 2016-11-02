<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Category;
use AppBundle\Entity\Project;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class ProjectController extends Controller
{
    /**
     * @Config\Route("/post-project", name="postproject")
     * @Config\Security("is_granted('ROLE_USER')")
     */
    public function addAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $request->request->replace($data);
        $form = $request->request->get('form');

        $project = new Project();

        $em = $this->getDoctrine()->getManager();
        $project->setName($form['name']);
        $project->addUser($this->getUser());

        $em->persist($project);
        $em->flush();
        return new JsonResponse(array('success' => true));


    }

    /**
     * @Config\Route("/all-project", name="projects")
     * @Config\Security("is_granted('ROLE_USER')")
     */
    public function getAllAction()
    {
        $em = $this->getDoctrine()->getManager();
        $projectRepository = $em->getRepository('AppBundle:Project');
        $projects = $projectRepository->findByUser($this->getUser());

        foreach ($projects as $key => $project) {

            $users = $projectRepository->findAllUsers($project['id']);
            $projects[$key]['groupe'] = [];
            array_push($projects[$key]['groupe'], $users);
        }

        return new JsonResponse(array('projects' => $projects));
    }

    /**
     * @Config\Route("/find-project-id", name="project")
     * @Config\Security("is_granted('ROLE_USER')")
     */
    public function findProjectIdAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $request->request->replace($data);
        $id = $request->request->get('projectId');

        $em = $this->getDoctrine()->getManager();

        $categoryRepository = $em->getRepository('AppBundle:Category');

        $projectRepository = $em->getRepository('AppBundle:Project');
        $project = $projectRepository->findById($id);

        $users = $projectRepository->findAllUsers($project[0]['id']);
        $categories = $projectRepository->findAllCategories($project[0]['id']);

        foreach ($categories as $key => $category) {

            $tasks = $categoryRepository->findAllTasks($category['id']);
            $categories[$key]['tasks'] = [];
            array_push($categories[$key]['tasks'], $tasks);
        }


        $project[0]['groupe'] = [];
        array_push($project[0]['groupe'], $users);
        $project[0]['categories'] = [];
        array_push($project[0]['categories'], $categories);


        return new JsonResponse(array('project' => $project[0]));
    }
}
