<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/03/15
 * Time: 15.03
 */

namespace Acme\DemoBundle\Topic;

use Gos\Bundle\WebSocketBundle\Topic\TopicInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\Topic;

class AcmeTopic implements TopicInterface
{

    /**
     * This will receive any Subscription requests for this topic.
     *
     * @param \Ratchet\ConnectionInterface $connection
     * @param $topic
     * @return void
     */
    public function onSubscribe(ConnectionInterface $connection, Topic $topic)
    {
        //this will broadcast the message to ALL subscribers of this topic.
        $topic->broadcast($connection->resourceId . " has joined " . $topic->getId());
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
        $topic->broadcast($connection->resourceId . " has left " . $topic->getId());
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

        e.g.

        if ($topic->getId() == "acme/channel/shout")
            //shout something to all subs.
        */


        $topic->broadcast(array(
            "sender" => $connection->resourceId,
            "topic" => $topic->getId(),
            "event" => $event
        ));
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