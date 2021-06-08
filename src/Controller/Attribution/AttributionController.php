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
     * @Route("/api/assignement/create", name="assignCustomerToComputer", methods={"POST"})
     */
    public function assignCustomerToComputer(Request $request): Response
    {
        $datas = $request->request->all();

        if (!$datas) {
            return new Response('Error!');
        }

        $explodeDate = explode('-', $datas['date']);
        $date = new DateTime();
        $date->format('yyyy-MM-dd');
        $date->setDate($explodeDate[0], $explodeDate[1], $explodeDate[2]);

        $explodeSchedule = explode(':', $datas['schedule']);
        $time = new DateTime();
        $time->format('HH');
        $time->setTime($explodeSchedule[0], $explodeSchedule[1]);

        /** @var Computer $computer */
        $computer = $this->getDoctrine()
            ->getRepository(Computer::class)
            ->find($datas['computer_id'])
        ;

        /** @var Customer $customer */
        $customer = $this->getDoctrine()
            ->getRepository(Customer::class)
            ->find($datas['client_id'])
        ;

        if(!$computer) {
            return new Response('This computer does not exist!');
        }

        if(!$customer) {
            return new Response('This customer does not exist!');
        }

        $attribution = new Attribution();
        $attribution->setDate($date);
        $attribution->setComputer($computer);
        $attribution->setCustomer($customer);
        $attribution->setSchedule($time);

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($attribution);
        $entityManager->flush();

        return new Response('The assignment has been made!');
    }
}
