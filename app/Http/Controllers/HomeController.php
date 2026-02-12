<?php

namespace App\Http\Controllers;

use App\Models\Statistique;

class HomeController extends Controller
{
    public function index()
    {
        $statistique = Statistique::first();

         // Tableau statique des projets
        $projects = [
            ['img'=>'hero.jpg', 'title'=>'E-commerce', 'desc'=>'Laravel + Stripe', 'route'=>'E-commerce'],
            ['img'=>'hero2.jpg', 'title'=>'App Mobile', 'desc'=>'Flutter', 'route'=>'App Mobile'],
            ['img'=>'profile.jpg', 'title'=>'Dashboard Admin', 'desc'=>'Laravel Admin', 'route'=>'Dashboard Admin'],
            ['img'=>'portfolio.png', 'title'=>'Portfolio Perso', 'desc'=>'HTML, CSS, JS', 'route'=>'Portfolio Perso'],
            // tu peux ajouter autant que tu veux
        ];

        return view('home', compact('statistique','projects'));
    }
}
