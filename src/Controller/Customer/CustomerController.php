<?php

namespace App\Controller\Customer;

use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CustomerController extends AbstractController
{
    /**
     * @Route("/api/customers", name="listCustomers", methods={"GET"})
     */
    public function listCustomer(): Response
    {
        $customer = $this->getDoctrine()
            ->getRepository(Customer::class)
            ->findAll()
        ;

        return $this->json($customer);
    }

    /**
     * @Route("/api/customer", name="createCustomer", methods={"POST"})
     */
    public function createCustomer(ValidatorInterface $validator, Request $request): Response
    {
        $datas = $request->request->all();

        if (!$datas) {
            return new Response('Error!');
        }

        $customer = $this->getDoctrine()
            ->getRepository(Customer::class)
            ->findOneBy(['email' => $datas['email']])
        ;

        if($customer) {
            return new Response('This email is already in use!');
        }

        $entityManager = $this->getDoctrine()->getManager();

        $customer = new Customer();
        $customer->setFirstname($datas['firstname']);
        $customer->setLastname($datas['lastname']);
        $customer->setEmail($datas['email']);

        $errors = $validator->validate($customer);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        $entityManager->persist($customer);
        $entityManager->flush();

        return new Response('Saved new customer : '. $customer->getFirstname() . ' ' . $customer->getLastname());
    }

    /**
     * @Route("/api/customer/{id}", name="removeCustomer", methods={"DELETE"})
     */
    public function removeCustomer(Request $request): Response
    {
        $attributes = $request->attributes->all();

        if (!$attributes) {
            return new Response('Error!');
        }

        $customer = $this->getDoctrine()
            ->getRepository(Customer::class)
            ->find($attributes['id'])
        ;

        if(!$customer) {
            return new Response('This customer does not exist!');
        }

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($customer);
        $entityManager->flush();

        return new Response('The customer has been successfully deleted.');
    }
}
