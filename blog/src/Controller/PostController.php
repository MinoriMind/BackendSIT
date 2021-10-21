<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/post', name: 'post')]
class PostController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(PostRepository $repository): Response
    {
        $posts = $repository->findAll();

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/show/{title}', name: 'show')]
    public function show(PostRepository $repository, $title): Response
    {
        $post = $repository->findOneBy([
            'title' => $title,
        ]);
        
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }

    
    #[Route('/create', name: 'create')]
    public function create(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $file = $request->files->get('post')['image'];
            if($file)
            {
                $filename = md5(uniqid()) . '.' . $file->guessClientExtension();

                $file->move($this->getParameter('uploads_dir'), $filename);

                $post->setImage($filename);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('postindex');
        }
        
        return $this->render('post/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
