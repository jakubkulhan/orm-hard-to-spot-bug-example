<?php
namespace Example;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class AccountUserAssociation
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
	 * @var \DateTime
	 *
	 * @ORM\Column(type="datetime")
	 * @ORM\JoinColumn(nullable=false)
	 */
	protected $createdAt;

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
