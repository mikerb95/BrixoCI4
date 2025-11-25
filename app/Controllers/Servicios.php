<?php

namespace App\Controllers;

use App\Models\ServicioModel;
use App\Models\CategoriaModel;
use App\Models\ContratistaServicioModel;
use App\Models\UbicacionModel;
use App\Models\ResenaModel;

class Servicios extends BaseController
{
    public function index()
    {
        $categoriaModel = new CategoriaModel();
        $contratistaServicioModel = new ContratistaServicioModel();
        $resenaModel = new ResenaModel();

        // Fetch Categories
        $categories = $categoriaModel->findAll();
        $data['categories'] = array_column($categories, 'nombre');

        // Fetch Locations (Mock or distinct from DB)
        // Since we don't have a direct way to get distinct cities easily without custom query in model, 
        // we'll just use a static list or fetch all locations.
        $data['locations'] = ['Bogotá', 'Medellín', 'Cali', 'Barranquilla'];

        // Fetch Services (Offers)
        $rawServices = $contratistaServicioModel->getAllOffers();

        $services = [];
        foreach ($rawServices as $s) {
            // Get rating for this contractor
            $reviews = $resenaModel->getByContratista($s['id_contratista']);
            $ratingSum = 0;
            foreach ($reviews as $r) {
                $ratingSum += $r['calificacion'];
            }
            $avgRating = count($reviews) > 0 ? $ratingSum / count($reviews) : 0;

            $services[] = [
                'id' => $s['id_servicio'], // Linking to generic service detail
                'titulo' => $s['titulo'],
                'categoria' => $s['categoria'] ?? 'General',
                'precio' => $s['precio'],
                'rating' => number_format($avgRating, 1),
                'reviews' => count($reviews),
                'imagen' => !empty($s['imagen_url']) ? $s['imagen_url'] : 'https://source.unsplash.com/random/400x300/?' . urlencode($s['categoria'] ?? 'service'),
                'profesional' => [
                    'id' => $s['id_contratista'],
                    'nombre' => $s['profesional_nombre'],
                    'avatar' => !empty($s['foto_perfil']) ? $s['foto_perfil'] : 'https://ui-avatars.com/api/?name=' . urlencode($s['profesional_nombre']) . '&background=random',
                    'ubicacion' => $s['ubicacion'] ?? 'Bogotá'
                ]
            ];
        }

        $data['services'] = $services;

        return view('servicios', $data);
    }

    public function detalle($id)
    {
        $servicioModel = new ServicioModel();
        $contratistaServicioModel = new ContratistaServicioModel();
        $resenaModel = new ResenaModel();

        // Fetch Service Details
        $service = $servicioModel->find($id);

        if (!$service) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Servicio no encontrado");
        }

        // Find a contractor who offers this service (Featured Pro)
        // In a real app, you might list all or let user choose.
        // Here we pick the first one we find or random.
        $db = \Config\Database::connect();
        $builder = $db->table('CONTRATISTA_SERVICIO');
        $builder->join('CONTRATISTA', 'CONTRATISTA.id_contratista = CONTRATISTA_SERVICIO.id_contratista');
        $builder->where('id_servicio', $id);
        $pro = $builder->get()->getRowArray();

        if (!$pro) {
            // Fallback if no pro assigned yet
            $pro = [
                'id_contratista' => 0,
                'nombre' => 'Brixo Pro',
                'experiencia' => 'Verificado'
            ];
        }

        // Get Pro Rating
        $reviews = $resenaModel->getByContratista($pro['id_contratista']);
        $ratingSum = 0;
        foreach ($reviews as $r) {
            $ratingSum += $r['calificacion'];
        }
        $avgRating = count($reviews) > 0 ? $ratingSum / count($reviews) : 0;

        $data['service'] = [
            'id' => $service['id_servicio'],
            'titulo' => $service['nombre'],
            'categoria' => 'Servicios Generales', // Could fetch category name if needed
            'precio' => $service['precio_estimado'],
            'unidad' => 'servicio',
            'rating' => number_format($avgRating, 1),
            'reviews_count' => count($reviews),
            'descripcion_corta' => substr($service['descripcion'], 0, 100) . '...',
            'descripcion_larga' => $service['descripcion'],
            'imagenes' => !empty($service['imagen_url']) ? [$service['imagen_url']] : [
                'https://source.unsplash.com/random/800x600/?service,repair',
                'https://source.unsplash.com/random/800x600/?worker',
                'https://source.unsplash.com/random/800x600/?tools'
            ],
            'caracteristicas' => [
                'Profesional Verificado',
                'Garantía Brixo',
                'Pago Seguro'
            ],
            'profesional' => [
                'id' => $pro['id_contratista'],
                'nombre' => $pro['nombre'],
                'titulo' => $pro['experiencia'] ?? 'Profesional',
                'rating' => number_format($avgRating, 1),
                'imagen' => !empty($pro['foto_perfil']) ? $pro['foto_perfil'] : 'https://ui-avatars.com/api/?name=' . urlencode($pro['nombre']) . '&background=random',
                'ubicacion' => 'Bogotá'
            ]
        ];

        return view('servicio_detalle', $data);
    }
}
