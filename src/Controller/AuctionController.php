<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Auction;
use App\Entity\Product;
use App\Form\AuctionType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuctionController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
 
    }
    /**
     * @Route("/auction/{id}", name="auction")
     */
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        $auc = new Auction();
        $id = $request->query->get('id');
        $slug = $request->query->get('slug');
        $comment = $request->query->get('comment');
        $bid = $request->query->get('bid');
        $auc->setBid($bid);
        $auc->setComment($comment);
        $auc->setDate(new \DateTime());
        $auc->setOwner($this->getUser()->getEmail());
        $auc->setProductId($id);
        $auc->setSlug($slug);
        $auc->setStatus(0);
        $em = $this->getDoctrine()->getManager();
        $em->persist($auc);
        $em->flush();
        
 
        return $this->render('auction/index.html.twig', [
            'controller_name' => 'AuctionController',
        ]);
    }

    /**
     * @Route("/enchere/{id}", name="accept_bid")
     */
    public function accept($id)
    {
        $product = $this->entityManager->getRepository(Auction::class)->findOneById($id);
 
        $product->setStatus(1);
        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();
        return $this->redirectToRoute('product', array(
            'id' => $product->getId(), 'slug' => $product->getSlug()
        ));
    }
}
