<?php

namespace ProductBundle\Controller;


use ProductBundle\Model\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    /**
     *
     * @Route("/add", name="add_product")
     */
    public function addAction()
    {
        $product = new Product();
        $product->setName('pilka3');
        $product->setPrice('29,99');
        $product->setDescription('lalalala');

        $product->save();

        return new Response('Created product '.$product->getId());

    }

    /**
     *
     * @Route("/show", name="show_product")
     */
    public function showAction($id)
    {
        $product = ProductQuery::create()
            ->findPk($id);

        if (!$product) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }
    }
}
