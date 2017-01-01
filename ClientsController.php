<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property AclComponent $Acl
 * @property AuthComponent $Auth
 * @property SessionComponent $Session
 */
class ClientsController extends AppController
{
	/**
	 * Helpers
	 *
	 * @var array
	 */
	public $uses = array('User','Client','ClientUser');
	
	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator', 'Session', 'Email');
        
	/**
	 * beforeFilter method
	 *
	 * @return void
	 */
	public function beforeFilter()
	{
		parent::beforeFilter();
		// Allow only the view and index actions.
		 
	}
	/***
	 *Function : Home
	 * get all the users list(active deactive both)
	 * 
	 ***/
	public function admin_index()
	{
		$this->layout = "admin_layout";
		$this->set('title_for_layout', 'Clients');
		//if user already loged-in re-direct to welcome page
	}
	
	/* Get business data and column sorting start */	
	public function admin_get_clients_json_data()
	{
		$requestData   = $_REQUEST;
		$this->Client->admin_get_clients_json_data($requestData);
	}
	
	/* Create company and edit start */	
	public function admin_addEditCompany()
	{
		if ($this->request->is('post')) 
		{
			$post = $this->request->data; 
			$clientid = $this->Client->saveClientData($post);
			$msg = (isset($post['Client']['id_client'])  AND $post['Client']['id_client']  != "")?"Changes are saved.":'Client has been added successfully.';
			 $this->Session->setFlash(__($msg), 'default', array('class' => 'alert alert-success text-center error'));
			//return $this->redirect($this->referer()); 
			return $this->redirect(array('controller' => 'clients','action' => 'general',$clientid,'admin'=>true));
		}
	}
	/* Create company and edit end */	
	
	public function admin_general($id = null)
	{
		$this->layout 	= 	"admin_layout";
		$clientData 	= 	$this->Client->getClientInformation($id);
		$clientId 		= 	(isset($clientData['Client']['id_client'])?ucfirst($clientData['Client']['id_client']):"");
		$this->set('clientId',$clientId);
		$this->set('title_for_layout', 'Clients General');
		$this->set(compact('clientData'));
	}
	
	/*Show champions and add edit */
	public function admin_champions($id = null)
	{
		$this->layout = "admin_layout";
		$this->set('title_for_layout', 'Clients Champions');
		$this->set('title_for_layout', 'Clients General');
		$clientData = $this->Client->getClientInformation($id);
		if ($this->request->is('post')) 
		{
			
			if ($this->User->validates()) 
			{
				$post 				= 	$this->request->data;
				$userId 			=	(isset($post['User']['id_user'])?$post['User']['id_user']:"");
				$email 				=	$this->request->data['User']['email'];		
				
				if(isset($userId) AND $userId != "")
				{
					$getUserInfo	=	$this->getUserInfo($userId);
					if($post['User']['email'] != $getUserInfo['User']['email'])
					{
						$this->sendEmail('championAccountChanged',$getUserInfo['User']['email'],'champion_account_changed');
					}
				}
				
				$return 		=	$this->User->addEditchampions($post);
				
				if($return 	== 'create')
				{
					$checkChampionNew	= $this->checkEmailExists($email);
					if(isset($checkChampionNew['ClientUser']) AND count($checkChampionNew['ClientUser']) == 1 AND $checkChampionNew['User']['is_admin'] != 1)
					{
						$this->sendEmail('championAdd',$post['User']['email'],'create_champions_password_by_admin');
					}
					else
					{
						
					}	
					$this->Session->setFlash(__('Champion account is created in the system.'), 'default', array(
						'class' => 'alert alert-success text-center'));
				}	
				elseif($return == 'edit')
				{
					if($post['User']['email'] != $getUserInfo['User']['email'])
					{
						$this->sendEmail('championAccountUpdated',$post['User']['email'],'champion_update_account');
					}	
					$this->Session->setFlash(__('Changes are saved'), 'default', array(
					'class' => 'alert alert-success text-center'));
				}
				else
				{
					$this->Session->setFlash(__('Please try again!'), 'default', array(
					'class' => 'alert alert-success text-center'));
				}
				$clientId = (isset($this->request->data['User']['id_client'])?$this->request->data['User']['id_client']:"");
				return $this->redirect(array('controller' => 'clients','action' => 'champions',$clientId,'admin'=>true));
			}
		}
		$this->set(compact('clientData'));
	}	
	/*Show champions and add edit end*/
	
	/*Show participants and add edit end*/
	public function admin_participants($id = null)
	{
		$this->layout 		= "admin_layout";
		$clientData 		= $this->Client->getClientInformation($id);
		$clientId 			= (isset($clientData['Client']['id_client'])?ucfirst($clientData['Client']['id_client']):"");
		$archivedChecked 	= (isset($this->params->pass[1]) AND $this->params->pass[1] == 'archive')?'archive':"";
		$this->set('clientId',$clientId);
		$this->set('archivedChecked',$archivedChecked);
		$this->set(compact('clientData'));
		$this->set('title_for_layout', 'Clients Participants');
	}
	/*Show champions and add edit end*/
	
	/*Get champions Listing start*/
	function admin_get_champions_json_data($clientId = null)
	{
		$requestData   = $_REQUEST;
		$this->ClientUser->admin_get_champions_json_data($requestData,$clientId);
	}
	/*Get champions Listing end*/
	
	/*Get champions Listing start*/
	function admin_get_participants_json_data($clientId = null,$archive = null)
	{
		$requestData   = $_REQUEST;
		$this->User->admin_get_participants_json_data($requestData,$clientId,$archive);
	}
	/*Get champions Listing end*/
	
	/* Delete champion*/
	public function admin_deleteChampionUser()
	{
		$champId  	= 	$this->request->data['User']['id_champion'];
		$return 	= 	$this->ClientUser->deleteCompanyChampion($champId,'champion');
		if($return == true)
		{
			 $this->Session->setFlash(__('The Champion account is deleted from the system.'), 'default', array('class' => 'alert alert-success text-center success'));
		}
		else
		{
			$this->Session->setFlash(__('Please try again!.'), 'default', array('class' => 'alert alert-danger text-center error'));
		}
		return $this->redirect($this->referer()); 
	}
	/* Delete champion end*/
	
	/* Suspened/Unsuspened champion end*/
	public function admin_SuspendUnsupendChampionUser()
	{
		$post   = 	$this->request->data;
		$return = $this->ClientUser->SuspendUnsupendUser($post);
		if($return == 'notAllowSuspend')
		{
			$this->Session->setFlash(__('You cannot suspend this champion because they are the only champion assigned to the following programs.'), 'default', array('class' => 'alert alert-success text-center error'));
		}
		else if($return == 'suspended')
		{
			 $this->Session->setFlash(__('The Champion account is suspended from the system.'), 'default', array('class' => 'alert alert-success text-center success'));
		}
		elseif($return == 'unsuspend')
		{
			$this->Session->setFlash(__('The Champion account is unsuspended from the system..'), 'default', array('class' => 'alert alert-success text-center error'));
		}
		return $this->redirect($this->referer()); 
	}
	/* Suspened/Unsuspened champion end*/
	
	/*Export champions data*/
	public function admin_exportChampionsUsingCSV($clientid = null)
	{
		$this->User->exportUsersUsingCSV('champions',$clientid);	
	}
	/*Export champions data*/
	
	/*Export champions data*/
	public function admin_exportChampionsUsingXLS($clientid = null)
	{
		$this->User->exportUsersUsingXLS('champions',$clientid);	
	}
	/*Export champions data*/
	
	
	/* Suspened/Unsuspened Paricipant start*/
	public function admin_SuspendUnsupendParticipant()
	{
		$post   	= 	$this->request->data;
		$return 	= 	$this->User->SuspendUnsupendUser($post);
		if($return == 'suspended')
		{
			 $this->Session->setFlash(__('The Paricipant account is suspended from the system.'), 'default', array('class' => 'alert alert-success text-center success'));
		}
		elseif($return == 'unsuspend')
		{
			$this->Session->setFlash(__('The Paricipant account is unsuspended from the system..'), 'default', array('class' => 'alert alert-success text-center error'));
		}
		return $this->redirect($this->referer()); 
	}
	/* Suspened/Unsuspened Paricipant end*/
	
	/* Delete Participant*/
	public function admin_deleteParticipantUser()
	{
		$participantId   = 	$this->request->data['User']['id_user'];
		$clientId   	 = 	(isset($this->request->data['User']['id_client'])?$this->request->data['User']['id_client']:"");
		$return = $this->User->deleteUser($participantId,'Participant');
		if($return == true)
		{
			 $this->Session->setFlash(__('The Participant account is deleted from the system.'), 'default', array('class' => 'alert alert-success text-center success'));
		}
		else
		{
			$this->Session->setFlash(__('Please try again!.'), 'default', array('class' => 'alert alert-danger text-center error'));
		}
		return $this->redirect($this->referer()); 
		//return $this->redirect(array('controller' => 'clients','action' => 'participants',$clientId,'admin'=>true));
	}
	/* Delete champion end*/
	
	/*Export champions data*/
	public function admin_exportParticipantsUsingCSV($clientid = null)
	{
		$this->User->exportUsersUsingCSV('participants',$clientid);	
		return $this->redirect($this->referer()); 
	}
	/*Export champions data*/
	
	/*Export champions data*/
	public function admin_exportParticipantsUsingXLS($clientid = null)
	{
		$this->User->exportUsersUsingXLS('participants',$clientid);	
		return $this->redirect($this->referer()); 
	}
	/*Export champions data*/
	
	/*ArchiveParticipant start*/
	public function admin_archiveParticipant()
	{
		$post = $this->request->data;
		$return = $this->User->archiveUser($post,'participants');	
		if($return == 'archive')
		{
			$this->Session->setFlash(__('The Paricipant account is unarchive from the system..'), 'default', array('class' => 'alert alert-success text-center error'));
		}
		elseif($return == 'unarchive')
		{
			 $this->Session->setFlash(__('The Paricipant account is archive from the system.'), 'default', array('class' => 'alert alert-success text-center success'));
			
		}
		return $this->redirect($this->referer()); 
	}
	/*ArchiveParticipant end*/
	
	
	/*	participant detail start	*/
	public function admin_participantdetail($id_client = null,$id_participant = null)
	{
		$userDetail			=	$this->getUserInfo($id_participant);
		$userCurrentStatus 	=	$this->userCurrentStatus($userDetail);
		$this->layout = "admin_layout";
		$this->set('title_for_layout', 'Participant Detail');
		$clientData = $this->Client->getClientInformation($id_client);
		$clientId 	= (isset($clientData['Client']['id_client'])?ucfirst($clientData['Client']['id_client']):"");
		$this->set(compact('userCurrentStatus'));
		$this->set('clientId',$clientId);
		$this->set(compact('clientData'));
		$this->set(compact('userDetail'));
	}
	/*	participant detail start	*/
	
	/*  Delete client from general page start*/
	public function admin_deleteClient()
	{
		$post = $this->request->data;
		$return = $this->User->deleteClient($post);	
		$this->Session->setFlash(__('Client and all of its associated data is deleted from the system.'), 'default', array('class' => 'alert alert-success text-center success'));
		return $this->redirect(array('controller' => 'clients','action' => 'index','admin'=>true));
	}	
	/*  Delete client from general page end*/
	
	/*Edit Participants (Page participant detail) */
	public function admin_editParticipant($id = null)
	{
		$this->layout = "admin_layout";
		$this->set('title_for_layout', 'Clients Participant');
		if ($this->request->is('post')) 
		{
			if ($this->User->validates()) 
			{
				$post 				= 	$this->request->data;
				$userId 			=	(isset($post['User']['id_user'])?$post['User']['id_user']:"");
				$email 				=	$this->request->data['User']['email'];
				if(isset($userId) AND $userId != "")
				{
					$getUserInfo	=	$this->getUserInfo($userId);
					if($post['User']['email'] != $getUserInfo['User']['email'])
					{
						$this->sendEmail('participantAccountChanged',$getUserInfo['User']['email'],'participant_account_changed');
					}
				}	
				$return 	=	$this->User->addEditParticpant($post);
				if($return == 'edit')
				{
					if($post['User']['email'] != $getUserInfo['User']['email'])
					{
						$this->sendEmail('participantAccountUpdated',$post['User']['email'],'participant_update_account');
					}	
					$this->Session->setFlash(__('Changes are saved'), 'default', array(
					'class' => 'alert alert-success text-center'));
				}
				else
				{
					$this->Session->setFlash(__('Please try again!'), 'default', array(
					'class' => 'alert alert-success text-center'));
				}
				return $this->redirect($this->referer()); 
			}
		}
		//$this->set(compact('clientData'));
	}	
	/*Show champions and add edit end*/
	
	public function admin_validateChampion()
	{
		$firstname 	= 	$this->request->data['User']['firstname'];
		$lastname 	= 	$this->request->data['User']['lastname'];
		$email 		=	$this->request->data['User']['email'];
		if($firstname != "" AND $lastname != "" AND $email != "")
		{
			echo $this->User->validateChampion($email);	
		}
		else
		{
			echo "Success";	
		}
		die;
	}
}
