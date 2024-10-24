<?php 

/**
 * home class
 */
class Author
{
	use Controller;

	public function index()
	{

        $data = [];
		$this->view('author',$data);
	}

}