<?php

namespace App\Controller;

use App\Entity\Jobs;
use App\Form\JobsType;
use App\Repository\JobCategoryRepository;
use App\Repository\JobsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/jobs')]
class JobsController extends AbstractController
{
    #[Route('/', name: 'app_jobs_index', methods: ['GET'])]
    public function index(JobsRepository $jobsRepository,EntityManagerInterface $entityManager,JobCategoryRepository $jobCategoryRepository,Request $request): Response
    {
        $jobsCategory = $jobCategoryRepository->findAll();
        $form = $this->createForm(JobsType::class);
        $form->handleRequest($request);


        $jobs = $jobsRepository->findAll();
        return $this->render('jobs/index.html.twig', [
            "job" => $jobs,
            "jobsCategory" => $jobsCategory,
        ]);
    }

   
    #[Route('/{id}', name: 'app_jobs_show', methods: ['GET'])]
    public function show(Jobs $job,JobsRepository $jobsRepository): Response
    {
        $previousJobs = $jobsRepository->findPreviousJobs($job);
        $nextJobs = $jobsRepository->findNextJobs($job);
        return $this->render('jobs/show.html.twig', [
            'job' => $job,
            'previousJobs' => $previousJobs,
            'nextJobs' => $nextJobs,
        ]);
    }

  

    // #[Route('/{id}', name: 'app_jobs_delete', methods: ['POST'])]
    // public function delete(Request $request, Jobs $job, EntityManagerInterface $entityManager): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$job->getId(), $request->request->get('_token'))) {
    //         $entityManager->remove($job);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('app_jobs_index', [], Response::HTTP_SEE_OTHER);
    // }
}
