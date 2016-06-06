<?php

namespace Consoneo\Bundle\UniversignBundle;

use Consoneo\Bundle\UniversignBundle\Entity\LogErrorQuery;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Monolog\Logger;
use PhpXmlRpc\Client;
use PhpXmlRpc\Request;
use PhpXmlRpc\Value;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Created by Gabriel Poret <gporet@consoneo.com>
 * Copyright: Consoneo
 */
class Horodatage
{
    const POST_PDF_URL  =   'ws.universign.eu/tsa/pdf/rpc/';

    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var EventDispatcher
     */
    protected $dispatcher;
    
    /**
     * @var String
     */
    private $login;

    /**
     * @var String
     */
    private $password;

    /**
     * Horodatage constructor.
     * @param $login
     * @param $password
     */
    public function __construct($login, $password)
    {
        $this->login    =   $login;
        $this->password =   $password;
    }

    /**
     * @param $content
     * @return false|String
     * @throws \InvalidArgumentException
     */
    public function postPdf($content)
    {

        $destination = sprintf('https://%s:%s@%s', $this->login, $this->password, self::POST_PDF_URL);
        $client = new Client($destination);

        $response = $client->send(new Request('timestamper.timestamp', array(new Value($content, 'base64'))));

        if ($badCode = $response->faultCode()) {
            $logErrorQuery = (new LogErrorQuery)
                ->setErrorCode($badCode)
                ->setErrorMessage($response->faultString())
            ;
            $this->doctrine->getManager()->persist($logErrorQuery);
            $this->doctrine->getManager()->flush();
            return false;
        } else {
            return $response->value()->me['base64'];
        }
    }

    /**
     * @param Registry $doctrine
     */
    public function setDoctrine(Registry $doctrine)
    {
        $this->doctrine     = $doctrine;
    }
}
