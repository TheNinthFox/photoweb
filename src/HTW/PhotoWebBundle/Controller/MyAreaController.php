<?php
namespace HTW\PhotoWebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;



class MyAreaController extends Controller
{
    /**
     * @Route("/")
     * @Method("GET")
     * @Template("HTWPhotoWebBundle:MyArea:index.html.twig")
     */
    public function indexAction()
    {
        $userID = $this->getUser()->getId();

        $repository = $this->getDoctrine()
                           ->getRepository('HTWPhotoWebBundle:Photo');

        $query = $repository->createQueryBuilder('p')
                            ->where('p.user = :userID')
                            ->setParameter('userID', $userID)
                            ->getQuery();

        return array('photos' => $query->getResult());
    }
}