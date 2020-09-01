<?php

namespace App\Utility;


namespace App\Utility;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

class DbProcessor
{
    private $request;
    private $security;
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * DbProcessor constructor.
     * @param RequestStack $request
     * @param Security $security
     * @param UserRepository $repository
     */
    public function __construct(RequestStack $request, Security $security,UserRepository $repository)
    {
        $this->request = $request->getCurrentRequest();
        $this->security = $security;
        $this->repository = $repository;
    }

    /**
     * @param array $record
     * @return array
     */
    public function __invoke(array $record):array
    {

        //on modifie le $record pour ajouter nos infos.
        $record['extra']['clientIp'] = $this->request->getClientIp();
        $record['extra']['url'] = $this->request->getBaseUrl();
        $record['extra']['method'] = $this->request->getMethod();
        $record['extra']['locale'] = $this->request->getLocale();
        $user = $this->security->getUser();
        //dump($user);die;

        $record['extra']['user'] = $user;
        //dd($record);

        return $record;
    }

}