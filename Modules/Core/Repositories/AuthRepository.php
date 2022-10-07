<?php namespace Modules\Core\Repositories;

use App\User;
use App\Models\Profile;
use Modules\Core\Replies\FailedReply;
use Modules\Core\Replies\SuccessReply;

use Illuminate\Support\Arr;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Support\Facades\DB;
use Sentinel;
use Storage;


class AuthRepository implements AuthInterface
{
    public function __construct()
    {

    }


    /* * *
     * roleRedirect()
     *
     */
    public function roleRedirect()
    {
        $user = $this->getUser();
        $role = $user->roles->first();
        if (!empty($role->branch_id)){
            session()->put('user_branch_id', $role->branch_id);
        }

        return redirect($role->redirect_url);
    }




    /* * *
     * Register new user to the system
     *
     * @param Array $userInfo
     *
     * @return User Object or False
    */


    public function register(array $userInfo)
    {

        $role = $userInfo['role'];

        $user = Sentinel::registerAndActivate($userInfo);

        if($user){
            //role assign
            $role = $this->findRoleByID($role); // subscriber role always 2;
            if($role->active_directory ==1){
                $userDir = $user->id.'-'.time();
                Storage::makeDirectory($userDir);
            }else $userDir = NULL;

            // Profile Update
//            $profile =  [
//                'full_name' => $userInfo['full_name'],
//                'p_uid'     => $user->id,
//                'directory' => $userDir,
//            ];
//
//            $this->createProfile($profile);
            return $user;

        }else{
            return false;
        }

    }


    public function registerAndActivate(array $credentials)
    {
        return Sentinel::registerAndActivate($credentials);
    }

    public function createRole(array $credentials)
    {
       return Sentinel::getRoleRepository()->createModel()->create($credentials);
    }

    /* Authenticate a user to the system
     *
     * @param Array $credentials
     *
     * @return reply object
     */

    public function authenticate(array $credentials)
    {
        try{

             if( $user = Sentinel::authenticate($credentials) ){
                return new SuccessReply($user);
             }else{
                $message = 'Sorry your email or password is incorrect. Please try again.';
                return new FailedReply($message);
             }

        }catch(NotActivatedException $e){
			return new FailedReply($e->getMessage());

        }catch (ThrottlingException $e){
			$delay = $e->getDelay();
            return new FailedReply($e->getMessage()." Delay {$delay} Seconds.");
		}



    }

     /* Check user logged in or not
     *
     * @param no
     *
     * @return reply object
     */

    public function check()
    {
       if(Sentinel::guest()) return false;
       else return true;
    }

    /* * *
     * Check an User exist or not
     * @param bool $id
     *
     * @return bool
     */

    public function userExist($id){
        $user = $this->findById($id);

        if($user) return true;
        else return false;
    }


    public function authenticateAndRemember(array $credentials)
    {
        return Sentinel::authenticateAndRemember($credentials);
    }


    public function getUser()
    {
        return Sentinel::getUser();
    }

    /* * *
     * Get All users from user table
     *
     * @return user data collection
    */
    public function getAllUser()
    {
        return Sentinel::getUserRepository()->get();
    }


    public function findById($id)
    {
        return Sentinel::findById($id);
    }

    public function findRoleByID($id)
    {
        return Sentinel::findRoleByID($id);
    }

    public function findRoleByName($name)
    {
        return Sentinel::findRoleByName($name);
    }

    public function findUserById($id)
    {
        return Sentinel::findUserById($id);
    }


    public function logout()
    {
        //Sentinel::disableCheckpoints();
        session()->forget(['user_branch_id']);
        return Sentinel::logout(null, true);
    }

    public function update($user, array $credentials)
    {
        return Sentinel::update($user, $credentials);
    }

    public function disableCheckpoints()
    {
        return Sentinel::disableCheckpoints();
    }

    public function guest()
    {
        return Sentinel::guest();
    }

    //permissions
    public function hasAccess($routes)
    {
        return Sentinel::hasAccess($routes);
    }

    public function hasAnyAccess($routes)
    {
        return Sentinel::hasAnyAccess($routes);
    }



    // activation
    public function createActivation($userInfo)
    {
        return Activation::create($userInfo);
    }
    public function completeActivation($userInfo, $code)
    {
        return Activation::complete($userInfo, $code);
    }

    public function removeExpiredActivation()
    {
        return Activation::removeExpired();
    }

    /* * *
     * Activate and Deactivate a user
     * @params int $userID
     * @param bool $status
     *
     * @return DB query
    */
    public function activateDeactivate($userId, $status){

        $activation = DB::table('activations')->where('user_id', $userId)->first();

        if( !$activation ){
            $user = $this->findById($userId);
            $this->createActivation($user);
        }

        $data = ['completed' => $status, 'completed_at' => $status ? date('Y-m-d H:i:s') : NULL ];

        return DB::table('activations')
                    ->where('user_id', $userId)->update($data);
    }



    //reminder

    public function reminder($userInfo)
    {
        return Reminder::create($userInfo);
    }





    /* * *
     * resetPassword()
     * @param $user, $code, $newPassword
     * @return boolean
     */
    public function resetPassword($user, $code, $newPassword){
        return Reminder::complete($user, $code, $newPassword);
    }

    /* * *
     * removeExpired() remove expired password codes.
     * @return void
     */
    public function removeExpired(){
        return Reminder::removeExpired();
    }


    /* * *
     * Create profile for an user
     * @param Array $profileInfo - User profile info
     *
     * @return bool
     */

    public function createProfile( $profileInfo ){
        return Profile::create($profileInfo);
    }

    /* * *
     * Create profile for an user
     * @param Array $profileInfo - User profile info
     *
     * @return Model Instance or Null
     */

    public function userProfile(){
        $userId = $this->getUser()->id;
        return Profile::where(['p_uid' => $userId ])->first();
    }
}
