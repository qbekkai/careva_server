<?php

namespace App\Controller;


use App\Entity\Clients;
use App\Entity\Colors;
use App\Entity\Events;
use App\Entity\EventTypes;
use App\Entity\Projects;
use App\Entity\ProjectTypes;
use App\Entity\Sites;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/custom", name="api_perso")
 */
class ApiPersoController extends AbstractController
{

  /**
   * @Route("/projects", name="api_perso:post", methods="POST")
   */
  public function postProject(Request $request)
  {
    $project_req = json_decode($request->getContent(), true);

    $em = $this->getDoctrine()->getManager();

    $client = $em->getRepository(Clients::class)->findBy(['name' => $project_req['client']]);
    $color = $em->getRepository(Colors::class)->findBy(['name' => $project_req['color']]);
    $event_type = $em->getRepository(EventTypes::class)->findBy(['name' => $project_req['event_type']]);
    $event = $em->getRepository(Events::class)->findBy(['name' => $project_req['event']]);
    $project_type = $em->getRepository(ProjectTypes::class)->findBy(['name' => $project_req['project_type']]);
    $site = $em->getRepository(Sites::class)->findBy(['name' => $project_req['site']]);

    $project = new Projects();
    $project->setYear($project_req['year']);
    $project->setMedias($project_req['medias']);

    if (!$client) return $this->json(['status' => 404, 'message' => 'Client Not Found', 'client' => $project_req['client']]);
    else $project->setClient($client[0]);

    if (!$project_type) return $this->json(['status' => 404, 'message' => 'Project Type Not Found', 'project_type' => $project_req['project_type']]);
    else $project->setProjectType($project_type[0]);

    if (!$site) return $this->json(['status' => 404, 'message' => 'Site Not Found', 'site' => $project_req['site']]);
    else $project->setSite($site[0]);

    if ($event_type) $project->setEventType($event_type[0]);
    if ($color) $project->setColor($color[0]);
    if ($event) $project->setEvent($event[0]);

    $em->persist($project);
    $em->flush();

    return $this->json([
      "status" => 200,
      "message" => "Le projet a bien été posté.",
      "project" => $project
    ]);
  }
}
