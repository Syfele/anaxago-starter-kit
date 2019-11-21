<?php declare(strict_types = 1);

namespace Anaxago\CoreBundle\Controller;

use Anaxago\CoreBundle\Manager\ProjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 *
 * @package Anaxago\CoreBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @var ProjectManager
     */
    private $projectManager;

    public function __construct(ProjectManager $projectManager)
    {
        $this->projectManager = $projectManager;
    }

    /**
     * @Route("/", name="anaxago_core_homepage")
     * @return Response
     */
    public function indexAction(): Response
    {
        $projects = $this->projectManager->findAll();

        return $this->render('@AnaxagoCore/Default/index.html.twig', ['projects' => $projects]);
    }
}
