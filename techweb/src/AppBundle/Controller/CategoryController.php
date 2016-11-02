<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class CategoryController extends Controller
{
    /**
     * @Config\Route("/add-category", name="addCategory")
     * @Config\Security("is_granted('ROLE_USER')")
     */
    public function addCategory(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $request->request->replace($data);
        $id = $request->request->get('projectId');
        $categoryName = $request->request->get('category');

        $category = new Category();
        $category->setName($categoryName);

        $em = $this->getDoctrine()->getManager();

        $projectRepository = $em->getRepository('AppBundle:Project');
        $project = $projectRepository->find($id);
        $category->setProject($project);
        $em->persist($category);
        $em->flush();

        return new JsonResponse(array('success' => true));
    }
}
