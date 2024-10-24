<?php 

/**
 * home class
 */
class Registration
{
	use Controller;

	public function index()
	{

        $data = [];
		$this->view('registration',$data);
	}

}