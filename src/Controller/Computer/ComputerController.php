<?php

namespace App\Controller\Computer;

use App\Entity\Computer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ComputerController extends AbstractController
{
    /**
     * @Route("/api/computers", name="listComputers", methods={"GET"})
     */
    public function listComputer(): Response
    {
        $computers = $this->getDoctrine()
            ->getRepository(Computer::class)
            ->findAll()
        ;

        return $this->json($computers);
    }

    /**
     * @Route("/api/computer", name="createComputer", methods={"POST"})
     */
    public function createComputer(ValidatorInterface $validator, Request $request): Response
    {
        $datas = $request->request->all();

        if (!$datas) {
            return new Response('Request is empty!');
        }

        $computer = $this->getDoctrine()
            ->getRepository(Computer::class)
            ->findOneBy(['name' => $datas['name']])
        ;

        if($computer) {
            return new Response('This name is already in use!');
        }

        $entityManager = $this->getDoctrine()->getManager();

        $computer = new Computer();
        $computer->setName($datas['name']);

        $errors = $validator->validate($computer);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        $entityManager->persist($computer);
        $entityManager->flush();

        return new Response('Saved new computer : '. $computer->getName());
    }

    /**
     * @Route("/api/computer/{id}", name="removeComputer", methods={"DELETE"})
     */
    public function removeComputer(Request $request): Response
    {
        $attributes = $request->attributes->all();

        if (!$attributes) {
            return new Response('Error!');
        }

        $computer = $this->getDoctrine()
            ->getRepository(Computer::class)
            ->find($attributes['id'])
        ;

        if(!$computer) {
            return new Response('This computer does not exist!');
        }

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($computer);
        $entityManager->flush();

        return new Response('The computer has been successfully deleted.');
    }
}
