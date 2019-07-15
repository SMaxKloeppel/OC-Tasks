<?php
  namespace App\Controller;

  use App\Entity\Task;
  
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\Routing\Annotation\Route;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
  use Symfony\Bundle\FrameworkBundle\Controller\Controller;
  use Symfony\Flex\Response as SymfonyResponse;
  
  use Symfony\Component\Form\Extension\Core\Type\TextType;
  use Symfony\Component\Form\Extension\Core\Type\TextareaType;
  use Symfony\Component\Form\Extension\Core\Type\SubmitType;
  

class TaskController extends Controller {
      /**
       * @Route("/", name="list")
       * Method({"GET"})
       */
      public function index() {
        $tasks= $this->getDoctrine()->getRepository(Task::class)->findAll();
        return $this->render('tasks/index.html.twig', array('tasks' => $tasks));
      }

      // Add new task item
      /**
       * @Route("/task/new", name="new")
       * Method({"GET", "POST"})
       */
      public function new(Request $request) {
          $task = new Task();
          $form = $this->createFormBuilder($task)
          ->add('todo', TextType::class, array('attr' => array('class' => 'form-control'))) 
          ->add('details', TextareaType::class, array('attr' => array('class' => 'form-control')))
          ->add('save', SubmitType::class, array('label' => 'Make new', 'attr' => array('class' => 'submit')))
          ->getForm();
          $form->handleRequest($request);
          if($form->isSubmitted() && $form->isValid()){
              $task = $form->getData();
              $entityManager = $this->getDoctrine()->getManager();
              $entityManager->persist($task);
              $entityManager->flush();
              return $this->redirectToRoute('list');
          }
          return $this->render('tasks/new.html.twig', array('form' => $form->createView()));
      }


      // Edit todo
      /**
       * @Route("/task/edit/{id}", name="edit")
       * Method({"GET", "POST"})
       */
      public function edit(Request $request, $id) {
        $task = new Task();
        $task = $this->getDoctrine()->getRepository(Task::class)->find($id);
        $form = $this->createFormBuilder($task)
        ->add('todo', TextType::class, array('attr' => array('class' => 'form-control'))) 
        ->add('details', TextareaType::class, array('attr' => array('class' => 'form-control')))
        ->add('save', SubmitType::class, array('label' => 'Edit', 'attr' => array('class' => 'edit')))
        ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('list');
        }
        return $this->render('tasks/edit.html.twig', array('form' => $form->createView()));
    }


       // Delete
      /**
       * @Route("/task/delete/{id}", name="delete")
       * Method({"DELETE"})
       */
      public function delete(Request $request, $id) {
        $task = $this->getDoctrine()->getRepository(Task::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->REMOVE($task);
        $entityManager->flush();
        $response = new Response();
        $response->send();
      }


      // Details of todo
      /**
       * @Route("/task/{id}", name="details")
       * Method({"GET"})
       */
      public function details($id) {
        $task = $this->getDoctrine()->getRepository(Task::class)->find($id);
        return $this->render('tasks/details.html.twig', array('task' => $task));
      }




    //  /**
    //    * @Route("/task/save")
    //    */ 
    //   public function save() {
    //       $entityManager = $this->getDoctrine()->getManager();

    //       $task = new Task();
    //       $task->setTask('Task two');
    //       $task->setDetails('Details 2');

    //       $entityManager->persist($task);
    //       $entityManager->flush();
    //       return new Response('saved ' .$task->getId());
    //   }
  }
