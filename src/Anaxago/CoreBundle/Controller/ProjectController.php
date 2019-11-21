<?php declare(strict_types = 1);

namespace Anaxago\CoreBundle\Controller;

use Anaxago\CoreBundle\Manager\ProjectManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;


class ProjectController extends AbstractFOSRestController
{
    /** @var ProjectManager $projectManager*/
    private $projectManager;

    public function __construct(ProjectManager $projectManager)
    {
        $this->projectManager = $projectManager;
    }

    /**
     * @Rest\Get("/api/projects")
     *
     * @SWG\Get(
     *     path="/api/projects",
     *     summary="List projects",
     *     tags={"Project"},
     *     @SWG\Response(
     *         response=200,
     *         description="OK"),
     *     @SWG\Response(
     *         response=400,
     *         description="Bad Request"
     *     )
     * )
     * @return JsonResponse
     */
    public function listProjectsAction(): JsonResponse
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $projects = $this->projectManager->findAll();
        return $this->json($projects,JsonResponse::HTTP_OK,[],['groups' => ['projects']]);
    }
}