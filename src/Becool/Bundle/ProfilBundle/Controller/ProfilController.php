<?php

namespace Becool\Bundle\ProfilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Becool\Bundle\MainBundle\Entity\User;
use Becool\Bundle\MainBundle\Form\UserType;

use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Profil controller.
 *
 * @Route("/")
 */
class ProfilController extends Controller
{
    /**
     * Vue par défaut du profil.
     * @Secure(roles="ROLE_USER")
     *
     * @Route("/", name="profil")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $user = $this->getUser();

        return array(
            'user' => $user,
        );
    }

}
