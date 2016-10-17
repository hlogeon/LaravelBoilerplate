<?php

namespace App\Applications\User\Http\Controllers;

use App\Domains\User\Entities\User;
use App\Domains\User\Transformers\UserTransformer;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * User resource representation
 */
class UserController extends BaseController
{
    /**
     * @SWG\Get(
     *
     *     path="/",
     *     summary="Get the list of all users",
     *     tags={"user"},
     *     description="Pagination options can be provided(page and limit)",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         type="integer",
     *     ),
     *     @SWG\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Items per page",
     *         required=false,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="list of users"
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid response",
     *     )
     * )
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
