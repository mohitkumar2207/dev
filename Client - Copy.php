<?php
App::uses('AppModel', 'Model');
/**
 * Client Model
 *
 */
class Client extends AppModel 
{
	/**
	 * Display field
	 *
	 * @var string
	 */
	 
	public $name = 'Client'; 
	public $primaryKey = 'id_client';
	
	public function createCompanyValidate() 
	{
		if(!isset($this->data['Client']['indexed']))
		{
			$this->data['Client']['indexed'] = '';
		}
		$validate1 = array(
			'name' => array(
				'required' => array(
					'rule' => array('required', 'name'),
					'message' => 'This field is required.'
				),
				'between' => array(
					'rule'      => array('between', 1, 30),
					'message' => 'Maximum characters length is 30.'
				),
				'uniqueClientNameRule' => array(
					'rule'    => array('uniqueClientNameRule'),
					'message' => 'Please enter a unique client name.'
				)
			),
			'url' => array(
				'required' => array(
					'rule' => array('required', 'url'),
					'message' => 'This field is required.'
				),
				'between' => array(
					'rule'      => array('between', 1, 30),
					'message' => 'Maximum characters length is 30.'
				),
				'uniqueClientUrlRule' => array(
					'rule'    => array('uniqueClientUrlRule'),
					'message' => 'Special character not allowed..'
				),
				'uniqueClientUrlCheck' => array(
					'rule'    => array('uniqueClientUrlCheck'),
					'message' => 'This URL already exists.'
				)
			),
			'indexed' => array(
				'required' => array(
					'rule' => array('requiredIndex', 'indexed'),
					'message' => 'Please select whether this program site should be indexed'
				)
			)
		);
		$this->validate = $validate1;
		return $this->validates();
	}
	
	/* (Admin) validate login username and password end */
	
	/* Required  */	
	public function required($val, $field) 
	{
        if (empty(trim($val[$field])))
            return false;
        return true;
    }
	/* Required  */
	
	public function requiredIndex($val, $field)
	{
		if($val['indexed'] == "")
		{
			return false;
		}
		else
		{
			return true;	
		}
	}
	
	
	public function uniqueClientNameRule()
	{	
		if($this->data['Client']['mode'] == 'create')
		{
			return ($this->find('count', array('conditions' => array('Client.name' => trim($this->data['Client']['name'])))) == 0);
		}
		else if($this->data['Client']['mode'] == 'edit')
		{
			return ($this->find('count', array('conditions' => array('Client.name' => trim($this->data['Client']['name']),'Client.id_client !=' => $this->data['Client']['id_client']))) == 0);
		}	
	}
	
	public function uniqueClientUrlCheck()
	{	
		if($this->data['Client']['mode'] == 'create')
		{
			return ($this->find('count', array('conditions' => array('Client.url' => trim($this->data['Client']['url'])))) == 0);
		}
		else if($this->data['Client']['mode'] == 'edit')
		{
			return ($this->find('count', array('conditions' => array('Client.url' => trim($this->data['Client']['url']),'Client.id_client !=' => $this->data['Client']['id_client']))) == 0);
		}	
	}
	
	public function uniqueClientIndexRule()
	{	
		if($this->data['Client']['indexed'] == 2)
		{
			$this->invalidate('indexed', __('Please select whether this program site should be indexed.'));
			return false; 
		}
		else
		{
			return ($this->find('count', array('conditions' => array('Client.url' => trim($this->data['Client']['indexed'])))) == 0);
		}	
	}
	
	/* Check alphanumeric password start */
	function alphanumeric() 
	{	
		$containsLetter  = preg_match('/[A-Z]/', $this->data['User']['password']);
		$containsDigit   = preg_match('/\d/', $this->data['User']['password']);
		$containsSpecial = preg_match('/[^a-zA-Z\d]/', $this->data['User']['password']);
		$count = $containsLetter + $containsDigit + $containsSpecial;
		if($count >= '2') {
			return true;
		} else {
			return false;
		}
	}
	/* Check alphanumeric password start */
	
	public function uniqueClientUrlRule()
	{
		$containsSpecial = preg_match('/[^a-zA-Z\d-]/', $this->data['Client']['url']);
		$count = $containsSpecial;
		if($count == '0') 
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}
	
	/*Save Client data start*/
	public function saveClientData($post)
	{
		$post['Client']['added_by'] 			= 	CakeSession::read("Auth.User.id_user");
		$post['Client']['url'] 					=   $post['Client']['url'];
		$post['Client']['created_date']			= 	date("Y-m-d H:i:s");
		$post['Client']['last_modified_date']	= 	date("Y-m-d H:i:s");
		$post['Client']['status']				= 	1;
		$this->save($post);
		return $this->getLastInsertId();
	}
	/*Save Client data end*/
	
	public function admin_get_clients_json_data($requestData)
	{
		$dbCondition	= array();
		/*** Sort by column start */
		if(isset($requestData['order'][0]['column']) AND  $requestData['order'][0]['column'] == 0)
		{
			$orderFields  =  (isset($requestData['order'][0]['dir']) AND $requestData['order'][0]['dir'] == 'desc')?'Client.name DESC':'Client.name ASC';	
		}
		else if(isset($requestData['order'][0]['column']) AND  $requestData['order'][0]['column'] == 1)
		{
			$orderFields  =  (isset($requestData['order'][0]['dir']) AND $requestData['order'][0]['dir'] == 'desc')?'Client.created_date DESC':'Client.created_date ASC';
		}
		else
		{
			$orderFields  	= 'Client.name DESC';
		}
		/*** Sort by column end */
		
		/* Search end */
		
		if(!empty($requestData['columns'][0]['search']['value']))
		{
			$dbCondition['AND'] = array('concat(Client.name)   LIKE'=>'%'.$requestData['columns'][0]['search']['value'].'%');
		}
		if(!empty($requestData['columns'][1]['search']['value']))
		{	                 
			$dbCondition['AND'] = array('Client.created_date  LIKE'=>'%'.date('Y-m-d',strtotime($requestData['columns'][1]['search']['value'])).'%');
		}
		
		/* Search end */
		//print_r($dbCondition);die;
		$totalData  = $this->find('count',array('conditions'=>$dbCondition)); 
		$totalFiltered = $totalData; 
		$dataStore	= $this->find('all', array('conditions'=>$dbCondition,'order'=>$orderFields,'offset'=>$requestData['start'],'limit'=>$requestData['length']));
		$data = array();   
		foreach($dataStore AS $key=>$val)
		{	
			
			$nestedData   	=	array();
			$nestedData[] 	= 	$val['Client']['name'];
			$nestedData[] 	= 	date('d.m.Y',strtotime($val['Client']['created_date']))	;
			$nestedData[] 	= 	'10';
			$nestedData[] 	= 	'10';
			$nestedData[] 	= 	'<div class="btns-grp two-btns-grp"><a  href="'.$this->webroot.Router::url('/admin/clients/general/').$val['Client']['id_client'].'"  class="clientedit btn btn-sm btn-success btn-mWidth" > View</a>
			<a target="_blank" data-target="" data-toggle="modal" class="btn btn-sm btn-default btn-mWidth" href="'.$this->webroot.Router::url('/admin/clients/general/').$val['Client']['id_client'].'">Launch Portal</a></div>';
			$data[] 		= 	$nestedData;
		}
			
		$json_data  = array(
		"draw"=> intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
		"recordsTotal"    => intval($totalData),  // total number of records
		"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
		"data"            => $data   // total data array
		);
		echo json_encode($json_data);
		die();	
	}
	
	/*Get client information start */
	public function getClientInformation($id = null)
	{
		return $this->find('first',array('conditions'=>array('id_client'=>$id)));	
	}
	/*Get client information start */
	public function getAllClients()
	{
		$order = array('Client.name');
		return $this->find('all',array('conditions'=>array('status'=>1),'order'=>$order));	
	}
	/*Get client information start */
	
	
}
