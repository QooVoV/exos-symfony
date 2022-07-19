<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
  #[Route('/admin/index', name: 'app_admin_index')]
  public function index(): Response {
    return $this->render('admin/index.html.twig');
  }
  
  // ______________________________________________________________

  #[Route('/admin/category/addNew', name : 'app_admin_category_addNew')]
  public function addNew(Request $request, CategoryRepository $repository): Response {

    // if($request->isMethod('POST')){

    //   $name = $request->request->get('name');

    //   $category = new Category();

    //   $category->setName($name);
  
    //   $repository->add($category, true);

    //   return $this->redirectToRoute('app_admin_category_list');
    // }

    $form = $this->createForm(CategoryType::class);
      
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()){
      $categoryValidated = $form->getData();

      $repository->add($categoryValidated, true);

      return $this->redirectToRoute('app_admin_category_list');
    }
    
    $view = $form->createView();

    return $this->render('admin/category/addNew.html.twig', ['view'=>$view]);
  }

  // ______________________________________________________________

  #[Route('/admin/category/list', name : 'app_admin_category_list')]
  public function list(CategoryRepository $repository) : Response {

    $categories = $repository->findAll();

    return $this->render('admin/category/list.html.twig', ['categories'=>$categories]);
  }

  // ______________________________________________________________

  #[Route('/admin/category/update/{id}', name : 'app_admin_category_update')]
  public function update(Request $request, CategoryRepository $repository, Category $category) : Response {

    // $category = $repository->find($id);

    // if($request->isMethod('POST')){

    //   $name = $request->request->get('name');

    //   $category->setName($name);

    //   $repository->add($category, true);

    //   return $this->redirectToRoute('app_admin_category_list');
    // }

    $form = $this->createForm(CategoryType::class, $category);

    $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()){
        $category= $form->getData();

        $repository->add($category, true);

        return $this->redirectToRoute('app_admin_category_list');
      }
      
      $view = $form->createView();

    return $this->render('admin/category/update.html.twig', ['category'=>$category, 'view'=>$view]);
  }

  // ______________________________________________________________

  #[Route('/admin/category/delete/{id}', name : 'app_admin_category_delete')]
  public function delete(CategoryRepository $repository, int $id) : Response {

    $category = $repository->find($id);

    $repository->remove($category, true);

    return $this->redirectToRoute('app_admin_category_list');
  }

}
