<?php

namespace App\Controller\Admin;

use App\Entity\Calendrier;
use App\Form\CalendarType;
use App\Repository\CalendrierRepository;
use ContainerIn4zK1I\getConsole_ErrorListenerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     * @var CalendrierRepository
     */
    private $manager,$calendrier;

    public function __construct(EntityManagerInterface $manager, CalendrierRepository $calendrier)
    {
        $this->calendrier=$calendrier;
        $this->manager=$manager;
    }

    /**
     * @Route("/calendar", name="Admin.Calendar")
     */
    public function index(): Response
    {
        $evenements=$this->calendrier->findAll();
        $events=[];
        foreach ($evenements as $event){
            $events[]=[
                'id'=>$event->getId(),
                'start'=>$event->getStart()->format('Y-m-d H:i:s'),
                'end'=>$event->getEnd()->format('Y-m-d H:i:s'),
                'title'=>$event->getTitle(),
                'backgroundColor'=>$event->getBackgroundColor(),
                'borderColor'=>$event->getBorderColor(),
                'textColor'=>$event->getTextColor(),
                'allDay'=>$event->getAllDay()
            ];
        }
        $data = json_encode($events);
        return $this->render('Dashboard/AdminCalendar.html.twig',compact('data'));
    }
    /**
     * @Route ("/calendar/list", name="Admin.Calendar.New")
     */
    public function addEvent(Request $request)
    {
        $newEvent= new Calendrier();
        $form = $this->createForm(CalendarType::class,$newEvent);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($newEvent);
            $this->manager->flush();
            $this->addFlash('success', 'Commande ajoutée avec succès');
        }
        $events = $this->calendrier->findAll();
        return $this->render('Dashboard/AdminCalendarAdd.html.twig',[
            'form'=>$form->createView(),
            'events'=>$events
        ]);
    }

    /**
     * @param Request $request
     * @Route ("/calendar/list/{id}", name="Admin.Calendar.Edit", methods={"PUT"} )
     */
    public function editEvent(?Calendrier $calendrier,Request $request){
        /*$donnees=json_decode($request->getContent());

        if(
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->end) && !empty($donnees->end) &&
            isset($donnees->description) && !empty($donnees->description) &&
            isset($donnees->backgroundColor) && !empty($donnees->backgroundColor)&&
            isset($donnees->borderColor) && !empty($donnees->borderColor)&&
            isset($donnees->textColor) && !empty($donnees->textColor)
        )
        {
            $code = 200;
            if(!$calendrier){
                $calendrier = new Calendrier();
                $code = 201;
            }
            $calendrier->setTitle($donnees->title);
            $calendrier->setStart(new \DateTime($donnees->start));
            $calendrier->setDescription($donnees->description);
            $calendrier->setAllDay($donnees->allDay);
            if ($donnees->allDay){
                $calendrier->setEnd(new \DateTime($donnees->start));
            }else{
                $calendrier->setEnd(new \DateTime($donnees->end));
            }
            $calendrier->setBackgroundColor($donnees->backgroundColor);
            $calendrier->setBorderColor($donnees->borderColor);
            $calendrier->setTextColor($donnees->textColor);
            $this->manager->persist($calendrier);
            $this->manager->flush();
            return new Response('C est bon',$code);
        }
        else{
            return new Response('c pas bon',404);
        }*/
        $donnees = json_decode($request->getContent());

        if(
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->description) && !empty($donnees->description) &&
            isset($donnees->backgroundColor) && !empty($donnees->backgroundColor) &&
            isset($donnees->borderColor) && !empty($donnees->borderColor) &&
            isset($donnees->textColor) && !empty($donnees->textColor)
        ){
            $code = 200;

            // On vérifie si l'id existe
            if(!$calendrier){
                // On instancie un rendez-vous
                $calendar = new Calendrier();

                // On change le code
                $code = 201;
            }

            // On hydrate l'objet avec les données
            $calendrier->setTitle($donnees->title);
            $calendrier->setDescription($donnees->description);
            $calendrier->setStart(new \DateTime($donnees->start));
            if($donnees->allDay){
                $calendrier->setEnd(new \DateTime($donnees->start));
            }else{
                $calendrier->setEnd(new \DateTime($donnees->end));
            }
            $calendrier->setAllDay($donnees->allDay);
            $calendrier->setBackgroundColor($donnees->backgroundColor);
            $calendrier->setBorderColor($donnees->borderColor);
            $calendrier->setTextColor($donnees->textColor);

            $em = $this->getDoctrine()->getManager();
            $em->persist($calendrier);
            $em->flush();

            // On retourne le code
            return new Response('Ok', $code);
        }else{
            // Les données sont incomplètes
            return new Response('Données incomplètes', 404);
        }


        return $this->render('Dashboard/AdminCalendar.html.twig', [
            'controller_name' => 'CalendarController',
        ]);
    }
}

