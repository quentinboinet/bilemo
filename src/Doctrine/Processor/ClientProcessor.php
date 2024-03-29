<?php


namespace App\Doctrine\Processor;


use App\Entity\Client;
use Fidry\AliceDataFixtures\ProcessorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ClientProcessor implements ProcessorInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * Processes an object before it is persisted to DB.
     *
     * @param string $id Fixture ID
     * @param object $object
     */
    public function preProcess(string $id, $object): void
    {
        if (!$object instanceof Client) {
            return;
        }

        $password = $this->encoder->encodePassword($object, $object->getPassword());
        $object->setPassword($password);
    }

    /**
     * Processes an object after it is persisted to DB.
     *
     * @param string $id Fixture ID
     * @param object $object
     */
    public function postProcess(string $id, $object): void
    {

    }
}