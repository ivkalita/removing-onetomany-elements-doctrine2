<?php
/**
 * Created by IntelliJ IDEA.
 * User: dev
 * Date: 27.08.15
 * Time: 9:14
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="itineraries_venues")
 */
class ItineraryVenue
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Itinerary", inversedBy="itineraryVenues")
     * @ORM\JoinColumn(name="itinerary_id", referencedColumnName="id")
     */
    private $itinerary;
    /**
     * @ORM\ManyToOne(targetEntity="Venue")
     * @ORM\JoinColumn(name="venue_id", referencedColumnName="id")
     */
    private $venue;

    function __construct()
    {
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set itinerary
     *
     * @param \AppBundle\Entity\Itinerary $itinerary
     * @return ItineraryVenue
     */
    public function setItinerary(\AppBundle\Entity\Itinerary $itinerary = null)
    {
        $this->itinerary = $itinerary;

        return $this;
    }

    /**
     * Get itinerary
     *
     * @return \AppBundle\Entity\Itinerary 
     */
    public function getItinerary()
    {
        return $this->itinerary;
    }

    /**
     * Set venue
     *
     * @param \AppBundle\Entity\Venue $venue
     * @return ItineraryVenue
     */
    public function setVenue(\AppBundle\Entity\Venue $venue = null)
    {
        $this->venue = $venue;

        return $this;
    }

    /**
     * Get venue
     *
     * @return \AppBundle\Entity\Venue 
     */
    public function getVenue()
    {
        return $this->venue;
    }
}
