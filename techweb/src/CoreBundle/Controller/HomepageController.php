<?php
namespace CoreBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomepageController extends Controller
{
    /**
     * @Config\Route("/", name="homepage")
     * @Config\Security("is_granted('ROLE_USER')")
     */
    public function indexAction()
    {
        return $this->render('CoreBundle::base.html.twig');
    }


}
