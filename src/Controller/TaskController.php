<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\Type\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TaskController extends AbstractController
{
  /**
   * @Route("/form/new" , name="task_success")
   */
  public function new(Request $request): Response
  {
    // creates a task object and initializes some data for this example
    $task = new Task();
    $task->setTask('Write a blog post');
    $task->setDueDate(new \DateTime('tomorrow'));
    $entityManager = $this->getDoctrine()->getManager();
    $task = $entityManager->find(Task::class, 4);

    $form = $this->createForm(TaskType::class, $task);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      // $form->getData() holds the submitted values
      // but, the original `$task` variable has also been updated
      $task = $form->getData();

      // ... perform some action, such as saving the task to the database
      // for example, if Task is a Doctrine entity, save it!
       $entityManager = $this->getDoctrine()->getManager();
       $entityManager->persist($task);
       $entityManager->flush();

      return $this->redirectToRoute('task_success');
    }

    return $this->renderForm('task/new.html.twig', [
      'form' => $form,
    ]);
  }
}