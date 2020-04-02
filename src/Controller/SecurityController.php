<?php

#**************************************************************************************************************************************#

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;

use App\SQL\sqlRequests;
use App\Form\MySearchType;

use App\Form\RegistrationType;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;

use App\Repository\UserAskerRepository;
use App\Repository\AskerUsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

#**************************************************************************************************************************************#

class SecurityController extends AbstractController
{

#**************************************************************************************************************************************#
#**************************************************************************************************************************************#
    // registration form: with email, username and password  
    /**
     * @Route("/inscription", name="registration")
     */
    public function registration(   ObjectManager $manager, 
                                    Request $request, 
                                    UserPasswordEncoderInterface $encoder,
                                    AskerUsersRepository $AskerRep
                                
                                )
    {

        $usr = new User();

        $form = $this
                ->createForm(RegistrationType::class, $usr);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $hach=$encoder->encodePassword($usr, $usr->getPassword());
            $usr->setPassword($hach);
            $username = $form['username']->getData();
            

           // $username= $usr->getUsername();


            $Askeruser=$AskerRep->findOneBy(['username' => $username]);  
            if ($Askeruser!=null)
               $usr->setAskerid($Askeruser->getId());
            else
                $usr->setAskerid(0);

            $usr->setIsactive(false);
   

            $manager->persist($usr);    
            $manager->flush();

            return $this->redirectToRoute('connect');
        }

        return $this->render(
                                'security/registration.html.twig', 
                                [
                                    'form' => $form->createView()
                                ]
                            );
    }

#**************************************************************************************************************************************#
    // we do not need to connect the database, all is defined and configured in security.yaml
    /**
     * @Route("/connexion", name="connect")
     */

    public function connect()
    {

        return $this->render('security/connexion.html.twig');

    }


#**************************************************************************************************************************************#
    // we do not need to connect the database, all is defined and configured in security.yaml
    /**
     * @Route("/erreur", name="erreur")
     */

    public function erreur()
    {

        return $this->render('security/erreur.html.twig');

    }

#**************************************************************************************************************************************#
    /**
     * @Route("/deconnexion", name="disconnect")
     */
    public function disconnect()
    {

        return $this->render('security/connect.html.twig');

    }

#**************************************************************************************************************************************#

    // allow to admin to give permission connexions to different users
    /**
     * @Route("/autoriser/{id}", name="canAccess")
     */

    public function canAccess(  ObjectManager $manager, 
                                UserRepository $userRep,
                                $id
                            ) 
    {

        $user= new User;
        $user=$userRep->findOneBy(['id' => $id]);  
        $actif=$user->getIsactive();
      
        if($actif)
            $user->setIsactive('0');
        else
            $user->setIsactive('1');
               
        $manager->persist($user);    
        $manager->flush();
        unset($user);

        return $this->redirectToRoute('myUsers');

    }

#**************************************************************************************************************************************#
    /**
     * @Route("/utilisateurs", name="myUsers")
     */
    public function myUsers(ObjectManager $manager, Request $request, UserRepository $userRep)
    {

       $form =  $this
                ->createForm(MySearchType::class);

        $form->handleRequest($request);

        // is the search-form submitted? 
        $sendSearch=false;

        if($form->isSubmitted() && $form->isValid()) {
           
            $sendSearch=true;           
            $search = $form['search']->getData();
            
            if ($search==null)
                $sendSearch=false;
            else
             $result = $userRep->findBy(['username' =>$search]);
        }

        // is the search-form submitted? 

        if ($sendSearch==false)
            $result = $userRep->findAll();

        return $this->render(
                                'security/listUsers.html.twig', 
                                [
                                    'result' => $result, 
                                    'form' => $form->createView()
                                ]
                            );

    }


#**************************************************************************************************************************************#
    /**
     * @Route("/utilisateurs/supprimer/{id}", name="deleteUser")
     */
    public function clearUsers(ObjectManager $manager,User $User_Record)
    {
       
        $manager->remove($User_Record);
        $manager->flush();   
        return $this->redirectToRoute('myUsers');
    }
    

#**************************************************************************************************************************************#
    /**
     * @Route("/utilisateurs/importer2/", name="importAskerUsers2")
     */
    public function importAskerUsers2(ObjectManager $manager)
    {
        $query = $manager->createQuery(' SELECT p.id, p.username, p.password, p.isenable 
                                         FROM App\Entity\AskerUser p 
                                         where p.username not in (select d.username from App\Entity\User d )');
       
        

        $Users = $query->getResult();
        foreach ($Users as $line) {
            $user = new User();
            $user->setUsername($line["username"]);
            $user->setEmail($line["username"]);
            $user->setPassword($line["password"]);
            $user->setIsactive($line["isenable"]);
            $user->setAskerid($line["id"]);

            $manager->persist($user);    
            $manager->flush();
        }

        return $this->redirectToRoute('myUsers');
    }
#**************************************************************************************************************************************#
    



#**************************************************************************************************************************************#
    /**
     * @Route("/utilisateurs/importer/", name="importAskerUsers")
     */
    public function importAskerUsers(ObjectManager $manager, 
                                     RoleRepository $roleRep,
                                     UserRepository $userRep)
    {
        $id='2';    // identifiant lié au role enseignant

        $CreatorUsers = $roleRep->findOneByIdJoinedToAskerUsers($id);

        $Users = $CreatorUsers->getAskerUser();


        foreach ($Users as $user) {
           

            $userinMylist = $userRep->findBy(['username' =>$user->getUsername()]);
            if ($userinMylist==null){
                $Myuser = new User();
                

                $Myuser->setUsername($user->getUsername());
                $Myuser->setEmail($user->getUsername());
                $Myuser->setPassword($user->getPassword());
                $Myuser->setIsactive($user->getIsenable());
                $Myuser->setAskerid($user->getId());

                $manager->persist($Myuser);    
                $manager->flush();
            }
        }


  
       return $this->redirectToRoute('myUsers');
    }
#**************************************************************************************************************************************#
    

 /**
     * @Route("/utilisateurs/touteffacer/", name="deleteUsers")
     */

    public function deleteUsers(ObjectManager $manager){
        $Query = new sqlRequests;

        $Query->deleteAll($manager, "User", '');
        return $this->redirectToRoute('myUsers');

    }
#**************************************************************************************************************************************#
#**************************************************************************************************************************************#
  /* CLASS END */

}

