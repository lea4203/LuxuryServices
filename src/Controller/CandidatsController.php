<?php

namespace App\Controller;

use App\Entity\Candidats;
use App\Form\CandidatsType;
use App\Repository\CandidatsRepository;
use App\Repository\ExperienceRepository;
use App\Repository\GenderRepository;
use App\Repository\JobCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/candidats')]
class CandidatsController extends AbstractController
{
  
    #[Route('/edit', name: 'app_candidats_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request,SluggerInterface $slugger , GenderRepository $genderRepository,JobCategoryRepository $jobCategoryRepository, ExperienceRepository $experienceRepository,EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $candidat = $user->getCandidats();

        $jobsCategory = $jobCategoryRepository->findAll();
        $experiences =  $experienceRepository->findAll();
        $genders = $genderRepository->findAll();
        $form = $this->createForm(CandidatsType::class, $candidat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $passportFile = $form->get('passportFile')->getData();

            // if ($passportFile) {
            //     $originalFilename = pathinfo($passportFile->getClientOriginalName(), PATHINFO_FILENAME);
            //     // Slugify the filename
            //     $safeFilename = $slugger->slug($originalFilename);
            //     $newFilename = $safeFilename . '-' . uniqid() . '.' . $passportFile->guessExtension();
            
            //     try {
            //         $passportFile->move(
            //             $this->getParameter('passport_directory'),
            //             $newFilename
            //         );
            //     } catch (FileException $e) {
            //         // Handle file upload exception
            //     }
            
            //     $candidat->setPassportFile($newFilename);
            // }
            // $ProfilPicture = $form->get('profilPicture')->getData();

            // if ($ProfilPicture) {
            //     $originalFilename = pathinfo($ProfilPicture->getClientOriginalName(), PATHINFO_FILENAME);
            //     // this is needed to safely include the file name as part of the URL
            //     $safeFilename = $slugger->slug($originalFilename);
            //     $newFilename = $safeFilename . '-' . uniqid() . '.' . $ProfilPicture->guessExtension();

            //     // Move the file to the directory where brochures are stored
            //     try {
            //         $ProfilPicture->move(
            //             $this->getParameter('profil_picture_directory'),
            //             $newFilename

            //         );
            //     } catch (FileException $e) {
            //         // ... handle exception if something happens during file upload
            //     }

            //     $candidat->setProfilPicture($newFilename);
            // }
            // $cvFile = $form->get('cv')->getData();

            // if ($cvFile) {
            //     $originalFilename = pathinfo($cvFile->getClientOriginalName(), PATHINFO_FILENAME);
            //     // Slugify the filename
            //     $safeFilename = $slugger->slug($originalFilename);
            //     $newFilename = $safeFilename . '-' . uniqid() . '.' . $cvFile->guessExtension();
            
            //     try {
            //         $cvFile->move(
            //             $this->getParameter('cv_directory'),
            //             $newFilename
            //         );
            //     } catch (FileException $e) {
            //         // Handle file upload exception
            //     }
            
            //     $candidat->setCv($newFilename);
            // }
            // $entityManager->persist($candidat);
            $entityManager->flush();

        
        }

        return $this->render('candidats/edit.html.twig', [
            'candidat' => $candidat,
            'genders' => $genders,
            'experiences' => $experiences,
            'jobsCategory'=> $jobsCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_candidats_delete', methods: ['POST'])]
    public function delete(Request $request, Candidats $candidat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidat->getId(), $request->request->get('_token'))) {
            $entityManager->remove($candidat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_candidats_index', [], Response::HTTP_SEE_OTHER);
    }
}
