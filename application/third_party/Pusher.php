<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pusher
{

  public function pusher()
  {
      require __DIR__ .'vendor/autoload.php';

    $options = array(
      'cluster' => 'ap2',
      'useTLS' => true
    );
    $pusher = new Pusher\Pusher(
      'e6256b34427ca9b29815',
      'e1a37e8c0910ae055d3b',
      '838370',
      $options
    );

    $data['message'] = 'hello world';
    $pusher->trigger('my-channel', 'my-event', $data);
  

  }
    
}