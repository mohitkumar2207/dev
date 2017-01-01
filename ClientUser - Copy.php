<?php
App::uses('AppModel', 'Model');

class ClientUser extends AppModel {
	public $name = 'ClientUser'; 
	public $primaryKey = 'id_client_user';
        
	public $belongsTo = array(
	'User' => array(
		'className' => 'User',
		'foreignKey' => 'id_user',
	 ),
	 /*'ProgramChampion' => array(
		'className' => 'ProgramChampion',
		'foreignKey' => 'id_client_user',
	 )*/
	 );
	
	public $hasMany = array(
	 'ProgramChampion' => array(
		'className' => 'ProgramChampion',
		'foreignKey' => 'id_client_user',
		 //'conditions' => array('ProgramChampion.id_client' => 'ClientUser.id_client'),
		)
	 );
	 
	/********* Get All Champions start  *******/
	
	public function admin_get_champions_json_data($requestData,$clientId)
	{
		$dbCondition			= 		array();
		$dbCondition['AND'][]	=		array('ClientUser.is_champion ='=>1);
		$dbCondition['AND'][]	=		array('ClientUser.id_Client ='=>$clientId);
		/*** Sort by column start */
		if(isset($requestData['order'][0]['column']) AND  $requestData['order'][0]['column'] == 0)
		{
			$orderFields  =  (isset($requestData['order'][0]['dir']) AND $requestData['order'][0]['dir'] == 'desc')?'User.status DESC':'User.status ASC';	
		}
		else if(isset($requestData['order'][0]['column']) AND  $requestData['order'][0]['column'] == 1)
		{
			$orderFields  =  (isset($requestData['order'][0]['dir']) AND $requestData['order'][0]['dir'] == 'desc')?'User.firstname DESC':'User.firstname ASC';	
		}
		else if(isset($requestData['order'][0]['column']) AND  $requestData['order'][0]['column'] == 2)
		{
			$orderFields  =  (isset($requestData['order'][0]['dir']) AND $requestData['order'][0]['dir'] == 'desc')?'User.lastname DESC':'User.lastname ASC';	
		}
		else if(isset($requestData['order'][0]['column']) AND  $requestData['order'][0]['column'] == 3)
		{
			$orderFields  =  (isset($requestData['order'][0]['dir']) AND $requestData['order'][0]['dir'] == 'desc')?'User.email DESC':'User.email ASC';
		}
		else if(isset($requestData['order'][0]['column']) AND  $requestData['order'][0]['column'] == 4)
		{
			$orderFields  =  (isset($requestData['order'][0]['dir']) AND $requestData['order'][0]['dir'] == 'desc')?'User.phone DESC':'User.phone ASC';
		}
		else if(isset($requestData['order'][0]['column']) AND  $requestData['order'][0]['column'] == 5)
		{
			$orderFields  =  (isset($requestData['order'][0]['dir']) AND $requestData['order'][0]['dir'] == 'desc')?'User.created_date  DESC':'User.created_date  ASC';
		}
		else
		{
			$orderFields  	= 'User.lastname DESC';
		}
		/*** Sort by column end */
		
		/* Search end */
		
		if(!empty($requestData['columns'][0]['search']['value']) )
		{
			$text = 'inactive';
			$columnStatus = 0;
			$status = 0;
			if(substr_count($text, strtolower($requestData['columns'][0]['search']['value'])) > 0)
			{
				$status = 1;
				$columnStatus = 1;
			}
			
			$text = 'suspended';
			if(substr_count($text, strtolower($requestData['columns'][0]['search']['value'])) > 0)
			{
				$status = 0;
				$columnStatus = 1;
			}
			
			if($columnStatus == 0)
			{
				$dbCondition['AND'][] = array('ClientUser.status ='=>4);
			}
			$dbCondition['AND'][] = array('ClientUser.status ='=>$status);
		}
		if( !empty($requestData['columns'][1]['search']['value']) )
		{	                 
			$dbCondition['AND'][] = array('User.firstname  LIKE'=>'%'.$requestData['columns'][1]['search']['value'].'%');
		}
		if(!empty($requestData['columns'][2]['search']['value']) )
		{
			$dbCondition['AND'][] = array('User.lastname  LIKE'=>'%'.$requestData['columns'][2]['search']['value'].'%');
		}
		if(!empty($requestData['columns'][3]['search']['value']) )
		{
			$dbCondition['AND'][] = array('User.email  LIKE'=>'%'.$requestData['columns'][3]['search']['value'].'%');
		}
		if(!empty($requestData['columns'][4]['search']['value']) )
		{
			$dbCondition['AND'][] = array('User.phone  LIKE'=>'%'.$requestData['columns'][4]['search']['value'].'%');
		}
		if(!empty($requestData['columns'][5]['search']['value']) )
		{
			$dbCondition['AND'][] = array('User.created_date  LIKE'=>'%'.date('Y-m-d',strtotime($requestData['columns'][5]['search']['value'])).'%');
		}
		/* Search end */
		$totalData  		= 	$this->find('count',array('conditions'=>$dbCondition)); 
		$totalFiltered 		= 	$totalData; 
		$dataStore			= 	$this->find('all', array('conditions'=>$dbCondition,'order'=>$orderFields,'offset'=>$requestData['start'],'limit'=>$requestData['length']));
		//print_r($dataStore);die;
		$data = array();   
		/*$programChampion = array();
		
		$Champion 				= 		ClassRegistry::init('ProgramChampion');
		$allChampionOfClient	= 		$Champion->find('all', array('conditions' => array('ProgramChampion.id_client' => $clientId),'group' => 'ProgramChampion.id_program')); 
	
		if(count($allChampionOfClient) > 0)
		{
			foreach($allChampionOfClient as $key=>$value)
			{
				//print_r($value);die;
				$totalOfchampion1[$value['ProgramChampion']['id_client_user']] 		= 	$Champion->find('count', array('conditions' => array('ProgramChampion.id_program' =>$value['ProgramChampion']['id_program'],'ProgramChampion.id_client' =>$value['ProgramChampion']['id_client'])));
			}
		}*/
		$Champion 				= 		ClassRegistry::init('ProgramChampion');
		$programChampion1 		= 	$Champion->find('all', array('conditions' => array('ProgramChampion.id_client' => $clientId),'fields' => array('ProgramChampion.id_user','ProgramChampion.id_program','ProgramChampion.id_client'))); 
		
		foreach($programChampion1 as $key=>$value2)
		{
			$totalOfchampion[$value2['ProgramChampion']['id_user']][] 	= 	$Champion->find('count', array('conditions' => array('ProgramChampion.id_client' => $value2['ProgramChampion']['id_client'],'ProgramChampion.id_program' => $value2['ProgramChampion']['id_program'],'ClientUser.status' => 1)));
		}
		
		//print_r($totalOfchampion);die;
		
		foreach($dataStore AS $key=>$val)
		{
			if(isset($totalOfchampion[$val['ClientUser']['id_user']]) AND in_array(1,$totalOfchampion[$val['ClientUser']['id_user']]) OR count($dataStore) == 1)
			{
				$suspend 	= '.cannotSuspendAction'; 
				$status		= 'Suspend';
				$popupclass = '.cannotDeleteChampionAlert';
			}
			else
			{
				$suspend 	= '.SuspendAction'; 
				$status		= 'Suspend';	
				$popupclass = '.deleteChampionAction';
			}
			
			if($val['ClientUser']['status'] == 0)
			{
				$suspend 	= '.SuspendAction'; 
				$status		= 	'Unsuspend';
				$popupclass = '.deleteChampionAction';
			}
			
			
			/*if(isset($totalOfchampion1[$val['ClientUser']['id_client_user']]))
			{
				if($totalOfchampion1[$val['ClientUser']['id_client_user']] == 1)
				{
					$suspend 	= '.cannotSuspendAction'; 
					$status		= 'Suspend';
					$popupclass = '.cannotDeleteChampionAlert';
				}
				else if($totalOfchampion1[$val['ClientUser']['id_client_user']] > 1)
				{
					$suspend 	= '.SuspendAction'; 
					$status		= 'Suspend';	
					$popupclass = '.deleteChampionAction';
				}
				else if($totalOfchampion1[$val['ClientUser']['id_client_user']] == 0)
				{
					$suspend 	= '.SuspendAction'; 
					$status		= 'Suspend';	
					$popupclass = '.deleteChampionAction';
				}
				else
				{
					if($val['ClientUser']['status'] == 0)
					{
						$suspend 	= '.SuspendAction'; 
						$status		= 	'Unsuspend';
						$popupclass = '.deleteChampionAction';
					}
				}	
			}	
			else
			{
				$suspend 		= '.SuspendAction'; 
				$status			= 	($val['ClientUser']['status'] == 1)?'Suspend':'Unsuspend';
				$popupclass 	= '.deleteChampionAction';
			}*/
			
			
			//print_r($programChampion);die;
			$nestedData   	=	array(); 
			$nestedData[] 	= 	((isset($val['ClientUser']['status']) AND $val['ClientUser']['status'] == 1)?'Inactive':"Suspended");
			$nestedData[] 	= 	$val['User']['firstname'];
			$nestedData[] 	= 	$val['User']['lastname'];
			$nestedData[] 	= 	$val['User']['email'];
			$nestedData[] 	= 	(isset($val['User']['phone']) AND $val['User']['phone'] != "")?$val['User']['phone']:"NA";
			$nestedData[] 	= 	date('d/m/Y',strtotime($val['User']['created_date']));
			$nestedData[] 	= 	0;
			//$popupclass 	= 	(count($dataStore) != 1)?'.deleteChampionAction':'.deleteChampionAction';
			//$status			= 	($val['ClientUser']['status'] == 1)?'Suspend':'Unsuspend';
			$class 			= 	(count($dataStore) != 1)?'trash':'trash';
			$nestedData[] 	= 	'<div class="btns-grp"><a href="javascript:void(0);" data-toggle="modal" data-target=".skilsAction" class="editChampion btn btn-sm btn-success btn-mWidth" rel="'.$val['User']['id_user'].','.$val['User']['firstname'].','.$val['User']['lastname'].','.$val['User']['email'].','.$val['User']['phone'].','.$val['ClientUser']['id_client_user'].'" > Edit</a>'.
			
			'<a href="javascript:void(0);" data-toggle="modal" data-target="'.$suspend.'"  class="'.$status.' btn btn-sm btn-default btn-mWidth" rel="'.$val['ClientUser']['id_client_user'].'">'.$status.'</a>'.
			
			
			'<a href="javascript:void(0);" data-toggle="modal" data-target="'.$popupclass.'"  class="'.$class.' btn btn-sm btn-danger btn-mWidth" rel="'.$val['ClientUser']['id_client_user'].'"> Delete</a></div>';
			
			
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
	/********* Get All Champions start  *******/
	
	/********* Suspend/Unsupend champion User start *******/
	
	public function SuspendUnsupendUser($post)
	{
		$resultData = 	$this->find('first', array('conditions'=> array('ClientUser.id_client_user'=>$post['ClientUser']['id_client_user']),'fields' => array('ClientUser.id_user','ClientUser.id_client')));
		$Champion 				= 		ClassRegistry::init('ProgramChampion');
		$programChampion1 		= 		$Champion->find('all', array('conditions' => array('ProgramChampion.id_client' => $resultData['ClientUser']['id_client']),'fields' => array('ProgramChampion.id_user','ProgramChampion.id_program','ProgramChampion.id_client'))); 
		
		foreach($programChampion1 as $key=>$value2)
		{
			$totalOfchampion[$value2['ProgramChampion']['id_user']][] 	= 	$Champion->find('count', array('conditions' => array('ProgramChampion.id_client' => $value2['ProgramChampion']['id_client'],'ProgramChampion.id_program' => $value2['ProgramChampion']['id_program'],'ClientUser.status' => 1)));
		}
		
		if(isset($totalOfchampion[$resultData['ClientUser']['id_user']]) AND in_array(1,$totalOfchampion[$resultData['ClientUser']['id_user']]))
		{
			return $message = "notAllowSuspend";	
		}
		else
		{
			if($post['ClientUser']['mode'] == 'suspended')
			{
				$post['ClientUser']['status'] 	=	 0;	
			}
			else if($post['ClientUser']['mode'] == 'unsuspend')
			{
				if(isset($post['User']['inactive']) AND $post['User']['inactive'] == "inactiveState")
				{
					$post['ClientUser']['archive_status'] 	= 	0;
				}
				else
				{
					$post['ClientUser']['archive_status'] 	= 	1;	
				}
				$post['ClientUser']['status'] 		= 	1;
			}
			$this->primaryKey 		= 		'id_client_user';
			if($this->save($post)){ return $post['ClientUser']['mode'];}else{ return 'error';}
		}	
	}
	
	/********* Suspend/Unsupend champion User end *******/
	
	/********* Delete Company champion start *******/
	
	public function deleteCompanyChampion($id,$userType)
	{
		$this->primaryKey 		= 		'id_client_user';
		if($this->delete($id)){ return true;}else{ return false;}
	}
	
	/********* Delete Company champion start *******/
	
	public function getProgramChampion($programId,$id_client)
	{
		$Champion 			= 		ClassRegistry::init('ProgramChampion');
		$programChampion 	= 		$Champion->find('list', array('conditions' => array('ProgramChampion.id_program' => $programId),'fields' => array('ProgramChampion.id_user'))); 
		
		$dbCondition['AND'][] = array('ClientUser.id_user NOT' => $programChampion);
		$dbCondition['AND'][] = array('ClientUser.is_champion'=>1);
		$dbCondition['AND'][] = array('ClientUser.status'=>1);
		$dbCondition['AND'][] = array('ClientUser.id_client'=>$id_client);
		$resultData = 	$this->find('all', array('conditions'=>$dbCondition,'group' => '`ClientUser`.`id_user`'));
		return $resultData;
	}
	
	public function getFindProgramChampions($post)
	{
		$Champion 			= 		ClassRegistry::init('ProgramChampion');
		$programChampion 	= 		$Champion->find('list', array('conditions' => array('ProgramChampion.id_program' => $post['programId']),'fields' => array('ProgramChampion.id_user'))); 
		if($post['text'] != "")
		{
			$dbCondition['AND'][] = array('concat(User.firstname," ",User.lastname)   LIKE'=>'%'.$post['text'].'%');
			$dbCondition['AND'][] = array('ClientUser.id_user NOT' => $programChampion);
			$dbCondition['AND'][] = array('ClientUser.id_client'=>$post['clientId']);
			$dbCondition['AND'][] = array('ClientUser.status'=>1,'ClientUser.is_champion'=>1);
			return $resultData = $this->find('all', array('conditions' => $dbCondition,'order'=>'User.firstname','group' => '`ClientUser`.`id_user`'));
		}
		else
		{
			$dbCondition['AND'][] = array('ClientUser.id_user NOT' => $programChampion);
			$dbCondition['AND'][] = array('ClientUser.is_champion'=>1);
			$dbCondition['AND'][] = array('ClientUser.status'=>1);
			$dbCondition['AND'][] = array('ClientUser.id_client'=>$post['clientId']);
			$resultData = 	$this->find('all', array('conditions'=>$dbCondition,'order'=>'User.firstname','group' => '`ClientUser`.`id_user`'));
		}
		return $resultData;
	}
	
	/***************************** Suspend Program Champion ******************************/
	public function suspendProgramChampion($post)
	{
		$resultData = 	$this->find('first', array('conditions'=> array('ClientUser.id_client_user'=>$post['ClientUser']['id_client_user']),'fields' => array('ClientUser.id_user')));
		$Champion 				= 		ClassRegistry::init('ProgramChampion');
		$programChampion1 		= 		$Champion->find('all', array('conditions' => array('ProgramChampion.id_client' => $post['ClientUser']['id_client']),'fields' => array('ProgramChampion.id_user','ProgramChampion.id_program','ProgramChampion.id_client'))); 
		
		foreach($programChampion1 as $key=>$value2)
		{
			$totalOfchampion[$value2['ProgramChampion']['id_user']][] 	= 	$Champion->find('count', array('conditions' => array('ProgramChampion.id_client' => $value2['ProgramChampion']['id_client'],'ProgramChampion.id_program' => $value2['ProgramChampion']['id_program'],'ClientUser.status' => 1)));
		}
		
		if(isset($totalOfchampion[$resultData['ClientUser']['id_user']]) AND in_array(1,$totalOfchampion[$resultData['ClientUser']['id_user']]))
		{
			return $message = "notAllowSuspend";	
		}
		else
		{
			$post['ClientUser']['status']					=		0;
			$this->save($post);
			return $message = "success";
		}	
	}
	/***************************** uspend Program Champion End ******************************/
	
	/***************************** suspendProgram ******************************/
	public function unsuspendProgramChampion($post)
	{
		$post['ClientUser']['status']					=		1;
		$this->save($post);
	}
	/***************************** suspend Program End ******************************/
	
}
