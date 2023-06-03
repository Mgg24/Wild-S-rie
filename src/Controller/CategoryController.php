<?php

    namespace App\Controller;
    use App\Entity\Category;
    use App\Repository\CategoryRepository;
    use App\Repository\ProgramRepository;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use App\Form\CategoryType;
    use Symfony\Component\HttpFoundation\Request;

    #[Route('/category', name: 'category_')]

    class CategoryController extends AbstractController
    {
        #[Route('/', name: 'index')]
        public function index(CategoryRepository $categoryRepository): Response

        {
            $categorys = $categoryRepository->findAll();
            return $this->render('category/index.html.twig', [
                'categorys' => $categorys,
            ]);
        }

        #[Route('/new', name: 'new')]
        public function new(Request $request, CategoryRepository $categoryRepository): Response
        {
            $category = new Category();
            $form = $this->createForm(CategoryType::class, $category);
            // Get data from HTTP request
            $form->handleRequest($request);

            if ($form->isSubmitted()) {
                $categoryRepository->save($category, true);
                return $this->redirectToRoute('category_index');
            }

            // Create the form, linked with $category
            $form = $this->createForm(CategoryType::class, $category);

            // Render the form

            return $this->render('category/new.html.twig', [
                'form' => $form,
            ]);
        }

        #[Route('/{categoryName}/', name: 'show')]
        public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository  $programRepository): Response
        {
            $category = $categoryRepository->findOneBy(['name' => $categoryName]);
            if (!$category) {
                throw $this->createNotFoundException(
                    'No category with name: ' . $categoryName . ' found.'
                );
            }
            $programs = $programRepository->findBy(['category' => $category], ['id' => 'DESC'], 3);
            return $this->render('category/show.html.twig', [
                'category' => $category,
                'programs' => $programs,
                'noPrograms' => 'Aucune série trouvée dans cette catégorie.',
            ]);

        }

    }