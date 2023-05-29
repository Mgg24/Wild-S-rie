<?php

    namespace App\Controller;

    use App\Repository\EpisodeRepository;
    use App\Repository\SeasonRepository;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Repository\ProgramRepository;
    use App\Entity\Program;
    #[Route('/program', name: 'program_')]
    class ProgramController extends AbstractController
    {

        #[Route('/', name: 'index')]
        public function index(ProgramRepository $programRepository): Response
        {
            $programs = $programRepository->findAll();
            return $this->render('program/index.html.twig', [
                    'programs' => $programs,
            ]);
        }
         #[Route('/{id}/', name: 'show', requirements: ['page' =>'\d+'], methods: ['GET'])]
         public function show(int $id, ProgramRepository $programRepository):Response
         {
             $program = $programRepository->findOneBy(['id' => $id]);
             // same as $program = $programRepository->find($id);

             if (!$program) {
                 throw $this->createNotFoundException(
                     'No program with id : '.$id.' found in program\'s table.'
                 );
             }
             return $this->render('program/show.html.twig', [
                 'program' => $program,
             ]);
         }
            #[Route('/{programId}/seasons/{seasonId}', name: 'season_show', requirements: ['page' =>'\d+'], methods: ['GET'])]
            public function showSeason(int $programId, ProgramRepository $programRepository, int $seasonId, SeasonRepository $seasonRepository,
                                        EpisodeRepository $episodeRepository): Response
            {

                $program = $programRepository->findOneBy(['id' => $programId]);
                $season = $seasonRepository->findOneBy(['id' => $seasonId]);
                $episodes = $episodeRepository->findBy(['season' => $season]);

                return $this->render('program/season_show.html.twig', [
                    'program' => $program,
                    'season' => $season,
                    'episodes' => $episodes,
                ]);
                
            }

    }