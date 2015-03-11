<?php

namespace Acme\DemoBundle\Controller;

use Acme\DemoBundle\Entity\Works;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AnntestController extends Controller
{
    /**
     * @Route("/sock", name="_sock")
     * @Template()
     */
    public function sockAction()
    {

        return array(
            'sock_content'=>'Hello Bert!!'
        );

    }


    /**
     * @Route("/ola", name="_ola")
     * @Template()
     */
    public function olaAction()
    {

         $product= $this->getDoctrine()
             ->getRepository('AcmeDemoBundle:Works')
             //->find($id);
            ->findAll();

        /*if (!$product) {
            throw $this->createNotFoundException(
                'Spiacente!! Nessun prodotto trovato per l\'id '.$id
            );
        }*/

        return array(
            'res'=>$product
        );

    }

    /**
     * @Route("/addwork")
     * @Template()
     */
    public function addworkAction()
    {
        $product = new Works();
        $product->setTitle('stardust');
        $product->setDescription('A beautiful story');

        $em= $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        $res= 'Id del record è '.$product->getId();
        return array('res'=>$res);

    }

    /**
     * @Route("/updatework/{id}")
     *
     */
    public function updateworkAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $product= $em->getRepository('AcmeDemoBundle:Works')->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setTitle('Dragon Ball');
        $em->flush();

        return $this->redirect($this->generateUrl('_ola'));
    }

    /**
     * @Route("/deletework/{id}")
     *
     */
    public function deleteworkAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $product= $em->getRepository('AcmeDemoBundle:Works')->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $em->remove($product);
        $em->flush();

        return $this->redirect($this->generateUrl('_ola'));
    }

}
