<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 22/3/2019
 * Time: 8:47 μμ
 */

namespace App\Controller;



use App\Entity\DepartmentEmail;
use App\Entity\Usercredentials;
use App\Form\ContactType;
use App\Repository\DepartmentEmailRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Tests\Fixtures\BlogPost;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FirstController
 * @Route("/api", name="api_")
 */
class FirstController extends FOSRestController
{

    /**
     * List of the departments
     * @Rest\Get("/departments")
     *
     * @return Response
     */
    public function getDepartment()
    {
       $repository = $this->getDoctrine()->getRepository(DepartmentEmail::class);
       $qb= $repository->getNameOfDepartments();
        return $this->handleView($this->view($qb));
    }

    /**
     * @Rest\Post("/user")
     * @return Response
     */
    public function postNewUser(Request $request, \Swift_Mailer $mailer)
    {
        $user = new Usercredentials();
        $form = $this->createForm(ContactType::class,$user);

        $data = json_decode($request->getContent(),true);
        $form->handleRequest($request);
        $form->submit($data);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->sendemail( $user,$mailer);
            return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));
    }




        function sendemail($contactFormData,$mailer){
                dump($contactFormData->getDepartment()->getEmail());
            $message = (new \Swift_Message('New user added'))
                ->setFrom('npapadimitriou1507@gmail.com')
                ->setTo($contactFormData->getDepartment()->getEmail())
                ->setBody(
                  'Name='. $contactFormData->getName(). "\r\n".
                     'surname=' . $contactFormData->getSurname() . "\r\n".
                     'emailAddress=' . $contactFormData->getEmail(). "\r\n".
                    'message' . $contactFormData->getMessage(), 'text/plain');

            $mailer->send($message);
        }


}