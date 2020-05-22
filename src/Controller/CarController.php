<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CarController extends AbstractController
{
    /**
     * @Route("/", name="car_browse")
     */
    public function browse(CarRepository $carRepository)
    {
        return $this->render('car/browse.html.twig', [
            'cars' => $carRepository->findAll(),
        ]);
    }

    /**
     * @Route("/car/add", name="car_add")
     */
    public function add(Request $request)
    {
        // Initialisation du formulaire
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        // On vérifie si les données sont reçues et si elles sont valides
        if ($form->isSubmitted() && $form->isValid()) {
            // On ajoute la voiture à la bdd

            $em = $this->getDoctrine()->getManager();
            $em->persist($car);
            $em->flush();

            return $this->redirectToRoute('car_browse');
        }

        return $this->render('car/add.html.twig', [
            // $form est un objet de la classe Form, la méthode createView() retourne un objet de classe FormView pour que twig puisse générer le formulaire en HTML
            'form' => $form->createView(),
        ]);
    }
}
