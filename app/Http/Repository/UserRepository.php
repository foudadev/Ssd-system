<?php
namespace App\Http\Repository;

use App\Http\Interfaces\UserInterface;
use App\Models\Client;
use App\Traits\ResponseAPI;

class UserRepository implements UserInterface
{
    use ResponseAPI ;

    public function getAllUsers()
    {
        $users = Client::all();
        if ($users) {
            return $this->sendResponse($users, 'All users have been sent successfully');
         }
    }

    public function getUserByID($id)
    {
        $user = Client::find($id);
        if($user){
            return $this->sendResponse($user, 'user found successfully');
        }else{
            return $this->sendError('user not found');
        }
    }

    public function createOrUpdateUser($data = [], $id = null)
    {
        if(is_null($id)){
            $user = new Client;
            $user->name   = $data['name'];
            $user->mobile = $data['mobile'];
            $user->email  = $data['email'];
            $user->city   = $data['city'];
            $user->address1 = $data['address1'];
            $user->address2 = $data['address2'];
            $user->save();
            return $this->sendResponse($user,'user added successfully');
        }else{
            $user = Client::find($id);
            $user->name   = $data['name'];
            $user->mobile = $data['mobile'];
            $user->email  = $data['email'];
            $user->city   = $data['city'];
            $user->address1 = $data['address1'];
            $user->address2 = $data['address2'];
            $user->save();
            return $this->sendResponse($user,'user updated successfully');
        }
    }

    public function deleteUser($id)
    {
        $user = Client::find($id)->delete();
        if($user){
            return $this->sendResponse($user,'user deleted successfully ');
        }else{
            return $this->sendError('user not found');
        }
    }


}
