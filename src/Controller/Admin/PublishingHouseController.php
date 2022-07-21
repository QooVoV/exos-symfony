<?php

namespace App\Controller\Admin;

use App\Entity\PublishingHouse;
use App\Form\PublishingHouseType;
use App\Repository\PublishingHouseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PublishingHouseController extends AbstractController
{
    #[Route('/admin/index', name: 'app_admin_index')]
  public function index(): Response {
    return $this->render('admin/index.html.twig');
  }
  
  // ______________________________________________________________

  #[Route('/admin/publishingHouse/addNew', name : 'app_admin_publishingHouse_addNew')]
  public function addNew(Request $request, PublishingHouseRepository $repository): Response {

      $form = $this->createForm(PublishingHouseType::class);
      
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()){
        $publishingHouseValidated = $form->getData();

        $repository->add($publishingHouseValidated, true);

        return $this->redirectToRoute('app_admin_publishingHouse_list');
      }
      
      $view = $form->createView();
  
    return $this->render('admin/publishingHouse/addNew.html.twig', ['view'=>$view]);
  }

  // ______________________________________________________________

  #[Route('/admin/publishingHouse/list', name : 'app_admin_publishingHouse_list')]
  public function list(PublishingHouseRepository $repository) : Response {

    $publishingHouses = $repository->findAll();

    return $this->render('admin/publishingHouse/list.html.twig', ['publishingHouses'=>$publishingHouses]);
  }

  // ______________________________________________________________

  #[Route('/admin/publishingHouse/update/{id}', name : 'app_admin_publishingHouse_update')]
  public function update(Request $request, PublishingHouseRepository $repository, PublishingHouse $publishingHouse) : Response {

    $form = $this->createForm(PublishingHouseType::class, $publishingHouse);

    $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()){
        $publishingHouse= $form->getData();

        $repository->add($publishingHouse, true);

        return $this->redirectToRoute('app_admin_publishingHouse_list');
      }
      
      $view = $form->createView();

      return $this->render('admin/publishingHouse/update.html.twig', ['publishingHouse'=>$publishingHouse, 'view'=>$view]);

  }

  // ______________________________________________________________

  #[Route('/admin/publishingHouse/delete/{id}', name : 'app_admin_publishingHouse_delete')]
  public function delete(PublishingHouseRepository $repository, int $id) : Response {

    $publishingHouse = $repository->find($id);

    $repository->remove($publishingHouse, true);

    return $this->redirectToRoute('app_admin_publishingHouse_list');
  }
}
