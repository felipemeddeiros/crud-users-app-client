<?

namespace App\Services;

use App\Traits\ConsumesExternalService;

class LoginService
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
	 * Log the user in using the service provider;
	 * @return string
	 */
	public function login($data) 
	{
		return $this->performRequest('POST', "/login", $data);
	}

	public function setUser($user) 
	{
        $this->token = $user->data->token;

        session(['user' => $user->data]);
	}

	public function logout() {
		session()->forget('user');
	}
}