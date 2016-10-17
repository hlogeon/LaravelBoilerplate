<?php
/**
 * Created by PhpStorm.
 * User: hlogeon <email: hlogeon1@gmail.com>
 * Date: 10/17/16
 * Time: 7:48 PM
 */

namespace App\Domains\User\Transformers;

use App\Domains\User\Entities\User;
use Dingo\Api\Http\Request;
use Dingo\Api\Transformer\Binding;
use Dingo\Api\Contract\Transformer\Adapter;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    public function transform(User $user)
    {
        $nameParts = explode(' ', $user->name);
        return [
            'firstName' => $nameParts[0],
            'lastName' => $nameParts[1],
        ];
    }

}