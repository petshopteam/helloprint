<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class User extends AbstractController
{

    /**
     * @Rest\Get("/user/remind", name="pass_reminder")
     */
    public function remindPassword()
    {
        return $this->json(['hello']);
    }


}