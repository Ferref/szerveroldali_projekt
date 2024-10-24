<?php 

/**
 * home class
 */
class Book
{
	use Controller;

	public function index()
	{

        $data = [];
		$this->view('book',$data);
	}

}