<?php

/*
 * Abraham Williams (abraham@abrah.am) http://abrah.am
 *
 * The first PHP Library to support OAuth for Twitter's REST API.
 */

/* Load OAuth lib. You can find it at http://oauth.net */
// vim: foldmethod=marker

/* Generic exception class
 */
 
class Smartwave_Socialfeeds_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function file_get_contents_curl($url, $useragent = null) {
        $ch = curl_init($url);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($useragent)
            curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        
        $data = curl_exec($ch);
        curl_close($ch);
        
        return $data;
    }
    
    
    
    // get facebook config
    public function getFacebookConfig() 
    {
        $store = Mage::app()->getStore();
        $code  = $store->getCode();
        return Mage::getStoreConfig('socialfeeds/facebook', $code);
    }
        
    function getAttribute($attrib, $tag){
          //get attribute from html tag
          $re = '/'.$attrib.'=["\']?([^"\' ]*)["\' ]/is';
          preg_match($re, $tag, $match);
          
          if($match){
            return urldecode($match[1]);
          }else {
            return false;
          }
    }
    
    function fetch_fb_fans($fb_id, $limit = 10){
        
        $ret = array();
        $matches = array();
        $url = 'https://www.facebook.com/plugins/likebox.php?href=https://www.facebook.com/' . $fb_id . '&connections=' . $limit;
        
        $html = '';
        $like_html = $this->file_get_contents_curl($url, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:15.0) Gecko/20100101 Firefox/15.0.1');
        $doc = new DOMDocument('1.0', 'utf-8');
        @$doc->loadHTML('<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />' . $like_html);
        $peopleList = array();
        $i = 0;

        foreach ($doc->getElementsByTagName('ul')->item(0)->childNodes as $child) {
            $raw = $doc->saveXML($child);
            $li = preg_replace("/<li[^>]+\>/i", "", $raw);
            $peopleList[$i] = preg_replace("/<\/li>/i", "", $li);
            $i++;
        }
        
        foreach ($peopleList as $key => $code) {
            $name = $this->getAttribute('title', $code);
            $nm = substr($name, 0, 7);
            //print_r(strlen($nm));echo "\n";
            if (strlen($nm) != strlen($name)) $nm = $nm."...";

            $image = $this->getAttribute('src', $code);
            $link = $this->getAttribute('href', $code);

            //$data = file_get_contents($image);
            //$img_in_base64 = 'data:image/jpg;base64,' . base64_encode($data);
            $protocols = array("http:","https:"); 
            $img_in_base64 = str_replace($protocols, "", $image);

            $html .= '<div class="fb-person">';
            //if ($link != "") {
                $html .= "<a href=\"".$link."\" title=\"".$name."\" target=\"_blank\"><img src=\"".$img_in_base64."\" alt=\"\" />".$name."</a>";
            //} else {
           //     $html .= "<span title=\"".$name."\"></span>";
           // }
            $html .= '</div>';
        }
        return $html;
    }
    
    // get facebook fans
    public function getFBFans() {
        $fb = $this->getFacebookConfig();
        
        if (!$fb['enabled'])
            return false;
        
        $limit = $fb['show_counts'];
        $fb_name = $fb['name'];
        
        // get page info from graph
        $fanpage_data = (array)json_decode($this->file_get_contents_curl('http://graph.facebook.com/' . $fb_name));
        
        if(empty($fanpage_data['id'])){
            // invalid fanpage name
            return false;
        }
        $result = array();
        $result['profile'] = $fanpage_data;
        $result['fans'] = $this->fetch_fb_fans($fanpage_data['id'], $limit);
        $result['limit'] = $limit;
        
        return $result;
    }
    
   
}