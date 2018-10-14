<?php
namespace Example;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class AccountPlan
{

	/**
	 * @var int
	 *
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer", nullable=false)
	 */
	protected $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", nullable=false)
	 */
	protected $name;

	/**
	 * @var int
	 *
	 * @ORM\Column(type="integer", nullable=false)
	 */
	protected $maxAssociatedUsers;

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return self
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return self
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getMaxAssociatedUsers()
	{
		return $this->maxAssociatedUsers;
	}

	/**
	 * @param int $maxAssociatedUsers
	 * @return self
	 */
	public function setMaxAssociatedUsers($maxAssociatedUsers)
	{
		$this->maxAssociatedUsers = $maxAssociatedUsers;
		return $this;
	}

}
