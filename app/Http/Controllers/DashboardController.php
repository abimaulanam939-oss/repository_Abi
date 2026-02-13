<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $skills = [
            ['name' => 'Frontend (Vue, React)', 'level' => 95],
            ['name' => 'Backend (Laravel, Node)', 'level' => 90],
            ['name' => 'Database (MySQL, MongoDB)', 'level' => 80],
            ['name' => 'UI/UX Design', 'level' => 75],
            ['name' => 'DevOps & Cloud', 'level' => 65],
        ];

        $projects = [
            ['title' => 'AI Portfolio Site', 'desc' => 'Portofolio dengan ChatGPT API + animasi 3D.', 'year' => 2025],
            ['title' => 'E-Commerce Space', 'desc' => 'Toko online futuristik dengan Laravel + Vue.', 'year' => 2024],
            ['title' => 'Galaxy CRM System', 'desc' => 'Sistem manajemen pelanggan dengan tampilan interaktif.', 'year' => 2023],
        ];

        return view('dashboard', compact('skills', 'projects'));
    }
}
