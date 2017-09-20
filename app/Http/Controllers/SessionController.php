<?php
namespace carsadmin\Http\Controllers;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class SessionController extends Controller {

    /**
     * this return string jwt token (login)
     * @return String
     */
    public function getToken() {
        // grab credentials from the request
        $credentials = $this->request->only('email', 'password');
        
        $all = $this->request->all();
    
        try {
            // attempt to verify the credentials and create a token for the current user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json('invalid_credentials', 401);
            }
        } catch (JWTException $e) {
            // error while attempting to encode token
            return response()->json('could_not_create_token', 500);
        }
        
        // all good, return the token
        $user = \Auth::user();
        unset($user->password);

        $res = compact('token');

        $res['user'] = $user; 

        if(isset($all['isclient']) && \Auth::user()->roles_id == 1){
            return response()->json('not_role', 401);
        }

        if(!isset($all['isclient']) && \Auth::user()->roles_id == 2){
            return response()->json('not_role', 401);
        }

        return response()->json($res);   
    }

    /**
     * this invalid jwt token (logout)
     * @return Boolean
     */
    public function invalidateToken() {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());    
            return $this->checkToken();        
        } catch(Exception $e){}
        return true;
    }

    /**
     * this return string with new jwt token (manual refresh)
     * @return String
     */
    public function refreshToken() {
        try{
            return ['token' => JWTAuth::refresh(JWTAuth::getToken())];
        }catch(TokenInvalidException $e){
            return ['token' => false];
        }
    }

    public function checkToken() {
        try {
            JWTAuth::parseToken()->authenticate();
            return ['token' => 'active' ];
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return ['token' => 'expired' ];      
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return ['token' => 'invalid' ];            
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return ['token' => 'not_present' ];                  
        }
    }
}
