<?php
/**
 * @author smaosa@strathmore.edu
 *
 */
namespace App\Traits;

use App\Restaurant;
use App\Role;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Auth\AuthenticationException;
use LdapRecord\Container;
trait LDAPService
{
    /**
     * @param $username
     * @param $password
     * @param bool $bindAsUser
     * @return bool
     * @throws AuthenticationException
     * @throws \LdapRecord\Auth\PasswordRequiredException
     * @throws \LdapRecord\Auth\UsernameRequiredException
     * @throws \LdapRecord\ConnectionException
     */
    public function auth($username, $password, $bindAsUser=true) {
        $conn = Container::getDefaultConnection();
        if ($conn) {
            \Log::info("COnnection Success");
        }
        if(intval($username)){
            $username = "STUDENTS\\".$username;
        }else{
            $username = "STRATHMORE\\".$username;
        }
        \Log::info("Logging in");
//        $user = $this->getStaffByUsername($username);
//        $user = \LdapRecord\Models\ActiveDirectory\User::where("username", "=", $username)->first();
//        return $user;
       if ($auth = $conn->auth()->attempt($username,$password,true)) {
           return $auth;
       } else {
           $message = $conn->getLdapConnection()->getDiagnosticMessage();
           throw new AuthenticationException("Login failed. Please check your credentials.");
       }
    }
    /**
     * @param $username
     * @param $password
     * @param bool $createIfNotExist
     * @return User|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     * @throws AuthenticationException
     * @throws GuzzleException
     * @throws \Throwable
     */
    public function ldapAuth($username, $password, $createIfNotExist=false) {
        $server = "ldap://".env('LDAP_SERVER','192.168.170.20');
        $ldapconn = ldap_connect($server, env('LDAP_PORT'));
        if(intval($username)){
            $user = "STUDENTS\\".$username;
        }else{
            $user = "STRATHMORE\\".$username;
        }
        \Log::info("LDAP CONN");
        \Log::info(collect($ldapconn));
        if (!$ldapconn) {
            throw  new \Exception("Connection to LDAP Server failed");
        }
        $ldapbind = @ldap_bind($ldapconn, $user , $password);
        \Log::info("LDAP BIND");
        \Log::info($ldapbind);
        if (!$ldapbind) {
            throw new AuthenticationException("You credentials are invalid.");
        }
        //Check locally:
        $user = User::where("username", '=', strtolower($username))->first();
        if (!$user) {
            if (!$createIfNotExist) {
                throw new AuthenticationException("The user does not exist in our system and could not be created.");
            }
            \DB::transaction(function() {

            });
            if (intval($username)) {
                /* User is a student */
                $user_obj = $this->getStudent($username);
                $student_role = $this->getOrCreateRole('Student');
                if ($user_obj) {
                    //Create the user
                    $user = new User();
                    $user->username     = $username;
                    $user->name         = $user_obj->studentNames;
                    $user->email        = $user_obj->email;
                    $user->last_name    = $user_obj->surname;
                    $user->first_name   = $user_obj->otherNames;
                    $user->defaultRestaurant()->associate(Restaurant::first());
                    $user->saveOrFail();
                    if ($student_role) {
                        $user->syncRoles([$student_role]);
                    }
                    return $user;
                } else {
                    throw new \Exception("User not found in the strathmore web service.");
                }
            } else {
                $user_obj = $this->getStaffByUsername($username);
                $staff_role = $this->getOrCreateRole('Staff');
                if ($user_obj) {
                    //Create the user
                    $user = new User();
                    $user->username     = strtolower($username);
                    $user->name         = $user_obj->names;
                    $user->last_name    = $user_obj->surname;
                    $user->first_name   = $user_obj->otherNames;
                    $user->email        = $user_obj->email;
                    $user->saveOrFail();
                    if ($staff_role) {
                        $user->syncRoles([$staff_role]);
                    }
                    return $user;
                } else {
                    throw new \Exception("User not found in the strathmore web service");
                }
            }
        }
        return $user;
    }

    /**
     * @param $username
     * @return mixed
     * @throws GuzzleException
     */
    public function getStaffByUsername($username) {
        $wsurl = env("WEBSERVICE_BASEURL");
        $client = new Client();
        $res = $client->request("GET", $wsurl.'/staff/getStaffByUsername/'.$username, [
            "headers" => [
                "Accept" => "application/json",
                "Content-type" => "application/json"
            ]]);

        return json_decode($res->getBody()->getContents());
    }

    /**
     * @param $student_no
     * @return mixed
     * @throws GuzzleException
     */
    public function getStudent($student_no) {
        $wsurl = env("WEBSERVICE_BASEURL");
        $client = new Client();
        $res = $client->request("GET", $wsurl.'/student/getStudent/'.$student_no, [
            "headers" => [
                "Accept" => "application/json",
                "Content-type" => "application/json"
            ]]);
        return json_decode($res->getBody()->getContents());
    }

    /**
     * @param $name
     * @return Role|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     * @throws \Throwable
     */
    protected function getOrCreateRole($name) {
        $role = Role::where("name", "LIKE",$name)->first();
        if (!$role) {
            $role = new Role();

            $role->name = $name;
            $role->guard_name = "web";
            $role->saveOrFail();
        }
        return $role;
    }
}
