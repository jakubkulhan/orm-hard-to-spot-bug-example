<?php
namespace Example;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Account
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
	protected $associatedUsers;

	/**
	 * @var AccountPlan
	 *
	 * @ORM\ManyToOne(targetEntity="AccountPlan")
	 * @ORM\JoinColumn(nullable=false)
	 */
	protected $plan;

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
	public function getAssociatedUsers()
	{
		return $this->associatedUsers;
	}

	/**
	 * @param int $associatedUsers
	 * @return self
	 */
	public function setAssociatedUsers($associatedUsers)
	{
		$this->associatedUsers = $associatedUsers;
		return $this;
	}

	/**
	 * @return AccountPlan
	 */
	public function getPlan()
	{
		return $this->plan;
	}

	/**
	 * @param AccountPlan $plan
	 * @return self
	 */
	public function setPlan(AccountPlan $plan)
	{
		$this->plan = $plan;
		return $this;
	}

}
