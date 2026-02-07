<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Presentation extends Controller
{
    private function getTotalSlides()
    {
        $slidesDir = FCPATH . 'presentation';
        if (!is_dir($slidesDir)) {
            return 4; // Fallback
        }
        $files = glob($slidesDir . '/Slide*.{png,PNG,jpg,jpeg,gif}', GLOB_BRACE);
        return max(1, count($files));
    }

    public function slides()
    {
        $data['totalSlides'] = $this->getTotalSlides();
        return view('slides', $data);
    }

    public function remote()
    {
        $data['totalSlides'] = $this->getTotalSlides();
        return view('remote', $data);
    }

    public function presenter()
    {
        $data['totalSlides'] = $this->getTotalSlides();
        return view('presenter', $data);
    }

    public function mainPanel()
    {
        $data['totalSlides'] = $this->getTotalSlides();
        return view('main_panel', $data);
    }

    public function apiSlide()
    {
        $cache = \Config\Services::cache();
        $totalSlides = $this->getTotalSlides();

        if ($this->request->getMethod() === 'POST') {
            $data = $this->request->getJSON(true);
            $slide = $data['slide'] ?? 1;
            $slide = max(1, min($totalSlides, (int) $slide));
            $cache->save('current_slide', $slide, 3600);
            return $this->response->setJSON(['slide' => $slide]);
        } else {
            $slide = $cache->get('current_slide') ?? 1;
            return $this->response->setJSON(['slide' => $slide]);
        }
    }
}