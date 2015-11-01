<?php

namespace CULabs\IlluminateBundle\Entity\Queue;

use Doctrine\ORM\Mapping as ORM;

/**
 * Failed
 *
 * @ORM\Table(name="failed_jobs")
 * @ORM\Entity(repositoryClass="CULabs\IlluminateBundle\Entity\Queue\FailedRepository")
 */
class Failed
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="connection", type="text")
     */
    private $connection;

    /**
     * @var string
     *
     * @ORM\Column(name="queue", type="text")
     */
    private $queue;

    /**
     * @var string
     *
     * @ORM\Column(name="payload", type="text")
     */
    private $payload;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="failed_at", type="datetime")
     */
    private $failedAt;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set queue
     *
     * @param string $queue
     *
     * @return Failed
     */
    public function setQueue($queue)
    {
        $this->queue = $queue;

        return $this;
    }

    /**
     * Get queue
     *
     * @return string
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * Set payload
     *
     * @param string $payload
     *
     * @return Failed
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * Get payload
     *
     * @return string
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * Set failedAt
     *
     * @param \DateTime $failedAt
     *
     * @return Failed
     */
    public function setFailedAt($failedAt)
    {
        $this->failedAt = $failedAt;

        return $this;
    }

    /**
     * Get failedAt
     *
     * @return \DateTime
     */
    public function getFailedAt()
    {
        return $this->failedAt;
    }

    /**
     * Set connection
     *
     * @param string $connection
     *
     * @return Failed
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;

        return $this;
    }

    /**
     * Get connection
     *
     * @return string
     */
    public function getConnection()
    {
        return $this->connection;
    }
}
