<?php

namespace Consoneo\Bundle\UniversignBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * Created by Gabriel Poret <gporet@consoneo.com>
 * Copyright: Consoneo
 *
 * Consoneo\Bundle\UniversignBundle\Entity\LogErrorQuery
 *
 * @ORM\Table(name="UniversignLogErrorQuery")
 * @ORM\Entity()
 */
class LogErrorQuery
{
    use TimestampableEntity;

    const POST_PDF      =   'post_pdf';
    const HORODATAGE    =   'horodatage';

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $serviceType;

    /**
     * @ORM\Column(type="string")
     */
    private $queryType;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $errorCode;

    /**
     * @var
     * @ORM\Column(type="string", nullable=true)
     */
    private $errorMessage;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return LogErrorQuery
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getServiceType()
    {
        return $this->serviceType;
    }

    /**
     * @param mixed $serviceType
     * @return LogErrorQuery
     */
    public function setServiceType($serviceType)
    {
        $this->serviceType = $serviceType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQueryType()
    {
        return $this->queryType;
    }

    /**
     * @param mixed $queryType
     * @return LogErrorQuery
     */
    public function setQueryType($queryType)
    {
        $this->queryType = $queryType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @param mixed $errorCode
     * @return LogErrorQuery
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param mixed $errorMessage
     * @return LogErrorQuery
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }
}
