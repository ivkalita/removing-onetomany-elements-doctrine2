<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Itinerary;
use AppBundle\Entity\ItineraryVenue;
use AppBundle\Entity\Venue;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/del", name="delete")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $itinerary = $em->getRepository('AppBundle:Itinerary')->findOneBy(['id' => 1]);
        $itineraryVenue = $em->getRepository('AppBundle:ItineraryVenue')->findOneBy(['id' => 1]);

        $itinerary->removeItineraryVenue($itineraryVenue);
        $em->flush();

        return $this->showAction($request);
    }

    /**
     * @Route("/gen", name="generate")
     */
    public function genAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $itinerary = new Itinerary();
        $venue = new Venue();
        $itineraryVenue = new ItineraryVenue();

        $itineraryVenue
            ->setItinerary($itinerary)
            ->setVenue($venue)
        ;

        $itinerary->addItineraryVenue($itineraryVenue);

        $em->persist($venue);
        $em->persist($itinerary);
        $em->flush();

        return $this->showAction($request);
    }

    /**
     * @Route("/show", name="show")
     */
    public function showAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $itineraries = $em->getRepository('AppBundle:Itinerary')->findAll();
        $venues = $em->getRepository('AppBundle:Venue')->findAll();

        $venues = array_map(function($venue) {
            return $venue->getId();
        }, $venues);

        $itineraries = array_map(function($itinerary) {
            $itineraryVenues = $itinerary->getItineraryVenues();
            $serializedItineraryVenues = [];
            foreach($itineraryVenues as $itineraryVenue) {
                $serializedItineraryVenues[] = [
                    'itinerary' => $itineraryVenue->getItinerary()->getId(),
                    'venue' => $itineraryVenue->getVenue()->getId()
                ];
            }
            $result = [
                'id' => $itinerary->getId(),
                'itineraryVenues' => $serializedItineraryVenues
            ];

            return $result;
        }, $itineraries);

        return new JsonResponse(['venues' => $venues, 'itineraries' => $itineraries], 200);
    }
}
