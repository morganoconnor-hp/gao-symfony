<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrekController extends AbstractController
{
    /**
     * TrekController constructor.
     * @param ControllerService $controllerService
     * @param QwlImprovementService $qwlImprovementService
     * @param QwlImprovementValidator $qwlImprovementValidator
     */
    public function __construct(
        ControllerService $controllerService,
        QwlImprovementService $qwlImprovementService,
        QwlImprovementValidator $qwlImprovementValidator
    ) {
        parent::__construct(
            $qwlImprovementService,
            $qwlImprovementValidator,
            $controllerService
        );
    }

    /**
     *  Retourne la liste des améliorations QVT
     *
     * @Route("/api/treks", methods={"GET"})
     *
     * @param Request $request
     * @return Response
     */
    public function listQwlImprovement(Request $request): Response
    {
        $groups = array(
            'trek'
        );

        return $this->getListObjectWithCheckRequest($request, $groups, '', 'listTresk');
    }
}
