<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CochesController extends AbstractController
{
    private $coches = [
        1 => ["marca" => "Toyota", "modelo" => "Camry", "año" => 2020, "precio" => 25000],
        2 => ["marca" => "Honda", "modelo" => "Civic", "año" => 2018, "precio" => 18000],
        3 => ["marca" => "Ford", "modelo" => "Escape", "año" => 2022, "precio" => 32000],
        5 => ["marca" => "Chevrolet", "modelo" => "Malibu", "año" => 2019, "precio" => 21000],
        7 => ["marca" => "Nissan", "modelo" => "Altima", "año" => 2021, "precio" => 28000]
    ];

    #[Route('/coches/{codigo}', name: 'ficha_coche')]
    public function ficha($codigo): Response
    {
        $resultado = ($this->coches[$codigo] ?? null);

        if ($resultado){
            return $this->render('ficha_coche.html.twig', [
            'coche' => $resultado
        ]);
    }else
        return new Response("<html><body>Coche $codigo no encontrado.</body></html>");
    }

    #[Route('/coches/buscar/{texto}', name: 'buscar_coche')]
    public function buscar($texto): Response
    {
        $resultados = array_filter($this->coches, function ($coche) use ($texto){
            return strpos($coche["marca"], $texto) !== FALSE;
        }  
    );

    return $this->render('lista_coches.html.twig', ['coches' => $resultados]);
    }
}
