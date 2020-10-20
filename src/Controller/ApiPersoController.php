<?php

namespace App\Controller;


use App\Entity\Clients;
use App\Entity\Colors;
use App\Entity\Events;
use App\Entity\EventTypes;
use App\Entity\ProjectTypes;
use App\Entity\Sites;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


    /**
     * @Route("/api/perso", name="api_perso")
     */
class ApiPersoController extends AbstractController
{
    /**
     * @Route("/clients/{client_name}", name="api_perso:client")
     */
    public function getIdByClient($client_name)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $client = $entityManager->getRepository(Clients::class)->findBy(['name' => $client_name]);
        $entityManager->flush();

        if(!$client){
            return $this->json(['status' => 404,'message' => 'Client Not Found']);
        }


        // return $this->json(
        //     [
        //         'status' => 200,
        //         'message' => 'OK',
        //         'client_id' => $client[0]->getId(),
        //         'client_iri' => '/api/clients/' + strval($client[0]->getId()),
        //         'client_name' => $client_name
        //     ]
        // );
        return $this->json('/api/clients/' . $client[0]->getId());
    }


    /**
     * @Route("/colors/{color_name}", name="api_perso:color")
     */
    public function getIdByColor($color_name)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $color = $entityManager->getRepository(Colors::class)->findBy(['name' => $color_name]);
        $entityManager->flush();

        if(!$color){
            return $this->json(['status' => 404,'message' => 'Color Not Found']);
        }

        // return $this->json(
        //     [
        //         'status' => 200,
        //         'message' => 'OK',
        //         'color_id' => $color[0]->getId(),
        //         'color_iri' => '/api/colors/' . $color[0]->getId(),
        //         'color_name' => $color_name
        //     ]
        // );

        return $this->json('/api/colors/' . $color[0]->getId());
    }

    /**
     * @Route("/event_types/{event_type_name}", name="api_perso:event_type")
     */
    public function getIdByEventType($event_type_name)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $event_type = $entityManager->getRepository(EventTypes::class)->findBy(['name' => $event_type_name]);
        $entityManager->flush();

        if(!$event_type){
            return $this->json(['status' => 404,'message' => 'Event Types Not Found']);
        }

        // return $this->json(
        //     [
        //         'status' => 200,
        //         'message' => 'OK',
        //         'event_type_id' => $event_type[0]->getId(),
        //         'event_type_iri' => '/api/event_types/' . $event_type[0]->getId(),
        //         'event_type_name' => $event_type_name
        //     ]
        // );

        return $this->json('/api/event_types/' . $event_type[0]->getId());
    }

    /**
     * @Route("/events/{event_name}", name="api_perso:event")
     */
    public function getIdByEvent($event_name)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $event = $entityManager->getRepository(Events::class)->findBy(['name' => $event_name]);
        $entityManager->flush();

        if(!$event){
            return $this->json(['status' => 404,'message' => 'Event Not Found']);
        }

        // return $this->json(
        //     [
        //         'status' => 200,
        //         'message' => 'OK',
        //         'event_id' => $event[0]->getId(),
        //         'event_iri' => '/api/events/' . $event[0]->getId(),
        //         'event_name' => $event_name
        //     ]
        // );

        return $this->json('/api/events/' . $event[0]->getId());
    }
    /**
     * @Route("/project_types/{project_type_name}", name="api_perso:project_type")
     */
    public function getIdByProjectType($project_type_name)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $project_type = $entityManager->getRepository(ProjectTypes::class)->findBy(['name' => $project_type_name]);
        $entityManager->flush();

        if(!$project_type){
            return $this->json(['status' => 404,'message' => 'Project Types Not Found']);
        }

        // return $this->json(
        //     [
        //         'status' => 200,
        //         'message' => 'OK',
        //         'project_type_id' => $project_type[0]->getId(),
        //         'project_type_iri' => '/api/project_types/' . $project_type[0]->getId(),
        //         'project_type_name' => $project_type_name
        //     ]
        // );

        return $this->json('/api/project_types/' . $project_type[0]->getId());
    }


    /**
     * @Route("/sites/{site_name}", name="api_perso:site")
     */
    public function getIdByProject($site_name)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $site = $entityManager->getRepository(Sites::class)->findBy(['name' => $site_name]);
        $entityManager->flush();

        if(!$site){
            return $this->json(['status' => 404,'message' => 'Site Not Found']);
        }

        // return $this->json(
        //     [
        //         'status' => 200,
        //         'message' => 'OK',
        //         'site_id' => $site[0]->getId(),
        //         'site_iri' => '/api/sites/' . strval($site[0]->getId()),
        //         'site_name' => $site_name
        //     ]
        // );

        return $this->json('/api/sites/' . $site[0]->getId());
    }
}
