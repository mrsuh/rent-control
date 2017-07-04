<?php

namespace AppBundle\Controller\View\Security;

use AppBundle\Document\User\User;
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
     * @Method({"GET"})
     */
    public function loginAction(Request $request)
    {
        if ($this->getUser()) {
            return $this->redirect('/cities');
        }

        $form = $this->createForm(LoginForm::class);
        $form->handleRequest($request);

        $error    = null;
        $username = null;
        if ($form->isSubmitted() && $form->isValid()) {
            try {

                $data     = $form->getData();
                $username = $data['username'];

                $user = $this->get('odm.hot.data.mapper.factory')->init(User::class)->findOne(['username' => $username]);

                if(null === $user) {
                    throw new AuthenticationException('user not found');
                }

                $this->get('model.security')->authenticate($user, $data['password']);

                $this->get('model.security')->createToken($user);

                return $this->redirect('/cities');

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
