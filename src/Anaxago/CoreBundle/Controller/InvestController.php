<?php
namespace Anaxago\CoreBundle\Controller;

use Anaxago\CoreBundle\Entity\User;
use Anaxago\CoreBundle\Manager\InvestmentManager;
use Anaxago\CoreBundle\Service\InvestmentService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class InvestController
 * @package Anaxago\CoreBundle\Controller
 *
 */
class InvestController extends AbstractFOSRestController
{
    /**
     * @var InvestmentManager
     */
    private $investmentManager;

    public function __construct(InvestmentManager $investmentManager)
    {
        $this->investmentManager = $investmentManager;
    }

    /**
     * @Rest\Post("/api/investisment", name="post_investisment")
     * @param Request $request
     * @param InvestmentService $investmentService
     * @return JsonResponse
     */
    public function  postInvestment(Request $request, InvestmentService $investmentService): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $investment = $investmentService->createInvestment($request->request->get('amount'));
        $this->investmentManager->save($investment);

        return $this->json($investment, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Get("/api/list/investments/{user}", name="list_investments")
     * @param User $user
     * @return JsonResponse
     */
    public function listInvestments(User $user): JsonResponse
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $investments = $user->getInvestments();

        return  $this->json($investments, Response::HTTP_OK,[], ['group' => ['investments']]);
    }

    /**
     * @Rest\Get("api/thrift", name="thrift")
     * @param InvestmentService $investmentService
     * @return Response
     */
    public function thrift(InvestmentService $investmentService): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $thrift = $investmentService->getThrift($this->getUser()->getInvestments()[0], 5, 0.75);
        return $this->json($thrift, Response::HTTP_OK);
    }
}