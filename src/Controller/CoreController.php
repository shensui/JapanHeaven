<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CoreController extends AbstractController
{
    /**
     * @Route("/", name="core")
     */
    public function index()
    {
        return $this->render('core/index.html.twig', [
            'controller_name' => 'CoreController',
        ]);
    }

    /**
     * @Route("/teste", name="core_test")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function test(){

        $title_page = 'Interval entre 2 date';

        $DateEvenement = new \DateTime('2018-08-26 10:26:30');//demain, sept heures
        $DateNow = new \DateTime("now");//aujourd'hui
        $TempsRestant = $DateNow->diff($DateEvenement);

        if($TempsRestant->i > 0 && $TempsRestant->i < 60){
            $ajout=$TempsRestant->i." minute.";
        }if($TempsRestant->h > 0 && $TempsRestant->h < 24){
            $ajout=$TempsRestant->h." heure.";
        }if($TempsRestant->d > 0 && $TempsRestant->d < 31){
            $ajout=$TempsRestant->d." jours.";
        }if($TempsRestant->m > 0 && $TempsRestant->m < 12){
            $ajout=$TempsRestant->m." moi.";
        }if($TempsRestant->y > 0){
            $ajout=$TempsRestant->y." ans.";
        }



        dump($TempsRestant, $ajout);


        return $this->render("core/teste.html.twig",[
            'title' => $title_page,
            'test1' => $ajout,
        ]);
    }
}
