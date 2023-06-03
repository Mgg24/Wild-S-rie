<?php

    namespace App\Controller;

    use App\Entity\Episode;
    use App\Entity\Season;
    use App\Form\ProgramType;
    use App\Repository\EpisodeRepository;
    use App\Repository\SeasonRepository;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Repository\ProgramRepository;
    use App\Entity\Program;
    use Symfony\Component\HttpFoundation\Request;
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
        #[Route('/new', name: 'new')]
        public function new(Request $request, ProgramRepository $programRepository): Response
        {
            $program = new Program();
            $form    = $this->createForm(ProgramType::class, $program);
            // Get data from HTTP request
            $form->handleRequest($request);
            // Was the form submitted ?
            if ($form->isSubmitted()) {
                $programRepository->save($program, true);

                // Redirect to categories list
                return $this->redirectToRoute('program_index');
            }

                // Create the form, linked with $category
                $form = $this->createForm(ProgramType::class, $program);

                // Render the form

                return $this->render('program/new.html.twig', [
                    'form' => $form,
                ]);
            }


         #[Route('/{id}/', name: 'show', requirements: ['page' =>'\d+'], methods: ['GET'])]
         public function show(Program $program):Response
         {


             /*if (!$program) {
                 throw $this->createNotFoundException(
                     'No program with id : '.$program.' found in program\'s table.'
                 );
             }*/
             return $this->render('program/show.html.twig', [
                 'program' => $program,
             ]);
         }
            #[Route('/{program}/seasons/{season}', name: 'season_show', requirements: ['page' =>'\d+'], methods: ['GET'])]
            //#[Entity('Program', options: ['mapping' => ['programId' => 'id']])]
            //#[Entity('Season', options: ['mapping' => ['seasonId' => 'id']])]
            public function showSeason( Program $program, Season $season): Response
            {

                //$programId = $programRepository->findOneBy(['id' => $programId]);
                //$seasonId = $seasonRepository->findOneBy(['id' => $seasonId]);



                return $this->render('program/season_show.html.twig', [
                    'program' => $program,
                    'season' => $season,


                ]);

            }

            #[Route('/{program}/seasons/{season}/episode/{episode}', name: 'episode_show', requirements:['page'=>'\d+'], methods: ['GET'])]
            //#[Entity('program', options: ['mapping' => ['programId' => 'id']])]
            //#[Entity('season', options: ['mapping' => ['seasonId' => 'id']])]
            //#[Entity('episode', options: ['mapping' => ['episodeId' => 'id']])]

            public function showEpisode(Program $program, Season $season, Episode $episode): Response
            {
           //     $programId = $programRepository->findOneBy(['id' => $programId]);
             //   $seasonId = $seasonRepository->findOneBy(['id' => $seasonId]);
              //  $episodeId = $episodeRepository->findBy(['id' => $episodeId]);

                return $this->render('program/episode_show.html.twig',[
                      'episode'=> $episode,
                     'season'=>$season,
                    'program'=>$program,
                ]);
            }

    }