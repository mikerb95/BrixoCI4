<?php

namespace App\Controllers;

use App\Models\ContratistaModel;
use App\Models\ContratistaServicioModel;
use App\Models\ResenaModel;
use App\Models\CertificacionModel;

class Profesional extends BaseController
{
    public function ver($id)
    {
        $contratistaModel = new ContratistaModel();
        $servicioModel = new ContratistaServicioModel();
        $resenaModel = new ResenaModel();
        $certificacionModel = new CertificacionModel();

        // Fetch professional details
        $pro = $contratistaModel->find($id);

        if (!$pro) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Profesional no encontrado");
        }

        // Fetch services offered by this professional
        $servicios = $servicioModel->getServicesByContratista($id);

        // Fetch reviews
        $resenas = $resenaModel->getByContratista($id);

        // Calculate rating
        $ratingSum = 0;
        foreach ($resenas as $r) {
            $ratingSum += $r['calificacion'];
        }
        $avgRating = count($resenas) > 0 ? $ratingSum / count($resenas) : 0;

        // Fetch certifications
        $certificaciones = $certificacionModel->where('id_contratista', $id)->findAll();
        $certNames = array_column($certificaciones, 'nombre');

        $data['pro'] = [
            'id' => $pro['id_contratista'],
            'nombre' => $pro['nombre'],
            'profesion' => $pro['experiencia'] ?: 'Profesional Independiente',
            'experiencia' => $pro['experiencia'] ?: 'Sin especificar',
            'descripcion' => !empty($pro['descripcion_perfil']) ? $pro['descripcion_perfil'] : ($pro['portafolio'] ?: 'Profesional registrado en Brixo.'),
            'ubicacion' => 'Bogotá', // Default as location is in junction table, could fetch if needed
            'rating' => number_format($avgRating, 1),
            'reviews_count' => count($resenas),
            'precio_hora' => 0, // Not in DB
            'imagen' => !empty($pro['foto_perfil']) ? $pro['foto_perfil'] : 'https://ui-avatars.com/api/?name=' . urlencode($pro['nombre']) . '&background=random&size=200',
            'verificado' => !empty($pro['verificado']) ? (bool)$pro['verificado'] : false,
            'miembro_desde' => date('Y', strtotime($pro['created_at']))
        ];

        $data['servicios'] = array_map(function ($s) {
            return [
                'nombre' => $s['nombre'],
                'precio' => $s['precio_estimado'],
                'descripcion' => $s['descripcion']
            ];
        }, $servicios);

        $data['resenas'] = array_map(function ($r) {
            return [
                'autor' => $r['autor'],
                'fecha' => date('d M Y', strtotime($r['fecha'])),
                'calificacion' => $r['calificacion'],
                'comentario' => $r['comentario']
            ];
        }, $resenas);

        $data['certificaciones'] = !empty($certNames) ? $certNames : ['Identidad Verificada'];

        return view('perfil', $data);
    }
}
