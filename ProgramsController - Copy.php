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
class ProgramsController extends AppController
{
	/**
	 * Helpers
	 *
	 * @var array
	 */
	public $helpers = array('Js','Popup');
	
	public $uses = array('User','Client','Program','ClientUser','ProgramResource','ProgramChampion','ProgramCommunication','Communication');
	
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
	 
	public function admin_ajax_validation_addEditProgram() {
        $this->autoRender = false;
       // echo $model;die;
        try {
            $model = 'Program';
            if (!isset($model) || empty($model)) {
                throw new exception('validation model not exists!');
            }

            if (!in_array($model, $this->uses)) {
                throw new exception('validation model not exists in models!');
            }

            if (!$this->request->is(array('post', 'put'))) {
                throw new exception('only post and put methods are allowed!');
            }

            $request = $this->request->data;

            $this->{$model}->set($request);

            if ($this->{$model}->ajax_validation_addEditProgram() === false) {
                return json_encode(array('validation' => 'false', 'exception' => 'validation failed!', 'view' => $model, 'errors' => $this->{$model}->validationErrors));
            } 
            else 
            {
              //return json_encode(array('validation' => 'true'));
              return json_encode(array('validation' => 'true'));
            }
        } catch (exception $ex) {
            return json_encode(array('validation' => 'false', 'exception' => $ex->getMessage(), 'errors' => ''));
        }
    }
    
    
    public function admin_ajax_validation_program_edit() 
    {
        $this->autoRender = false;
        try {
            $model = 'Program';
            if (!isset($model) || empty($model)) {
                throw new exception('validation model not exists!');
            }

            if (!in_array($model, $this->uses)) {
                throw new exception('validation model not exists in models!');
            }

            if (!$this->request->is(array('post', 'put'))) {
                throw new exception('only post and put methods are allowed!');
            }

            $request = $this->request->data;

            $this->{$model}->set($request);

            if ($this->{$model}->ajax_validation_program_edit() === false) {
                return json_encode(array('validation' => 'false', 'exception' => 'validation failed!', 'view' => $model, 'errors' => $this->{$model}->validationErrors));
            } 
            else 
            {
              //return json_encode(array('validation' => 'true'));
              return json_encode(array('validation' => 'true'));
            }
        } catch (exception $ex) {
            return json_encode(array('validation' => 'false', 'exception' => $ex->getMessage(), 'errors' => ''));
        }
    }
    
    
    public function admin_ajax_validation_program_resource() {
        $this->autoRender = false;
       // echo $model;die;
        try {
            $model = 'ProgramResource';
            if (!isset($model) || empty($model)) {
                throw new exception('validation model not exists!');
            }

            if (!in_array($model, $this->uses)) {
                throw new exception('validation model not exists in models!');
            }

            if (!$this->request->is(array('post', 'put'))) {
                throw new exception('only post and put methods are allowed!');
            }

            $request = $this->request->data;

            $this->{$model}->set($request);

            if ($this->{$model}->adminProgramResourceValidate() === false) {
                return json_encode(array('validation' => 'false', 'exception' => 'validation failed!', 'view' => $model, 'errors' => $this->{$model}->validationErrors));
            } else {
                return json_encode(array('validation' => 'true'));
            }
        } catch (exception $ex) {
            return json_encode(array('validation' => 'false', 'exception' => $ex->getMessage(), 'errors' => ''));
        }
    }
    
    public function admin_ajax_ValidateCommunication() 
    {
        $this->autoRender = false;
        try {
             $model = 'ProgramCommunication';
            if (!isset($model) || empty($model)) {
                throw new exception('validation model not exists!');
            }

            if (!in_array($model, $this->uses)) {
                throw new exception('validation model not exists in models!');
            }

            if (!$this->request->is(array('post', 'put'))) {
                throw new exception('only post and put methods are allowed!');
            }

            $request = $this->request->data;

            $this->{$model}->set($request);

            if ($this->{$model}->ValidateCommunication() === false) {
                return json_encode(array('validation' => 'false', 'exception' => 'validation failed!', 'view' => $model, 'errors' => $this->{$model}->validationErrors));
            } else {
                return json_encode(array('validation' => 'true'));
            }
        } catch (exception $ex) {
            return json_encode(array('validation' => 'false', 'exception' => $ex->getMessage(), 'errors' => ''));
        }
    }
    
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
	public function admin_index($is_archive = null)
	{
		$this->layout = "admin_layout";
		$this->set('title_for_layout', 'Programs');
		//if user already loged-in re-direct to welcome page
		$getAllClients = $this->Client->getAllClients();
		$this->set(compact('getAllClients'));
		$this->set('is_archive',$is_archive);
	}
	
	/* Get business data and column sorting start */	
	public function admin_get_programs_json_data($is_archive = null)
	{
		$requestData   = $_REQUEST;
		$this->Program->admin_get_programs_json_data($requestData,$is_archive);
	}
	
	public function admin_addEditProgram()
	{
		$post = $this->request->data;
		$id = $this->Program->addEditProgram($post);
		
		$this->Session->setFlash(__('Program created.'), 'default', array('class' => 'alert alert-success text-center error'));
		$this->redirect(array('controller'=>"programs",'action'=>'general',$id));
		//return $this->redirect($this->referer()); 
		
	}
	
	/******************** Program General *******************/
	public function admin_general()
	{
		$this->layout = "admin_layout";
		$this->set('title_for_layout', 'Programs General');
		$progId = (isset($this->params->pass[0])?$this->params->pass[0]:"");
		$getProgramData = $this->Program->getProgramData($progId);			
		$getProgramStatus = $this->Program->getProgramStatus($progId,$getProgramData['Program']['status']);
		$getTimeZone = $this->getTimeZone();
		$this->set('progId',$progId);
		$this->set(compact('getProgramData'));
		$this->set(compact('getTimeZone'));
		$this->set(compact('getProgramStatus'));
	}
	
	public function admin_generaledit()
	{
		$this->layout = "admin_layout";
		$this->set('title_for_layout', 'Programs General');
		$progId = (isset($this->params->pass[0])?$this->params->pass[0]:"");
		$getProgramData = $this->Program->getProgramData($progId);
		//$getAllClients = $this->Client->getAllClients();
		$getProgramStatus = $this->Program->getProgramStatus($progId,$getProgramData['Program']['status']);
		$this->set('progId',$progId);
		$this->set(compact('getProgramData'));
		$getTimeZone = $this->getTimeZone();
		$this->set(compact('getTimeZone'));
		$this->set(compact('getProgramStatus'));
	}
	
	public function admin_testing()
	{
		$this->layout = "admin_layout";
		$this->set('title_for_layout', 'Programs General');
		//$getAllClients = $this->Client->getAllClients();
		//$this->set(compact('getAllClients'));
	}
	/******************** Program General End ***************/
	
	/******************** Program General *******************/
	public function admin_champions($progId = null)
	{
		$this->layout = "admin_layout";
		$this->set('title_for_layout', 'Programs champions');
		$getProgramData = $this->Program->getProgramData($progId);
		$this->set('progId',$progId);
		$this->set('clientId',$getProgramData['Program']['id_client']);
	}
	/******************** Program General End ***************/
	
	
	/******************** Program General *******************/
	public function admin_training()
	{
		$this->layout = "admin_layout";
		$this->set('title_for_layout', 'Programs General');
		//$getAllClients = $this->Client->getAllClients();
		//$this->set(compact('getAllClients'));
	}
	/******************** Program General End ***************/
	
	
	/******************** Program General *******************/
	public function admin_applications()
	{
		$this->layout = "admin_layout";
		$this->set('title_for_layout', 'Programs General');
		//$getAllClients = $this->Client->getAllClients();
		//$this->set(compact('getAllClients'));
	}
	/******************** Program General End ***************/
	
	
	/******************** Program General *******************/
	public function admin_resources($programId = null)
	{
		$this->layout = "admin_layout";
		$this->set('title_for_layout', 'Programs General');
		$getProgramData = $this->Program->getProgramData($programId);			
		$this->set('progId',$programId);
		$this->set(compact('getProgramData'));
	}
	/******************** Program General End ***************/
	
	
	
	/******************** Program General *******************/
	public function admin_surveys()
	{
		$this->layout = "admin_layout";
		$this->set('title_for_layout', 'Programs General');
		//$getAllClients = $this->Client->getAllClients();
		//$this->set(compact('getAllClients'));
	}
	/******************** Program General End ***************/
	
	
	
	/******************** Program General *******************/
	public function admin_communications($programId = null)
	{
		$this->layout = "admin_layout";
		$this->set('title_for_layout', 'Programs General');
		$getProgramData = $this->Program->getProgramData($programId);			
		$this->set('progId',$programId);
		$this->set(compact('getProgramData'));
		//$getAllClients = $this->Client->getAllClients();
		//$this->set(compact('getAllClients'));
	}
	/******************** Program General End ***************/
	
	
	public function admin_get_program_communication_json_data($programId = null)
	{
		$requestData   = $_REQUEST;
		$this->ProgramCommunication->get_program_communication_json_data($requestData,$programId);
	}
	
	/******************** Program General *******************/
	public function admin_communicationAddEdit($programId = null,$programResourceId = null)
	{
		$this->layout = "admin_layout";
		$this->set('title_for_layout', 'Programs General');
		$communicationData = array();
		if ($this->request->is('post')) 
		{
			$post	=	$this->request->data;
			$return = $this->ProgramCommunication->communicationAddEdit($post);
		
			if($return == 'create')
			{
				 $this->Session->setFlash(__('The communication is added in program.'), 'default', array('class' => 'alert alert-success text-center success'));
			}			
			elseif($return == 'edit')
			{
				 $this->Session->setFlash(__('Changes Saved'), 'default', array('class' => 'alert alert-success text-center success'));
			}
			else
			{
				$this->Session->setFlash(__('Please try again!.'), 'default', array('class' => 'alert alert-danger text-center error'));
			}
			return $this->redirect(array('controller' => 'programs','action' => 'communications',$post['ProgramCommunication']['id_program'],'admin'=>true));
		}
		else
		{
			$getProgramCommunicationData = $this->ProgramCommunication->getProgramCommunicationData($programId,$programResourceId);
			$getProgramData = $this->Program->getProgramData($programId);			
			$this->set('progId',$programId);
			$this->set(compact('getProgramCommunicationData'));
			$this->set(compact('getProgramData'));
		}	
	}
	/******************** Program General End ***************/
	
	/******************** Program General *******************/
	public function admin_landingPage()
	{
		$this->layout = "admin_layout";
		$this->set('title_for_layout', 'Programs General');
		$progId = (isset($this->params->pass[0])?$this->params->pass[0]:"");
		$getProgramData = $this->Program->getProgramData($progId);
		//$getAllClients = $this->Client->getAllClients();
		$getProgramStatus = $this->Program->getProgramStatus($progId,$getProgramData['Program']['status']);
		$this->set('progId',$progId);
		$this->set(compact('getProgramData'));
		$getTimeZone = $this->getTimeZone();
		$this->set(compact('getTimeZone'));
		$this->set(compact('getProgramStatus'));
	}
	/******************** Program General End ***************/
	
	public function admin_landingPageEdit()
	{
		$this->layout = "admin_layout";
		$this->set('title_for_layout', 'Programs Landing page');
		$progId = (isset($this->params->pass[0])?$this->params->pass[0]:"");
		$getProgramData = $this->Program->getProgramData($progId);
		//$getAllClients = $this->Client->getAllClients();
		$getProgramStatus = $this->Program->getProgramStatus($progId,$getProgramData['Program']['status']);
		$this->set('progId',$progId);
		$this->set(compact('getProgramData'));
		$getTimeZone = $this->getTimeZone();
		$this->set(compact('getTimeZone'));
		$this->set(compact('getProgramStatus'));
	}
	
	/******************** Program General *******************/
	public function admin_notes($programId = null)
	{
		$this->layout = "admin_layout";
		$this->set('title_for_layout', 'Programs General');
		$getProgramData = $this->Program->getProgramData($programId);
		$getTimeZone = $this->getTimeZone();
		$this->set(compact('getTimeZone'));
		$this->set(compact('getProgramData'));
	}
	/******************** Program General End ***************/
	
	/******************** Program General *******************/
	public function admin_note_edit($programId = null)
	{
		$this->layout = "admin_layout";
		$this->set('title_for_layout', 'Programs Note Edit');
		$getProgramData = $this->Program->getProgramData($programId);
		$this->set(compact('getProgramData'));
	}
	/******************** Program General End ***************/
	
	
	public function admin_fileuploader()
	{
		if(isset($_FILES['file'])) 
		{
			if($_FILES['file']['size'] < 20971520) //20 MB (size is also in bytes)				
			{
				//sleep(2);
				$fileName 		= 	$_FILES["file"]["name"]; // The file name
				$fileTmpLoc 	= 	$_FILES["file"]["tmp_name"]; // File in the PHP tmp folder
				$fileType 		= 	$_FILES["file"]["type"]; // The type of file it is
				$fileSize 		= 	$_FILES["file"]["size"]; // File size in bytes
				$fileErrorMsg 	= 	$_FILES["file"]["error"]; // 0 for false... and 1 for true
				/*if (!$fileTmpLoc) 
				{	
					echo "ERROR: Please browse for a file before clicking the upload button.";
					exit();
				}*/
				//echo  $filename = WWW_ROOT;die;
				move_uploaded_file($fileTmpLoc, WWW_ROOT.'/img/program_sponsor/'.$fileName);
					// File too big
			} 
			else 
			{
				echo "file size is greater than 20 MB";
			}
		}	
		die;
	}
	
	function admin_addEdittesting()
	{
		echo "<pre>";
		print_r($this->request->data);die;	
	}
	
	public function admin_editProgram()
	{
		$post	=	$this->request->data;
		$this->Program->editProgram($post);
		$this->Session->setFlash(__('Changes saved.'), 'default', array('class' => 'alert alert-success text-center error'));
		//return $this->redirect($this->referer()); 
		return $this->redirect(array('controller' => 'programs','action' => 'general',$post['Program']['id_program'],'admin'=>true));
	}
	
	public function admin_lanchProgram()
	{
		$post	=	$this->request->data;
		$this->Program->lanchProgram($post);
		$this->Session->setFlash(__('Launch program.'), 'default', array('class' => 'alert alert-success text-center error'));
		return $this->redirect($this->referer()); 
	}
	
	
	public function admin_suspendProgram()
	{
		$post	=	$this->request->data;
		$this->Program->suspendProgram($post);
		$this->Session->setFlash(__('Program suspended.'), 'default', array('class' => 'alert alert-success text-center error'));
		return $this->redirect($this->referer()); 
	}
	
	
		
	public function admin_unsuspendProgram()
	{
		$post	=	$this->request->data;
		$this->Program->unsuspendProgram($post);
		$this->Session->setFlash(__('Program unsuspended.'), 'default', array('class' => 'alert alert-success text-center error'));
		return $this->redirect($this->referer()); 
	}
	
	public function admin_deleteProgram()
	{
		$post	=	$this->request->data;
		$this->Program->deleteProgram($post);
		$this->Session->setFlash(__('Program deleted.'), 'default', array('class' => 'alert alert-success text-center error'));
		return $this->redirect($this->referer()); 
	}
	
	
	public function admin_archiveProgram()
	{
		$post	=	$this->request->data;
		$this->Program->archiveProgram($post);
		$this->Session->setFlash(__('Program archived.'), 'default', array('class' => 'alert alert-success text-center error'));
		return $this->redirect($this->referer()); 
	}
	
	public function admin_unArchiveProgram()
	{
		$post	=	$this->request->data;
		$this->Program->unArchiveProgram($post);
		$this->Session->setFlash(__('Program unarchived.'), 'default', array('class' => 'alert alert-success text-center error'));
		return $this->redirect($this->referer()); 
	}
	
	/*Export Program data*/
	public function admin_exportProgramsUsingCSV($programId = null)
	{
		$this->Program->exportProgramsUsingCSV('Programs',$programId);	
	}
	/*Export Program data*/
	
	/*Export Program data*/
	public function admin_exportProgramsUsingXLS($programId = null)
	{
		$this->Program->exportProgramsUsingXLS('Programs',$programId);	
	}
	/*Export Program data*/
	
	
	
	/*public function admin_addProgramResources()
	{
		$requestData   = $_REQUEST;
		$this->ProgramResource->add_program_resources($requestData);
	}*/
	
	public function admin_deleteProgramResource()
	{
		$post = $this->request->data;
		$this->ProgramResource->deleteProgramResource($post);
		$this->Session->setFlash(__('Resource removed from this program.'), 'default', array('class' => 'alert alert-success text-center error'));
		return $this->redirect($this->referer()); 
	}
	
	public function admin_deleteProgramCommunication()
	{
		$post = $this->request->data;
		$this->ProgramCommunication->deleteProgramCommunication($post);
		$this->Session->setFlash(__('Communication removed from this program.'), 'default', array('class' => 'alert alert-success text-center error'));
		return $this->redirect($this->referer()); 
	}
	
	public function admin_addProgramResource()
	{
		$post = $this->request->data;
		$this->ProgramResource->add_program_resources($post);
		$this->Session->setFlash(__('Resource is added to program.'), 'default', array('class' => 'alert alert-success text-center error'));
		return $this->redirect($this->referer());
	}
	
	public function admin_addEditResource()
	{
		$post   = 	$this->request->data;
		$return = $this->ProgramResource->addEditResource($post);
		if($return == 'create')
		{
			 $this->Session->setFlash(__('The resource is created.'), 'default', array('class' => 'alert alert-success text-center success'));
		}
		else if($return == 'edit')
		{
			 $this->Session->setFlash(__('The resource is saved.'), 'default', array('class' => 'alert alert-success text-center success'));
		}
		else
		{
			$this->Session->setFlash(__('Please try again!.'), 'default', array('class' => 'alert alert-danger text-center error'));
		}
		return $this->redirect($this->referer());
	}
	
	public function admin_addEditNote()
	{
		$post = $this->request->data;
		$this->Program->addEditNote($post);
		$this->Session->setFlash(__('Notes is added to program.'), 'default', array('class' => 'alert alert-success text-center error'));
		//return $this->redirect($this->referer());
		return $this->redirect(array('controller' => 'programs','action' => 'notes',$post['Program']['id_program'],'admin'=>true));
	}
		
	public function admin_addEditLandingPage()
	{
		$post = $this->request->data;
		$this->Program->addEditLandingPage($post);
		$this->Session->setFlash(__('Landing page is edit to program.'), 'default', array('class' => 'alert alert-success text-center error'));
		//return $this->redirect($this->referer());
		return $this->redirect(array('controller' => 'programs','action' => 'landingPage',$post['Program']['id_program'],'admin'=>true));
	}
	
	/* Get business data and column sorting start */	
	public function admin_get_programs_champion_json_data($programId = null,$clientId = null)
	{
		$requestData   = $_REQUEST;
		$this->ProgramChampion->get_programs_champion_json_data($requestData,$programId,$clientId);
	}
	public function admin_getFindProgramChampions()
	{
		$getProgramResources = $this->ClientUser->getFindProgramChampions($_POST);
		
		$html = "";
		if(count($getProgramResources) > 0)
		{		
			foreach($getProgramResources as $key=>$value)
			{
				$html .= '<tr>
							<td class="checkbox-col">
								<div class="checkbox custom-checkbox">
									<input name="championSelected[]" class="selectedcheckbox checkboxSelectBox" id="keepSigned_'.$value['User']['id_user'].'" value="'.$value['User']['id_user'].'" type="checkbox">
									<label for="keepSigned_'.$value['User']['id_user'].'"></label>
									<input name="added_by['.$value['User']['id_user'].']"  value="'.$value['User']['added_by'].'" type="text" style="display:none">
									<input name="id_client_user['.$value['User']['id_user'].']"  value="'.$value['ClientUser']['id_client_user'].'" type="text" style="display:none">
								</div>
							</td>
							<td class="ar-title text-primary">'.ucfirst($value['User']['firstname']).' '.$value['User']['lastname'].'</td>
						</tr>';
			}	
		}
		else
		{
			$html .= '<tr>
						<td colspan="3" style="text-align: center;">No data available in table</td>
					</tr>';
		}	
		echo $html;die;
	}

	
	public function admin_addProgramChampion()
	{
		$post = $this->request->data;
		$i = 0;
		$url = array();
		$this->ProgramChampion->add_program_champions($post);
		if(count($post['championSelected']) > 0)
		{
			foreach($post['championSelected'] as $key=>$value)
			{
				$getProgramData = $this->Program->getProgramData($post['ProgramChampion']['programId']);
				$url['programUrl'] = "http://".(isset($getProgramData['Client']['name'])?(preg_replace("/[^A-Za-z0-9]/", "", strtolower($getProgramData['Client']['name']))).'.artofmentoring.net/'.(isset($getProgramData['Program']['program_name'])?preg_replace("/[^A-Za-z0-9]/", "",strtolower($getProgramData['Program']['program_name'])):""):""); 
				$this->loadModel('EmailTemplates');
				$userData = $this->getUserInfo($value);
				$this->sendEmail('add_champion_in_program',$userData['User']['email'],'add_champion_in_program',$url);	
			}
		}	
		$this->Session->setFlash(__('Champion is added to program.'), 'default', array('class' => 'alert alert-success text-center error'));
		return $this->redirect($this->referer());
	}
	
	
	public function admin_deleteProgramChampion()
	{
		$post = $this->request->data;
		$this->ProgramChampion->deleteProgramChampion($post);
		$this->Session->setFlash(__('Champion removed from this program.'), 'default', array('class' => 'alert alert-success text-center error'));
		return $this->redirect($this->referer()); 
	}
	
	/*Show champions and add edit */
	public function admin_editchampion($id = null)
	{
		$this->layout = "admin_layout";
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
				
				$return 		=	$this->User->editProgramChampions($post);
				
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
				return $this->redirect($this->referer()); 
			}
		}
		$this->set(compact('clientData'));
	}	
	/*Show champions and add edit end*/
	
	
	public function admin_suspendProgramChampion()
	{
		
		$post	=	$this->request->data;
		$message = $this->ClientUser->suspendProgramChampion($post);
		if($message == 'notAllowSuspend')
		{
			$this->Session->setFlash(__('You cannot suspend this champion because they are the only champion assigned to the following programs.'), 'default', array('class' => 'alert alert-success text-center error'));
		}
		elseif($message == 'success')
		{
			$this->Session->setFlash(__('Champion suspended.'), 'default', array('class' => 'alert alert-success text-center error'));
		}	
		return $this->redirect($this->referer()); 
	}
	
	
		
	public function admin_unsuspendProgramChampion()
	{
		$post	=	$this->request->data;
		$this->ClientUser->unsuspendProgramChampion($post);
		$this->Session->setFlash(__('Champion unsuspended.'), 'default', array('class' => 'alert alert-success text-center error'));
		return $this->redirect($this->referer()); 
	}
	
	public function admin_getProgramCommunication()
	{
		$getProgramCommunicationsSearch = $this->Communication->getProgramCommunicationsSearch($_POST);
		
		$html = "";
		if(count($getProgramCommunicationsSearch) > 0)
		{		
			foreach($getProgramCommunicationsSearch as $key=>$value)
			{
					//$checked = ($value['ProgramResource']['id_program_resource'])?'checked="checked"':"";
					$html .= '<tr>
								<td class="checkbox-col">
									<div class="checkbox custom-checkbox">
										<input name="resourceSelected[]" class="selectedcheckbox checkboxSelectBox" id="keepSigned_'.$value['Communication']['id_communication'].'" value="'.$value['Communication']['id_communication'].'" type="checkbox">
										<label for="keepSigned_'.$value['Communication']['id_communication'].'"></label>
										<input name="added_by['.$value['Communication']['id_communication'].']"  value="'.$value['Communication']['added_by'].'" type="text" style="display:none">
									</div>
								</td>
								<td class="">'.ucfirst($value['Communication']['subject']).'</td>
							</tr>';
			}	
		}
		else
		{
			$html .= '<tr>
						<td colspan="3" style="text-align: center;">No data available in table</td>
					</tr>';
		}	
		echo $html;die;
	}
	
	public function admin_addProgramCommunication()
	{
		$post = $this->request->data;
		$this->ProgramCommunication->add_program_communications($post);
		$this->Session->setFlash(__('Communication is added to program.'), 'default', array('class' => 'alert alert-success text-center error'));
		return $this->redirect($this->referer());
	}
}
