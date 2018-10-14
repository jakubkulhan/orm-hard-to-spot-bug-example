<?php
namespace Example;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class AccountUserAssociationAttempt
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
	 * @var Account
	 *
	 * @ORM\ManyToOne(targetEntity="Account")
	 * @ORM\JoinColumn(nullable=false)
	 */
	protected $account;

	/**
	 * @var User
	 *
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(nullable=false)
	 */
	protected $user;

	/**
	 * @var AccountPlan
	 *
	 * @ORM\ManyToOne(targetEntity="AccountPlan")
	 * @ORM\JoinColumn(nullable=false)
	 */
	protected $plan;

	/**
	 * @var int
	 *
	 * @ORM\Column(type="integer", nullable=false)
	 */
	protected $maxAssociatedUsers;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(type="datetime", nullable=false)
	 */
	protected $createdAt;

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
	 * @return Account
	 */
	public function getAccount()
	{
		return $this->account;
	}

	/**
	 * @param Account $account
	 * @return self
	 */
	public function setAccount(Account $account)
	{
		$this->account = $account;
		return $this;
	}

	/**
	 * @return User
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * @param User $user
	 * @return self
	 */
	public function setUser(User $user)
	{
		$this->user = $user;
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

	/**
	 * @return \DateTime
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * @param \DateTime $createdAt
	 * @return self
	 */
	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;
		return $this;
	}

}
