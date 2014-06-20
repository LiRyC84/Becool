<?php

namespace Becool\Bundle\ProfilBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Security controller.
 *
 * @Route("/")
 */
class SecurityController extends Controller
{

  /**
   * Formulaire d'authentification à l'espace membre.
   *
   * @Route("/", name="login")
   * @Template("BecoolProfilBundle:Security:login.html.twig")
   */ 
  public function loginAction()
  {
    // ON récupère les erreurs d'authentification si le formulaire a été passé avec de mauvaises informations
        if ($this->get('request')->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $this->get('request')->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $this->get('request')->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }
  
        return $this->render('BecoolMainBundle:Security:login.html.twig', array(
            // On envoie à notre vue le login qu'a saisi l'utilisateur précédemment
            'last_username' => $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME),
            // Et les erreurs qu'il y a eut lors de la validation du formulaire
            'error'         => $error,
        ));
  }
  
} 
