<?php
class Images extends CI_Controller {
	
	/*
	 * Here's the deal: If I end up hosting this, images will be the death of it all.
	 * Users love uploading images. Profile images, galleries, preview images, tons
	 * of bullshit-nobody-cares-about-photo-of-my-grandson-shitting-on-his-trike images.
	 * And saying "go upload your images there and then put the link here" just isn't
	 * user-friendly. So with this set up, they upload their images to this app,
	 * this app uploads them to imgur, and saves the imgur data, and deletes the iamge
	 * from the server.
	 * Then, when a URL like so: http://192.168.0.13/community/index.php/images/index/jbbtk.png
	 * is called, the function below happens. Which just displays the imgur file
	 * on a local page, whilst also being embeddable.
	 */
	public function index()
	{
		$this->load->model('myaccount_model','myaccount');
		$hash = substr($this->uri->segment('3'),0,5);
		$data = $this->myaccount->parse_photo($hash);
		$type = str_replace('image/','', $data['type']);
		$path = 'http://imgur.com/'.$data['hash'].'.'.$type;
		echo file_get_contents($path); 
		header('content-type: image/jpg');
	}
	
}