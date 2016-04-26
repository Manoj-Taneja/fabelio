<?php
class OrganicInternet_SimpleConfigurableProducts_Helper_Data extends Mage_Core_Helper_Abstract {

  private function getVideoType($urlObj) {
    $host = @$urlObj['host'];
    if(!$host) return '';
    $hostS = preg_split('/\./', $host);
    if(count($hostS) < 3){
      return $host;
    }
    $hostS = array_slice($hostS, -2, -1);
    return $hostS[0];
  }

  private function getVimeoEmbed($urlObj) {
    $path = array_filter(split('/', $urlObj['path']));
    $id = $path[0];
    if(!$id) return '';
    return '<iframe src="https://player.vimeo.com/video/'.$id.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
  }

  private function getYoutubeEmbed($urlObj) {
    parse_str($urlObj['query'], $id);
    $id = trim($id['v']);
    if(!$id) return '';
    return '<iframe src="https://www.youtube.com/embed/' . $id . '?rel=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
  }

  private function getVimeoThumb($urlObj) {
    $path = array_filter(split('/', $urlObj['path']));
    $id = $path[0];
    if(!$id) return '';
    try {
      $videoJson = json_decode(file_get_contents('https://vimeo.com/api/v2/video/'.$id.'.json'), true);
    } catch(Exception $e) {
      return '';
    }
    return $videoJson[0]['thumbnail_medium'];
  }

  private function getYoutubeThumb($urlObj) {
    parse_str($urlObj['query'], $id);
    $id = trim($id['v']);
    if(!$id) return '';
    return 'http://img.youtube.com/vi/'.$id.'/default.jpg';
  }

  private function parseVideo($url) {
    $urlObj = parse_url($url);
    $videoType = $this->getVideoType($urlObj);
    $result = Array(
      'type' => $videoType,
    );
    switch($videoType){
      case 'youtube':
        $result['embed'] = $this->getYoutubeEmbed($urlObj);
        $result['thumb'] = $this->getYoutubeThumb($urlObj);
        break;
      case 'vimeo':
        $result['embed'] = $this->getVimeoEmbed($urlObj);
        $result['thumb'] = $this->getVimeoThumb($urlObj);
        break;
    }
    return $result;
  }

  public function parseVideos($urls) {
    $urls = array_filter(explode("\n", $urls));
    $result = Array();
    forEach($urls as $url) {
      $result[] = $this->parseVideo($url);
    }
    return $result;
  }

}
