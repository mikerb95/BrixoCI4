<?php

namespace App\Controllers;

use App\Models\ContratistaModel;
use App\Models\ResenaModel;

class Perfil extends BaseController
{
    public function ver($id)
    {
        $contratistaModel = new ContratistaModel();
        $resenaModel = new ResenaModel();

        $pro = $contratistaModel->find($id);
        if (!$pro) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get reviews
        $reviews = $resenaModel->getByContratista($id);

        // Calculate rating
        $ratingSum = 0;
        foreach ($reviews as $r) {
            $ratingSum += $r['calificacion'];
        }
        $avgRating = count($reviews) > 0 ? $ratingSum / count($reviews) : 0;

        // Get services
        $services = []; // TODO: load services for this contractor

        // Prepare data for view
        $pro['imagen'] = !empty($pro['foto_perfil']) ? '/images/profiles/' . $pro['foto_perfil'] : 'https://ui-avatars.com/api/?name=' . urlencode($pro['nombre']) . '&background=random';
        $pro['profesion'] = $pro['experiencia'] ?? 'Profesional'; // Fallback
        $pro['rating'] = number_format($avgRating, 1);
        $pro['reviews_count'] = count($reviews);
        $pro['ubicacion'] = $pro['ciudad'] ?? 'Bogotá';

        return view('perfil', [
            'pro' => $pro,
            'reviews' => $reviews,
            'services' => $services,
        ]);
    }
}