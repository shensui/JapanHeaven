<?php

namespace App\Controller;

use App\Entity\Manga;
use App\Form\MangaType;
use App\Repository\GenreRepository;
use App\Repository\MangaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/manga")
 */
class MangaController extends AbstractController
{
    /**
     * @Route("/", name="manga_index")
     * @param MangaRepository $mangaRepository
     * @return Response
     */
    public function index(MangaRepository $mangaRepository): Response
    {
        $alphabet = [
            'a', 'b', 'c',
            'd', 'e', 'f', 'g',
            'h', 'i', 'j', 'k',
            'l', 'm', 'n', 'o',
            'p', 'q', 'r', 's',
            't', 'u', 'v', 'w',
            'x', 'y', 'z'
        ];

        return $this->render('manga/index.html.twig', [
            'az' => $alphabet, "num" => $mangaRepository->byLeter('#'), "a"   => $mangaRepository->byLeter('a'), "b"   => $mangaRepository->byLeter('b'), "c"   => $mangaRepository->byLeter('c'),
            "d"   => $mangaRepository->byLeter('d'), "e"   => $mangaRepository->byLeter('e'),"f"   => $mangaRepository->byLeter('f'), 'g'   => $mangaRepository->byLeter('g'),
            "h"   => $mangaRepository->byLeter('h'), "i"   => $mangaRepository->byLeter('i'), "j"   => $mangaRepository->byLeter('j'), 'k'   => $mangaRepository->byLeter('k'),
            "l"   => $mangaRepository->byLeter('l'), "m"   => $mangaRepository->byLeter('m'), "n"   => $mangaRepository->byLeter('n'), 'o'   => $mangaRepository->byLeter('o'),
            "p"   => $mangaRepository->byLeter('p'), "q"   => $mangaRepository->byLeter('q'), "r"   => $mangaRepository->byLeter('r'), 's'   => $mangaRepository->byLeter('s'),
            "t"   => $mangaRepository->byLeter('t'), "u"   => $mangaRepository->byLeter('u'), "v"   => $mangaRepository->byLeter('v'), 'w'   => $mangaRepository->byLeter('w'),
            "x"   => $mangaRepository->byLeter('x'), "y"   => $mangaRepository->byLeter('y'), "z"   => $mangaRepository->byLeter('z'),
        ]);
    }

    /**
     * @Route("/new", name="manga_new", methods={"GET|POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $manga = new Manga();
        $form = $this->createForm(MangaType::class, $manga);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($manga);
            $em->flush();

            return $this->redirectToRoute('manga_index');
        }

        return $this->render('manga/new.html.twig', [
            'manga' => $manga,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}-{slug}/edit", name="manga_edit", methods="GET|POST")
     * @param Request $request
     * @param Manga $manga
     * @return Response
     */
    public function edit(Request $request, Manga $manga): Response
    {
        $form = $this->createForm(MangaType::class, $manga);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('manga_show', ['id' => $manga->getId(), 'slug' => $manga->getSlug()]);
        }

        return $this->render('manga/edit.html.twig', [
            'manga' => $manga,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="manga_show", methods="GET")
     * @param Manga $manga
     * @return Response
     */
    public function show(Manga $manga): Response
    {
        $auteur = explode(', ', $manga->getAuteur());

        return $this->render('manga/show.html.twig', [
            'manga'   => $manga,
            'auteurs' => $auteur
        ]);
    }

    // recherche


    /**
     * Function qui affiche les genres sur la colonne de gauche de la partie manga.
     * @param GenreRepository $genreRepository
     * @return Response
     */
    public function genre_leftnav(GenreRepository $genreRepository){
        return $this->render('manga/_genrreLeftNav.html.twig',[
            'genre' => $genreRepository->genreByAz()
        ]);
    }
}
