<?php

namespace App\Controller;

use App\Repository\JobCategoryRepository;
use App\Repository\JobsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(JobsRepository $jobsRepository, JobCategoryRepository $jobCategoryRepository): Response
    {
        $jobs = $jobsRepository->findAll();
        $jobsCategory = $jobCategoryRepository->findAll();
        return $this->render('home/index.html.twig', [
            'jobs' => $jobs,
            'jobsCategory' => $jobsCategory,
           
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', [
        ]);
    }
    #[Route('/company', name: 'app_company')]
    public function company(): Response
    {
        return $this->render('home/company.html.twig', [
        ]);
    }
}
