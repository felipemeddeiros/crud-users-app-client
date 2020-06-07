<?

namespace App\Services;

use App\Traits\ConsumesExternalService;

class UserService
{
	use ConsumesExternalService;

	/**
	 * The base uri to consume the user service
	 * @var string
	 */
	public $baseUri;

	public function __construct()
	{
		$this->baseUri = config('services.users.base_uri');
	}

	/**
	 * Obtain the full list of users from the users service
	 * @return string
	 */
	public function obtainUsers()
	{
		$response = $this->performRequest('GET', '/users');

		return $response->data;
	}

	/**
	 * Create one user using the user service
	 * @return string
	 */
	public function createUser($data)
	{
		return $this->performRequest('POST', '/users', $data);
	}

	/**
	 * Obtain one single user from user service
	 * @return string
	 */
	public function obtainUser($user)
	{
		$response = $this->performRequest('GET', "/users/{$user}");

		return $response->data;
	}

	/**
	 * Update an instance of user using the user service
	 * @return string
	 */
	public function editUser($data, $user)
	{
		return $this->performRequest('PUT', "/users/{$user}", $data);
	}

	/**
	 * Remove a single user using the user service
	 * @return string
	 */
	public function deleteUser($user)
	{
		return $this->performRequest('DELETE', "/users/{$user}");
	}
}
