<?php namespace App\Replies;

interface ReplyInterface {
    
    /* * 
     * @return boolean 
     */

    public function hasFailed();
    
    /* * 
     * @return mixed 
     */
    
     public function getReply();

}