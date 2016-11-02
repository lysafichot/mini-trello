<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class TaskController extends Controller
{
    /**
     * @Config\Route("/add-task", name="addTask")
     * @Config\Security("is_granted('ROLE_USER')")
     */

    public function addTask(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $request->request->replace($data);

        $categoryId = $request->request->get('categoryId');

        $taskName = $request->request->get('task');

        $task = new Task();
        $task->setName($taskName);

        $em = $this->getDoctrine()->getManager();

        $categoryRepository = $em->getRepository('AppBundle:Category');
        $category = $categoryRepository->find($categoryId);

        $task->setCategory($category);
        $em->persist($task);
        $em->flush();

        return new JsonResponse(array('project' => 'lo'));
    }
}