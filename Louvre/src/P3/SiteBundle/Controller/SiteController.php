<?php

// src/P3/SiteBundle/Controller/SiteController.php    

namespace P3\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SiteController extends Controller
{
    public function indexAction()
    {
        return $this->render('P3SiteBundle:Site:index.html.twig');
    }
}