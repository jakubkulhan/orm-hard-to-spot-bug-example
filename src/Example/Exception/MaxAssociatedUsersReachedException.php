<?php
namespace Example\Exception;

class MaxAssociatedUsersReachedException extends DomainException
{

	/** @var int */
	private $maxAssociatedUsers;

	public function __construct(int $accountId, int $maxAssociatedUsers)
	{
		parent::__construct(
			"Account [{$accountId}] reached max associated users [{$maxAssociatedUsers}], cannot associate a new one."
		);

		$this->maxAssociatedUsers = $maxAssociatedUsers;
	}

	/**
	 * @return int
	 */
	public function getMaxAssociatedUsers()
	{
		return $this->maxAssociatedUsers;
	}

}
