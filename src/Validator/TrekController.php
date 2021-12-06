<?php

namespace App\Validator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrekValidator extends AbstractValidator
{


    public function listQwlImprovement($request, $groups, $dataName): Response
    {
        dump($request)

        return $request;
    }
}
