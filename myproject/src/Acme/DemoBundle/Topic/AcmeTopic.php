<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/03/15
 * Time: 15.03
 */

namespace Acme\DemoBundle\Topic;

//use Symfony\Component\Security\Core\User\UserInterface;
use Gos\Bundle\WebSocketBundle\Client\ClientStorage;
use Gos\Bundle\WebSocketBundle\Topic\TopicInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\Topic;

class AcmeTopic implements TopicInterface
{
    /**
     * @var ClientStorage
     */
    protected $clientStorage;

    /**
     * @param ClientStorage $clientStorage
     */
    public function __construct(ClientStorage $clientStorage)
    {
        $this->clientStorage = $clientStorage;
    }

    /**
     * This will receive any Subscription requests for this topic.
     *
     * @param \Ratchet\ConnectionInterface $connection
     * @param $topic
     * @return void
     */
    public function onSubscribe(ConnectionInterface $connection, Topic $topic)
    {
        /** @var UserInterface */
        $user = $this->clientStorage->getClient(ClientStorage::getStorageId($connection));
        //this will broadcast the message to ALL subscribers of this topic.
        $topic->broadcast(['msg' => $user . " has joined " . $topic->getId()]);
    }

    /**
     * This will receive any UnSubscription requests for this topic.
     *
     * @param \Ratchet\ConnectionInterface $connection
     * @param $topic
     * @return void
     */
    public function onUnSubscribe(ConnectionInterface $connection, Topic $topic)
    {
        //this will broadcast the message to ALL subscribers of this topic.
        $topic->broadcast(['msg' => $connection->resourceId . " has left " . $topic->getId()]);
    }


    /**
     * This will receive any Publish requests for this topic.
     *
     * @param \Ratchet\ConnectionInterface $connection
     * @param $topic
     * @param $event
     * @param array $exclude
     * @param array $eligible
     * @return mixed|void
     */
    public function onPublish(ConnectionInterface $connection, Topic $topic, $event, array $exclude, array $eligible)
    {
        /*
            $topic->getId() will contain the FULL requested uri, so you can proceed based on that

            if ($topic->getId() == "acme/channel/shout")
               //shout something to all subs.
        */

        $topic->broadcast([
            'msg' => $event
        ]);
    }

    /**
     * Like RPC is will use to prefix the channel
     * @return string
     */
    public function getPrefix()
    {
        return 'acme';
    }

}