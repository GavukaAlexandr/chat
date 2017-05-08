<?php

namespace Alex\ChatBundle\Repository;

/**
 * MessageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MessageRepository extends \Doctrine\ORM\EntityRepository
{
    public function findNewMessage($lastMessageId)
    {
        $query = $this
            ->getEntityManager()
            ->createQueryBuilder()
            ->select('m')
            ->from('ChatBundle:Message', 'm')
            ->where('m.id > :id')
            ->setParameter('id', $lastMessageId);
        $query = $query->getQuery()->getResult();
//todo найти ошибку в запросе (получить строку запроса)
        return $query;
    }

    //for clear all messages
//    public function deleteAllMessages()
//    {
//        $query = $this
//            ->getEntityManager()
//            ->createQueryBuilder()
//            ->delete('ChatBundle:Message', 'm')
//            ->where('m.id >= 1');
//        $query = $query->getQuery()->getResult();
//
//        return $query;
//    }
}
