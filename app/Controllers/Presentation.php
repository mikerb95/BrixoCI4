<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Presentation extends Controller
{
    public function slides()
    {
        return view('slides');
    }

    public function remote()
    {
        return view('remote');
    }

    public function apiSlide()
    {
        $cache = \Config\Services::cache();

        if ($this->request->getMethod() === 'POST') {
            $data = $this->request->getJSON(true);
            $slide = $data['slide'] ?? 1;
            $slide = max(1, min(4, (int) $slide)); // Limitar entre 1 y 4
            $cache->save('current_slide', $slide, 3600); // Cache por 1 hora
            return $this->response->setJSON(['slide' => $slide]);
        } else {
            $slide = $cache->get('current_slide') ?? 1;
            return $this->response->setJSON(['slide' => $slide]);
        }
    }
}