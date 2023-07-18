<?php
declare(strict_types=1);

namespace Daniil\OctoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Transaction
 *
 * @package Daniil\OctoBundle\Entity
 */
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


}
