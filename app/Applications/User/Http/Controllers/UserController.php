<?php

namespace App\Applications\User\Http\Controllers;

use App\Domains\User\Entities\User;
use App\Domains\User\Transformers\UserTransformer;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * User resource representation
 *
 * @Resource("Users", uri="/user")
 */
class UserController extends BaseController
{
    /**
     * Show all users
     *
     * Get a JSON representation of all the registered users.
     *
     * @Get("/{?page,limit}")
     * @Versions({"v1"})
     * @Parameters({
     *      @Parameter("page", description="The page of results to view.", default=1),
     *      @Parameter("limit", description="The amount of results per page.", default=10)
     * })
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $usersCollection = Collection::make([new User(['name' => 'John Doe']), new User(['name' => 'Kyne West']), new User(['name' => 'Ada Lovelys'])]);
        $users = new LengthAwarePaginator($usersCollection->forPage(2, 1), $usersCollection->count(), 1, 2);
        return $this->response->item($usersCollection->first(), new UserTransformer())->setStatusCode(200);
    }
}
