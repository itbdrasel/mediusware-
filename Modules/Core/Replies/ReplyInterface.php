<?php namespace Modules\Core\Replies;

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
