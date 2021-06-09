<?php

namespace App\Controller\Attribution;

use App\Entity\Attribution;
use App\Entity\Computer;
use App\Entity\Customer;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AttributionController extends AbstractController
{
    /**
     * @Route("/api/assignement", name="listAssignment", methods={"GET"})
     */
    public function listAssignment(): Response
    {
        $assignment = $this->getDoctrine()
            ->getRepository(Attribution::class)
            ->findAll()
        ;

        return $this->json($assignment);
    }

    /**
     * @Route("/api/assignement", name="assignCustomerToComputer", methods={"POST"})
     */
    public function assignCustomerToComputer(Request $request): Response
    {
        $datas = $request->request->all();

        dump($datas);

        if (!$datas) {
            return new Response('Error!');
        }

        $date = strtotime($datas['date']);

        /** @var Computer $computer */
        $computer = $this->getDoctrine()
            ->getRepository(Computer::class)
            ->find($datas['computer'])
        ;

        /** @var Customer $customer */
        $customer = $this->getDoctrine()
            ->getRepository(Customer::class)
            ->find($datas['customer'])
        ;

        if(!$computer) {
            return new Response('This computer does not exist!');
        }

        if(!$customer) {
            return new Response('This customer does not exist!');
        }

        $attribution = new Attribution();
        $attribution->setDate(date('d/M/Y', $date));
        $attribution->setComputer($computer);
        $attribution->setCustomer($customer);
        $attribution->setSchedule($datas['schedule']);

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($attribution);
        $entityManager->flush();

        return new Response('The assignment has been made!');
    }
}
