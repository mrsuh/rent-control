<?php

namespace AppBundle\Controller\View\Security;

use AppBundle\Form\Security\LoginForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SecurityController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/login")
     * @Method({"GET", "POST"})
     */
    public function loginAction(Request $request)
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_view_city_city_list');
        }

        $form = $this->createForm(LoginForm::class);
        $form->handleRequest($request);

        $error    = null;
        $username = null;
        if ($form->isSubmitted() && $form->isValid()) {
            try {

                $data     = $form->getData();
                $username = $data['username'];

                $user = $this->get('model.document.user')->findOneByUsername($username);

                if(null === $user) {
                    throw new AuthenticationException('user not found');
                }

                $this->get('model.logic.security')->authenticate($user, $data['password']);

                $this->get('model.logic.security')->createToken($user);

                return $this->redirectToRoute('app_view_city_city_list');

            } catch (AuthenticationException $e) {

                $this->get('logger')->error($e->getMessage(), ['username' => $username, 'ip' => $request->getClientIp(), 'uri' => $request->getUri()]);

                $error = $e->getMessage();
            } catch (\Exception $e) {
                $this->get('logger')->error($e->getMessage());
                $error = 'Internal server error';
            }
        }

        return $this->render(
            'AppBundle:Security:login.html.twig',
            [
                'form'  => $form->createView(),
                'error' => $error
            ]);
    }
}
