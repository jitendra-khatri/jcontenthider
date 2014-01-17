<?php
/**
* @copyright      
* @license        GNU/GPL, see LICENSE.php
* @contact        jkhatri6@gmail.com
* @author         Jitendra Khatri
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


/**
* Joomla Article Content Hider on Group basis
*/

class plgContentJContenthider extends JPlugin
{
    // Finds the tags        
    public function onContentPrepare($context, &$row, &$params, $page = 0)
    {
        // Admin-Area then no need to Process the plugin.
    	$app = JFactory::getApplication();
    	if($app->isAdmin()){
    		return true;
    	}

        if(is_object($row)) {
            // Check whether the plugin should process or not
            if ( JString::strpos( $row->text, 'jcontenthider' ) === false )
            {
                return true;
            }
            
            // Search for this tag in the content
            $regex = "#{jcontenthider(.*?)}(.*?){/jcontenthider}#s";
            
            $row->text = preg_replace_callback( $regex, array($this, 'process'), $row->text );
        }
        else
        {
            if ( JString::strpos( $row, 'jcontenthider' ) === false )
            {
                return true;
            }

            $regex = "#{jcontenthider(.*?)}(.*?){/jcontenthider}#s";
            $row = preg_replace_callback( $regex, array($this, 'process'), $row );
        }
        
        return true;
    }
    
    /**
     * preg_match callback to process each match
     */
    public function process($match)
    {
        $ret = '';
        $content_show = 'SHOW';
        $content_hide = 'HIDE';
        
        if(!isset($match[2])){
            return $ret;
        }
        
        $user_id 	= (!isset($this->user_id)) ? JFactory::getUser()->id : $this->user_id;
        $user 		= JUser::getInstance($user_id);
        $userGroups = JUserHelper:: getUserGroups($user_id);
        
        //For handling case of {jcontenthider}{/jcontenthider}
        if(empty($match[1])){
        	if($user_id !== false){
        		if(count($userGroups)>0){
        			return $match[2];
        		}
        	}
        	return $ret;
        }

        //Fetches Action: (HIDE or SHOW) from jcontenthider tag
        $restrictions = explode("=", $match[1]);
        $action = explode(" ", $restrictions[1]);
        
        //if action is HIDE then revert contents to show
        if(!empty($action[1]) && $action[1] === $content_hide){
            $temp = $match[2];
            $match[2] = $ret;
            $ret = $temp;
        }        
        if(!$user_id){
            return $ret;
        }

        //Fetches Group ids from {jcontenthider} tag
        $group_ids = isset($action[0]) ? explode(',', $action[0]) : array();
        if(!count($group_ids)){
            if(count($userGroups)>0){
                return $match[2];
            }
            
            return $ret;
        }
        
        //If user Group is in specified Group Ids then show content
        if(count(array_intersect($userGroups, $group_ids)) > 0){
            return $match[2];
        }
        
        return $ret;
    }
}