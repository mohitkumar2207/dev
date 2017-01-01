<?php

/**
 * Description of PopupHelper
 *
 * @author 
 */

class PopupHelper extends AppHelper
{
	public $helpers = array('Form', 'Html', 'Js', 'Time');
	
	public function forgetPassword()
	{
		$html = "";
		$html .=	$this->Form->create('User', array('novalidate' => true,'id'=>'adminValidate','action' => 'forgotPassword','class' =>''));
		$html .=	'<div class="modal fade" id="forgetPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document" style="margin:10% auto;">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close closepopup" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h2 class="modal-title" id="myModalLabel"> <strong> Forgot Password </strong> </h2>
								</div>
								<div class="modal-body form-horizontal">
									<div class="form-group p0">
										<div class="col-sm-12 mB30 mT30 forgot-text text-center">To reset your password, enter the email address you use to <br/> sign in to Artofmentoring. </div>
										<div class="col-sm-12">';
												$html .= $this->Form->input("email", array(
												"class" => "form-control  emailcheck validate[required,custom[email]] text-input",
												"div" => false,
												"label" => false,
												"placeholder" => "Email",
												"id"=>"adminEmail",
												'data-errormessage-custom-error'=>'Your email is must be in a valid format'
												));
							$html .=	'</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="modal-footer pr15">
									<button type="button" class="btn btn-default cancelbutton forgot-btn text-uppercase" data-dismiss="modal">Cancel</button>';
									$html .= $this->Form->submit("Send", array(
									"class" => "btn btn-success forgot-btn text-uppercase",
									"div" => false
									));
				$html .=		'</div>
							</div>
						</div>
					</div>';
			$html .= $this->Form->end();
			$html .='<script>
						jQuery(document).ready(function(){
							jQuery(".forgetpassword").on("click",function()
							{	
								jQuery(".emailcheck").val("");
								jQuery(".adminEmailformError").remove();
							});	
							
						});
					</script>';
			return $html;
	}
	
	public function userAddEditPopup()
	{
		$html = "";
		/*Edit User start */
		$html .=	$this->Form->create('User', array('novalidate' => true,'id'=>'addEditUserValidate','url' => 'addEditAdminUser','class' =>'','onsubmit'=>'return ( $.app.validate("'.$this->Html->url(array('action'=>'ajax_validation_user')).'", this) )'));
		
		$html .= '<div class="modal fade skilsAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box manage-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title text-center text-primary helBold" id="myModalLabel">Admin</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						 <div class="row">
							<div class="col-md-6">
								<div class="form-group form-bordered EditAdmin">';
									 $html .= $this->Form->input("firstname", array("class" => "form-control text-input","div" => false,"label" => false,"placeholder" => "First name","id"=>"firstname"));
									 $html .= '
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-bordered EditAdmin">';
									 $html .= $this->Form->input("lastname", array("class" => "form-control text-input","div" => false,"label" => false,"placeholder" => "Last name","id"=>"lastname"));
									 $html .= '
							    </div>
							</div>
							
							<div class="col-md-12">
								<div class="form-group form-bordered EditAdmin">';
									 $html .= $this->Form->input("email", array("class" => "form-control text-input","div" => false,"label" => false,"placeholder" => "Email","id"=>"email"));
								 $html .= '
							   </div>
							</div>
							
							<div class="col-md-12">
								<div id="loader-img" class="alert" style="display:none;text-align:center;"><img src="'.$this->webroot.'"img/ajax-loader1.gif";?>"></div>
							</div>
							
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_user", array("type"=>"hidden","div" => false,"label" => false,"class"=>"adminId"));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								$html .= $this->Form->submit("Delete", array("class" => "btn btn-danger btn-block text-uppercase deletebutton submitNewSkill","div" => false,"type"=>"submit","label" => false));
								$html .= $this->Form->submit("Create", array("class" => "btn btn-success btn-block text-uppercase savebutton submitNewSkill checkAdmin","div" => false,"type"=>"button","label" => false));
					$html .= '</div>	
						 </div>					  
					  </div>';
			 $html .= '
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Edit User end */
		
		/* Multiple role check allow start*/
		$html .= '<div class="modal fade multiRolePopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-multiple text-center text-primary helBold" id="myModalLabel"> Multiple User Role </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="col-sm-12 col-md-12">
										<p><strong>There is already an account using this email. If any fields belonging to that account are different, they will be overwritten to match this account. Would you like to continue?</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								 <button type="button" class="btn btn-default btn-block text-uppercase multiRoleCancel" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">
								 <button type="button" class="btn btn-success btn-block text-uppercase continueAdmin" data-dismiss="modal">Continue</button>
							</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/* Multiple role check allow start*/
		
		/*Delete User start */
		$html .=	$this->Form->create('User', array('novalidate' => true,'id'=>'deleteUserValidate','url' => 'deleteAdminUser','class' =>''));
		$html .= '<div class="modal fade deleteAdminAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title text-center text-primary helBold" id="myModalLabel"> Delete Admin? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered deleteAdmin" style="display:none">
									<div class="col-sm-12 col-md-12">
										<p><strong>Are you sure you want to delete this user? This action cannot be undone and the user will lose all access.</strong></p>
									</div>
								</div>
							</div>	
							
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_user", array("type"=>"hidden","div" => false,"label" => false,"class"=>"adminId"));
								 $html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								 $html .= $this->Form->submit("Delete", array("class" => "btn btn-success btn-block text-uppercase deletebutton submitNewSkill","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
							<div class="col-md-12">';	
								 //$html .= $this->Form->input("deleteUser", array("type"=>"text","div" => false,"label" => false,'style'=>'visibility: hidden'));				
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Delete User end */
		
		/*Not allow delete User popup start */
		$html .= '<div class="modal fade createNewAdminUserAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title text-center text-primary helBold" id="myModalLabel"> You cannot delete this user </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="col-sm-12 col-md-12">
										<p><strong>You cannot delete this user as they are the only admin user in the system. You will need to create a new admin user before deleting this one.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">
								 <button type="button" class="btn btn-success btn-block text-uppercase closebutton11" data-dismiss="modal">Ok</button>
							</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/*Not allow delete User popup start */
		
		/*Reset Password start */
		$html .=	$this->Form->create('User', array('novalidate' => true,'id'=>'resetPasswordValidate','url' => 'adminManageForgotPassword','class' =>''));
		$html .= '<div class="modal fade resetAdminAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box reset-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title text-center text-primary helBold" id="myModalLabel"> Reset Password? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						  <div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>Do you want to resend a password link to this admin user’s email? This allows them to reset their password. Nothing will happen if the link isn’t used</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								$html .= $this->Form->input("email", array("type"=>"hidden","div" => false,"label" => false,'id'=>"resendEmail"));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,'value'=>'resetAdminUserPassword'));
								$html .= $this->Form->submit("Resend Link", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .= '</div>				  
						</div>
					</div>
				  </div>
				</div>
				</div>
				';
		$html .= $this->Form->end();
		$html .= "<style>
					tr th:nth-child(3) { visibility: hidden; }
				</style>";	
	
		/*Reset Password end */
		
		/*Delete user validate alert start */
		$html .= '<div class="modal fade deleteAdminUserAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box">
					  <div class="modal-header form-box-head">
						<!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
						<h2 class="modal-title text-center text-primary helBold" id="myModalLabel"> You cannot delete this user. </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>You cannot delete this user as they are the only verified admin user in the system. You will need to create a new admin user and have them set their password before delete this one.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">';
								 $html .= $this->Html->link('OK', '/admin/users/users', array('escape' => false,'admin'=>true,'class'=>"btn btn-success btn-block text-uppercase"));

					$html .='</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';
		return $html;
		/*Delete user validate alert end */
	}
	
	public function inValidDataPopup()
	{
		$html = "";
		$html .= "<style>
					.ui-widget-overlay{z-index: 2147483647;}
					.ui-dialog{z-index: 2147483647;}
					.ui-dialog .ui-dialog-title {text-align: center;} 
					#dialog-message p {font-size: 13px;}
					.ui-dialog-titlebar-close{display:none;}
					.ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset {float: none;text-align: center;}	.ui-button.ui-widget.ui-state-default.ui-corner-all.ui-button-text-only.ui-state-focus{background-color:#2acb94;color:#ffffff;}
					.ui-dialog-titlebar.ui-widget-header.ui-corner-all.ui-helper-clearfix.ui-draggable-handle {background-color: #000000;color: #ffffff;}
					.ui-dialog-titlebar.ui-widget-header.ui-corner-all.ui-helper-clearfix {background: black none repeat scroll 0 0;color: white;}
					.ui-button.ui-widget.ui-state-default.ui-corner-all.ui-button-text-only {background: #2acb94 none repeat scroll 0 0;color: #ffffff;}
				</style>
				<a href='javascript:void(0);' class='invalidData' style='display:none;'>dialogClick</a>
				<div class='invalidData-message' title='Invalid Data' style='display:none;'>
				  <p>
					<span class='' style='float:left; margin:0 7px 12px 0;font-size: 14px;'>One or more fields contain invalid data, please review and then try again</span>
				  </p>
				</div>";
		return $html; 
	}
	/* Google Analytics script start */
	public function googleAnalytics()
	{
		$html = "";
		$html .= "<script> 
					(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
					})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
					ga('create', 'UA-73075618-1', 'auto');
					ga('send', 'pageview');
				</script>";
		return $html; 	
	}
	/* Google Analytics script start */		
	
	function resetPasswordView()
	{
		$html = "";
		
		/*Reset Password start */
		$html .=	$this->Form->create('User', array('novalidate' => true,'id'=>'resetPasswordViewValidate','url' => 'login','class' =>''));
		$html .= '<div class="modal fade resetpasswordAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
						<h4 class="modal-title" id="myModalLabel"> Password updated </h4>
					  </div>
					  <div class="modal-body form-horizontal mT20"> 
						 <div class="alert alert-info text-center error" style="display:none;"></div>
						  
							<div class="form-group p0">
								<div class="col-sm-12 col-md-12">
									<p><strong>Your password has successfully been updated. Click Ok to login to your account.</strong></p>
								</div>
							</div>						  
					  </div>
					  <div class="modal-footer">
						  <div id="loader-img" class="alert" style="display:none;text-align:center;"><img src="'.$this->webroot.'"img/ajax-loader1.gif";?>"></div>';
							 $html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,'value'=>'loginRequest'));
							 $html .= $this->Form->submit("OK", array("class" => "btn btn-success","div" => false,"type"=>"submit","label" => false));
			 $html .= '</div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();
		$html .= "<style>
					tr th:nth-child(3) { display:none; }
				</style>";	
		return 	$html;
		/*Reset Password end */	
	}
	
	
	/* Client create popup start */
	public function createEditCompany()
	{
		$html  = 	"";
		$html .= '<div class="modal fade createCompany" id="createCompany" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content form-box">
							<div class="modal-header form-box-head">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title text-center text-primary helBold">Create company</h2>
								<!--<p class="text-center">You cannot change these details or the URL. Are you sure you want to create this new client?</p>-->
							</div>
							<div class="modal-body form-box-body">';
							$html .=	$this->Form->create('Client', array('novalidate' => true,'id'=>'addEditCompanyValidate','url' => 'addEditCompany','class' =>'','onsubmit'=>'return ( $.app.validate("'.$this->Html->url(array('action'=>'ajax_validation_create_compnay')).'", this) )'));
							$html .='<div class="row">
										<div class="col-md-12">
											<div class="form-group form-bordered">';
											 $html .= $this->Form->input("name", array("class" => "addUrlname form-control text-input","div" => false,"label" => false,"placeholder" => "Client Name","id"=>"clientname","maxlength"=>30));
							$html .= '		</div>
										</div>
										<div class="col-md-12">
											<div class="clone-bordered">
											<div class="input-group input-group-modify cmpnyName-input-group">
												<!--<span class="input-group-addon">www.</span>-->
												'; 
												$html .= $this->Form->input("url", array("label" => false,"div" => false,"class"=>"clienturl addUrlname form-control","placeholder"=>"client_name","maxlength"=>30));
												$html .= '<span class="input-group-addon right-addon">.artofmentoring.net</span> <hr>
											</div></div>
										</div>
										<div class="col-md-12">
											<div class="input-group custom-input-group text-addon-group url-input-group">
												<span class="input-group-addon"><span class="info-tooltip" data-toggle="tooltip" data-placement="top" title="If indexed, users are able to find the company site from a search engine.">i</span> Index URL?</span>
												<div class="select-control">';
													$value = array(''=>'Choose Option','1'=>'Yes','0'=>'No');
													$html .= 	$this->Form->input('indexed', array('type'=>'select', 'label'=>false, 'options'=>$value, 'default'=>'','class'=>'form-control'));
										$html .= '</div>
											</div>
										</div>
										<!--<div class="col-md-6">
											<a href="" class="btn btn-default btn-block text-uppercase">CANCEL</a>
										</div>
										<div class="col-md-6">
											<a href="" class="btn btn-success btn-block text-uppercase">CREATE</a>
										</div>-->
										
										<div class="col-md-6">';
											$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
										</div>
										
										<div class="col-md-6">';
											$html .= $this->Form->input("id_client", array("type"=>"hidden","div" => false,"label" => false,"class"=>"clientId"));
											$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
											//$html .= $this->Form->submit("Create", array("class" => "btn btn-success btn-block text-uppercase savebutton submitNewSkill","div" => false,"type"=>"submit","label" => false));
											$html .= $this->Html->link('Create','javascript:void(0)',array('class'=>'btn btn-success btn-block text-uppercase addClientConfirm','data-toggle'=>'modal','data-target'=>'.clientConfirmPopup'));
											
											//$html .= '<button type="button" class="btn btn-default btn-block text-uppercase addClientConfirm" data-dismiss="modal">Create</button>';
											
								$html .= '</div>	
									</div>';
								$html .= $this->Form->end();
						$html .='</div>
						</div>
					</div>
				</div>';
			
						
				/* Confirm popup to save client */
				$html .= '<div class="modal fade clientConfirmPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
							<div class="modal-content form-box delete-admin-modal-box">
							  <div class="modal-header form-box-head">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title-discard text-center text-primary helBold" id="myModalLabel"> Create New Client? </h2>
							  </div>
							  <div class="modal-body form-box-body"> 
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="form-group form-bordered">
											<div class="form-info-text text-center">
												<p><strong>You cannot change these details or the URL. Are you sure you want to create this new client?</strong></p>
											</div>
										</div>
									</div>	
									<div class="col-md-6">
										 <button type="button" class="btn btn-default btn-block text-uppercase" data-dismiss="modal">Cancel</button>
									</div>
									<div class="col-md-6">';
										 $html .= $this->Form->button("Create", array("class" => "btn btn-success btn-block text-uppercase createClient","div" => false,"type"=>"button","label" => false));
						$html .=	'</div>							  
							  </div>
							 </div>
							</div>
						  </div>
						</div>';	
				/* Confirm popup to save client */
		return 	$html;
	}
	/* Logout popup start */
	public function logout()
	{
		$html  = 	"";	
		$html .= '<div class="modal fade logoutAdminUserAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title text-center text-primary helBold" id="myModalLabel"> Log out? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>Do you wish to log out of Art of Mentoring?</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">NO</button>
							</div>
							<div class="col-md-6">
								 ';
								 $html .= $this->Html->link('YES', '/admin/users/logout', array('escape' => false,'admin'=>true,'class'=>"btn btn-success btn-block text-uppercase"));

						$html .='</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';
		return $html;				
	}	
	/* Logout popup end */
	
	/*Champions page popups start*/
	public function championAddEditPopup()
	{
		$clientid = (isset($this->request->params['pass'][0])?$this->request->params['pass'][0]:"");
		$html = "";
		/*Edit champion User start */
		$html .=	$this->Form->create('User', array('novalidate' => true,'id'=>'addEditChampionValidate','url' => 'champions','class' =>'','onsubmit'=>'return ( $.app.validate("'.$this->Html->url(array('action'=>'ajax_validation_champion')).'", this) )'));
		
		$html .= '<div class="modal fade skilsAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box manage-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title text-center text-primary helBold" id="myModalLabel">Champion</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						 <div class="row">
							<div class="col-md-6">
								<div class="form-group form-bordered">';
									 $html .= $this->Form->input("firstname", array("class" => "form-control text-input","div" => false,"label" => false,"placeholder" => "First Name","id"=>"firstname"));
									 $html .= '
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-bordered">';
									 $html .= $this->Form->input("lastname", array("class" => "form-control text-input","div" => false,"label" => false,"placeholder" => "Last Name","id"=>"lastname"));
									 $html .= '
							    </div>
							</div>
							
							<div class="col-md-12">
								<div class="form-group form-bordered">';
									 $html .= $this->Form->input("email", array("class" => "form-control text-input","div" => false,"label" => false,"placeholder" => "Email Address","id"=>"email"));
								 $html .= '
							   </div>
							</div>
							<div class="col-md-12">
								<div class="form-group form-bordered">';
									 $html .= $this->Form->input("phone", array("class" => "form-control text-input","div" => false,"label" => false,"placeholder" => "Phone Number","id"=>"phone","type"=>'tel',"maxlength"=>10));
								 $html .= '
							   </div>
							</div>
							
							<div class="col-md-12">
								<div id="loader-img" class="alert" style="display:none;text-align:center;"><img src="'.$this->webroot.'"img/ajax-loader1.gif";?>"></div>
							</div>
							
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_user", array("type"=>"hidden","div" => false,"label" => false,"class"=>"championId"));
								$html .= $this->Form->input("id_client", array("type"=>"hidden","div" => false,"label" => false,"class"=>"","value"=>(isset($this->request->params['pass'][0])?$this->request->params['pass'][0]:"")));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								$html .= $this->Form->input("id_champion", array("type"=>"hidden","div" => false,"label" => false,"class"=>"id_champion","value"=>""));
								//$html .= $this->Form->submit("Delete", array("class" => "btn btn-danger btn-block text-uppercase deletebutton submitNewSkill","div" => false,"type"=>"submit","label" => false));
								$html .= $this->Form->submit("Create", array("class" => "btn btn-success btn-block text-uppercase savebutton submitNewSkill checkChampion","div" => false,"type"=>"button","label" => false));
					$html .= '</div>	
						 </div>					  
					  </div>';
			 $html .= '
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Edit User end */
		
		/* Multiple role check allow start*/
		$html .= '<div class="modal fade multiRolePopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-multiple text-center text-primary helBold" id="myModalLabel"> Multiple User Role </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="col-sm-12 col-md-12">
										<p><strong>There is already an account using this email. If any fields belonging to that account are different, they will be overwritten to match this account. Would you like to continue?</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								 <button type="button" class="btn btn-default btn-block text-uppercase multiRoleCancel" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">
								 <button type="button" class="btn btn-success btn-block text-uppercase continue" data-dismiss="modal">Continue</button>
							</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/* Multiple role check allow start*/
		
		
		/*Delete User start */
		$html .=	$this->Form->create('User', array('novalidate' => true,'id'=>'deleteUserValidate','url' => 'deleteChampionUser','class' =>''));
		$html .= '<div class="modal fade deleteChampionAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title1 text-center text-primary helBold" id="myModalLabel"> Delete Champion? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="col-sm-12 col-md-12">
										<p><strong>Are you sure you want to delete this champion? This action cannot be undone and they will lose all of their access</strong></p>
									</div>
								</div>
							</div>	
							
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_champion", array("type"=>"hidden","div" => false,"label" => false,"class"=>"championId"));
								 $html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								 $html .= $this->Form->submit("Delete", array("class" => "btn btn-success btn-block text-uppercase deletebutton submitNewSkill","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
							<div class="col-md-12">';	
								 //$html .= $this->Form->input("deleteUser", array("type"=>"text","div" => false,"label" => false,'style'=>'visibility: hidden'));				
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Delete User end */
		
		/*Not allow delete User popup start */
		$html .= '<div class="modal fade cannotDeleteChampionAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-champion text-center text-primary helBold" id="myModalLabel"> Cannot Delete </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="col-sm-12 col-md-12">
										<p><strong>You cannot delete this champion because they are the only champion assigned to the following programs.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">
								 <button type="button" class="btn btn-success btn-block text-uppercase closebutton11" data-dismiss="modal">Ok</button>
							</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/*Not allow delete User popup start */
		
		/*Suspend champion/unsuspend champion  start */
		$html .=	$this->Form->create('ClientUser', array('novalidate' => true,'id'=>'suspendedValidate','url' => 'SuspendUnsupendChampionUser','class' =>''));
		$html .= '<div class="modal fade SuspendAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box reset-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-suspended text-center text-primary helBold" id="myModalLabel"> Suspend User? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						  <div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong class="content_msg">Are you sure you want to suspend this user? They will not have access to their account whilst they are suspended.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								$html .= $this->Form->input("id_client_user", array("type"=>"hidden","div" => false,"label" => false,'class'=>"championId"));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,'value'=>'suspended','class'=>"mode"));
								$html .= $this->Form->submit("Suspend", array("class" => "btn suspend_button btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .= '</div>				  
						</div>
					</div>
				  </div>
				</div>
				</div>
				';
		$html .= $this->Form->end();
		$html .= "<style>
					tr th:nth-child(8) { visibility: hidden; }
				</style>";	
	
		/*Suspend champion/unsuspend champion  start */
		
		/*Delete user validate alert start */
		$html .= '<div class="modal fade deleteAdminUserAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box">
					  <div class="modal-header form-box-head">
						<!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
						<h2 class="modal-title text-center text-primary helBold" id="myModalLabel"> You cannot delete this user. </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>You cannot delete this user as they are the only verified admin user in the system. You will need to create a new admin user and have them set their password before delete this one.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">';
								 $html .= $this->Html->link('OK', '/admin/users/users', array('escape' => false,'admin'=>true,'class'=>"btn btn-success btn-block text-uppercase"));

					$html .='</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';
				/*Delete user validate alert end */
				
		/*Export csv data popup */
		$html .= '<div class="modal fade exportCsvChampions" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-export text-center text-primary helBold" id="myModalLabel">Export Data?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>This will export all results to a .csv file </strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closeExportPopup" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								 $html .= $this->Html->link('Export', '/admin/clients/exportChampionsUsingCSV/'.$clientid, array('escape' => false,'admin'=>true,'class'=>"btn closeExport btn-success btn-block text-uppercase"));
					$html .='</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';
		/*Export csv data popup end */
		/*Export xls data popup */
		$html .= '<div class="modal fade exportXlsChampions" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-export text-center text-primary helBold" id="myModalLabel">Export Data?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>This will export all results to a .xls file </strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closeExportPopup" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								 $html .= $this->Html->link('Export', '/admin/clients/exportChampionsUsingXLS/'.$clientid, array('escape' => false,'admin'=>true,'class'=>"btn btn-success btn-block text-uppercase closeExport"));
					$html .='</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';
				
				$html .= '<div class="modal fade cannotSuspendAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-cannot-upload text-center text-primary helBold" id="myModalLabel"> Cannot Suspend</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>You cannot suspend this champion because they are the only champion assigned to the following programs.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">';
								 $html .= '<button type="button" class="contupload btn btn-success btn-block text-uppercase" data-dismiss="modal">Ok</button>
							</div>
						</div>
					 </div>
					</div>
				  </div>
				  </div>
				';
						
		return $html;
	}
	/*Champions page popups end*/
	
	/*Participants page popup start*/
	public function participantsAddEditPopup()
	{
		$clientid = (isset($this->request->params['pass'][0])?$this->request->params['pass'][0]:"");
		$html = "";
		/*Delete User start */
		$html .=	$this->Form->create('User', array('novalidate' => true,'id'=>'deleteUserValidate','url' => 'deleteParticipantUser','class' =>''));
		$html .= '<div class="modal fade deleteParticipantAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title1 text-center text-primary helBold" id="myModalLabel"> Delete Participant? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<div class="form-info-text">
										<p><strong>Are you sure you want to delete this participant? This action cannot be undone and they will lose all of their access and associated data.</strong></p>
									</div>
								</div>
							</div>	
							
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_user", array("type"=>"hidden","div" => false,"label" => false,"class"=>"championId"));
								$html .= $this->Form->input("id_client", array("type"=>"hidden","div" => false,"label" => false,"class"=>"client","value"=>(isset($this->request->params['pass'][0])?$this->request->params['pass'][0]:"")));
								 $html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								 $html .= $this->Form->submit("Delete", array("class" => "btn btn-success btn-block text-uppercase deletebutton submitNewSkill","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
							<div class="col-md-12">';	
								 //$html .= $this->Form->input("deleteUser", array("type"=>"text","div" => false,"label" => false,'style'=>'visibility: hidden'));				
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Delete User end */
		
		/*Not allow delete User popup start */
		$html .= '<div class="modal fade createNewAdminUserAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title text-center text-primary helBold" id="myModalLabel"> You cannot delete this user </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="col-sm-12 col-md-12">
										<p><strong>You cannot delete this user as they are the only admin user in the system. You will need to create a new admin user before deleting this one.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">
								 <button type="button" class="btn btn-success btn-block text-uppercase closebutton11" data-dismiss="modal">Ok</button>
							</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/*Not allow delete User popup start */
		
		/*Suspend/Unsupend Participant start */
		$html .=	$this->Form->create('User', array('novalidate' => true,'id'=>'suspendedValidate','url' => 'SuspendUnsupendParticipant','class' =>''));
		$html .= '<div class="modal fade SuspendAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box reset-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-suspended text-center text-primary helBold" id="myModalLabel"> Suspend User? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						  <div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong class="content_msg">Are you sure you want to suspend this user? They will not have access to their account whilst they are suspended.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								$html .= $this->Form->input("id_user", array("type"=>"hidden","div" => false,"label" => false,'class'=>"championId"));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,'value'=>'suspended','class'=>"mode"));
								$html .= $this->Form->input("inactive", array("type"=>"hidden","div" => false,"label" => false,'value'=>'','class'=>"inactive"));
								$html .= $this->Form->submit("Suspend", array("class" => "btn suspend_button btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .= '</div>				  
						</div>
					</div>
				  </div>
				</div>
				</div>
				';
		$html .= $this->Form->end();
		$html .= "<style>
					tr th:nth-child(8) { visibility: hidden; }
				</style>";	
	
		/*Suspend Unsupend Participant end */
		
		/*Delete user validate alert start */
		$html .= '<div class="modal fade deleteAdminUserAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box">
					  <div class="modal-header form-box-head">
						<!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
						<h2 class="modal-title text-center text-primary helBold" id="myModalLabel"> You cannot delete this user. </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>You cannot delete this user as they are the only verified admin user in the system. You will need to create a new admin user and have them set their password before delete this one.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">';
								 $html .= $this->Html->link('OK', '/admin/users/users', array('escape' => false,'admin'=>true,'class'=>"btn btn-success btn-block text-uppercase"));

					$html .='</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';
				/*Delete user validate alert end */
				
		/*Export csv data popup */
		$html .= '<div class="modal fade exportCsvParticipant" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-export text-center text-primary helBold" id="myModalLabel">Export Data?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>This will export all results to a .csv file </strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closeExportPopup" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								 $html .= $this->Html->link('Export', '/admin/clients/exportParticipantsUsingCSV/'.(isset($this->request->params['pass'][0])?$this->request->params['pass'][0]:""), array('escape' => false,'admin'=>true,'class'=>"btn btn-success btn-block text-uppercase closeExport"));
					$html .='</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';
		/*Export csv data popup end */
		/*Export xls data popup */
		$html .= '<div class="modal fade exportXlsParticipant" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-export text-center text-primary helBold" id="myModalLabel">Export Data?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>This will export all results to a .xls file </strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closeExportPopup" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								 $html .= $this->Html->link('Export', '/admin/clients/exportParticipantsUsingXLS/'.(isset($this->request->params['pass'][0])?$this->request->params['pass'][0]:""), array('escape' => false,'admin'=>true,'class'=>"btn btn-success btn-block text-uppercase closeExport"));
					$html .='</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
				
		/* Active User Archive popup */
		$html .= '<div class="modal fade activeParticipantArchive" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-archive1 text-center text-primary helBold" id="myModalLabel">Cannot archive user</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>You cannot archive a user unless they are inactive </strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">';
								$html .= '<button type="button" class="btn btn-success btn-block text-uppercase" data-dismiss="modal">Ok</button>
							</div>						  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/* Active User Archive popup */		
		
		/* Active User Archive popup */
		$html .=	$this->Form->create('User', array('novalidate' => true,'id'=>'suspendedValidate','url' => 'archiveParticipant','class' =>''));
		$html .= '<div class="modal fade inActiveParticipantArchive" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-archive text-center text-primary helBold" id="myModalLabel">Archive User?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong class="archive_content">Are you sure you want to archive this user?</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								 $html .= $this->Form->input("id_user", array("type"=>"hidden","div" => false,"label" => false,'class'=>"participantId"));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,'value'=>'unarchive','class'=>"mode"));
								$html .= $this->Form->submit("Archive", array("class" => "btn archive_button btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
					$html .='</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		$html .= $this->Form->end();
		/* Active User Archive popup */					
		return $html;
	}
	/*Participants page popup end*/
	
	/*Client General delete poppup start*/
	public function clientGeneralPopup($clientId = null)
	{
		$html = "";
		/*Delete User start */
		$html .=	$this->Form->create('User', array('novalidate' => true,'id'=>'deleteClientValidate','url' => 'deleteClient','class' =>''));
		$html .= '<div class="modal fade deleteClientAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title1 text-center text-primary helBold" id="myModalLabel"> Delete Client? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="col-sm-12 col-md-12">
										<p><strong>Are you sure you want to delete this client? This action cannot be undone. All champions, participants, and program data will be deleted with it.</strong></p>
									</div>
								</div>
							</div>	
							
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_client", array("type"=>"hidden","div" => false,"label" => false,"class"=>"clientId",'value'=>$clientId));
								 $html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode",'value'=>'generalDelete'));
								 $html .= $this->Form->submit("Delete", array("class" => "btn btn-success btn-block text-uppercase deletebutton","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
							<div class="col-md-12">';	
								 //$html .= $this->Form->input("deleteUser", array("type"=>"text","div" => false,"label" => false,'style'=>'visibility: hidden'));				
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Delete User end */
		
		/*Not allow delete User popup start */
		$html .= '<div class="modal fade cannotClientAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title text-center text-primary helBold" id="myModalLabel"> Cannot Delete </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="col-sm-12 col-md-12">
										<p><strong>You cannot delete a client whilst there are active programs</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">
								 <button type="button" class="btn btn-success btn-block text-uppercase closebutton11" data-dismiss="modal">Ok</button>
							</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/*Not allow delete User popup start */
		
		return $html;
	}
	/*Client General delete poppup end*/
	
	public function applicationsAddEditPopup()
	{
		$html = "";
		/*Edit User start */
		$html .=	$this->Form->create('Application', array('novalidate' => true,'id'=>'addEditApplicationValidate','url' => 'addEditApplication','class' =>'','onsubmit'=>'return ( $.app.validate("'.$this->Html->url(array('action'=>'ajax_validation_application')).'", this) )'));

		$html .= '<div class="modal fade applicationAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box manage-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title text-center text-primary helBold" id="myModalLabel">Create Application</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						 <div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">';
									 $html .= $this->Form->input("name", array("class" => "form-control text-input","div" => false,"label" => false,"placeholder" => "Application name","id"=>"appName"));
									 $html .= '
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="form-group form-bordered">';
									$value = array(''=>'Choose Option','Mentor'=>'Mentor','Mentee'=>'Mentee');
									$html .= 	$this->Form->input('type', array('type'=>'select', 'label'=>false, 'options'=>$value, 'default'=>'','class'=>'form-control'));
								 $html .= '
							   </div>
							</div>
							
							<div class="col-md-12">
								<div id="loader-img" class="alert" style="display:none;text-align:center;"><img src="'.$this->webroot.'"img/ajax-loader1.gif";?>"></div>
							</div>
							
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_application", array("type"=>"hidden","div" => false,"label" => false,"class"=>"applicationId","value"=>''));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								$html .= $this->Form->submit("Create", array("class" => "btn btn-success btn-block text-uppercase savebutton","div" => false,"type"=>"submit","label" => false));
					$html .= '</div>	
						 </div>					  
					  </div>';
			 $html .= '
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Edit User end */

		/*Delete single Application  start */
		$html .=	$this->Form->create('Application', array('novalidate' => true,'id'=>'applicationValidate','url' => 'deleteApplication','class' =>''));
		$html .= '<div class="modal fade deleteApplicationAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title1 text-center text-primary helBold" id="myModalLabel"> Delete this Application?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="col-sm-12 col-md-12">
										<p><strong>Are you sure you want to delete this application from the library? This action cannot be undone. The application will remain in any programs it has previously been included in.</strong></p>
									</div>
								</div>
							</div>	
							
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_application", array("type"=>"hidden","div" => false,"label" => false,"class"=>"applicationId"));
								 $html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								 $html .= $this->Form->submit("Delete", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Delete single Application  start */
		
		/*Delete multiple  Application  start */
		$html .=	$this->Form->create('Application', array('novalidate' => true,'id'=>'allApplicationValidate','url' => 'allApplicationDelete','class' =>''));
		$html .= '<div class="modal fade deleteAllAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-app text-center text-primary helBold" id="myModalLabel"> Delete X Application/s?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="col-sm-12 col-md-12">
										<p><strong>Are you sure you want to delete this/these applications from the library? This action cannot be undone. The application/s will remain in any programs it has previously been included in.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								$html .= $this->Form->input("selectedId", array("type"=>"hidden","div" => false,"label" => false,"class"=>"selectedId"));
								 $html .= $this->Form->submit("Delete", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Delete multiple  Application  end */

		/*Not allow delete User popup start */
		$html .= '<div class="modal fade createNewAdminUserAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title text-center text-primary helBold" id="myModalLabel"> You cannot delete this user </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="col-sm-12 col-md-12">
										<p><strong>You cannot delete this user as they are the only admin user in the system. You will need to create a new admin user before deleting this one.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">
								 <button type="button" class="btn btn-success btn-block text-uppercase closebutton11" data-dismiss="modal">Ok</button>
							</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/*Not allow delete User popup start */

		/*Delete user validate alert start */
		$html .= '<div class="modal fade deleteAdminUserAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box">
					  <div class="modal-header form-box-head">
						<!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
						<h2 class="modal-title text-center text-primary helBold" id="myModalLabel"> You cannot delete this user. </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>You cannot delete this user as they are the only verified admin user in the system. You will need to create a new admin user and have them set their password before delete this one.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">';
								 $html .= $this->Html->link('OK', '/admin/users/users', array('escape' => false,'admin'=>true,'class'=>"btn btn-success btn-block text-uppercase"));

					$html .='</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';
		/*Delete user validate alert end */		
		return $html;	
	}
	
	/*Champions page popups start*/
	public function participantEditProfilePopup()
	{
		$clientid = (isset($this->request->params['pass'][0])?$this->request->params['pass'][0]:"");
		$html = "";
		/*Edit champion User start */
		$html .=	$this->Form->create('User', array('novalidate' => true,'id'=>'addEditParticipantValidate','url' => 'editParticipant','class' =>'','onsubmit'=>'return ( $.app.validate("'.$this->Html->url(array('action'=>'ajax_validation_participant')).'", this) )'));
		
		$html .= '<div class="modal fade editParticipantAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box manage-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-participant text-center text-primary helBold" id="myModalLabel">Edit Participant</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						 <div class="row">
							<div class="col-md-6">
								<div class="form-group form-bordered">';
									 $html .= $this->Form->input("firstname", array("class" => "form-control text-input","div" => false,"label" => false,"placeholder" => "First name","id"=>"firstname","maxlength"=>15));
									 $html .= '
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-bordered">';
									 $html .= $this->Form->input("lastname", array("class" => "form-control text-input","div" => false,"label" => false,"placeholder" => "Last name","id"=>"lastname","maxlength"=>30));
									 $html .= '
							    </div>
							</div>
							
							<div class="col-md-12">
								<div class="form-group form-bordered">';
									 $html .= $this->Form->input("email", array("class" => "form-control text-input","div" => false,"label" => false,"placeholder" => "Email","id"=>"email"));
								 $html .= '
							   </div>
							</div>
							
							<div class="col-md-12">
								<div id="loader-img" class="alert" style="display:none;text-align:center;"><img src="'.$this->webroot.'"img/ajax-loader1.gif";?>"></div>
							</div>
							
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_user", array("type"=>"hidden","div" => false,"label" => false,"class"=>"participantId"));
								$html .= $this->Form->input("id_client", array("type"=>"hidden","div" => false,"label" => false,"class"=>"","value"=>(isset($this->request->params['pass'][0])?$this->request->params['pass'][0]:"")));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								$html .= $this->Form->submit("Create", array("class" => "btn btn-success btn-block text-uppercase savebutton submitNewSkill","div" => false,"type"=>"submit","label" => false));
					$html .= '</div>	
						 </div>					  
					  </div>';
			 $html .= '
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Edit User end */
		
		/*Suspend Unsupend Participant start */
		$html .=	$this->Form->create('User', array('novalidate' => true,'id'=>'suspendedValidate','url' => 'SuspendUnsupendParticipant','class' =>''));
		$html .= '<div class="modal fade SuspendAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box reset-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-suspended text-center text-primary helBold" id="myModalLabel"> Suspend User? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						  <div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong class="content_msg">Are you sure you want to suspend this user? They will not have access to their account whilst they are suspended.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								$html .= $this->Form->input("id_user", array("type"=>"hidden","div" => false,"label" => false,'class'=>"participantId","value"=>(isset($this->request->params['pass'][1])?$this->request->params['pass'][1]:"")));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,'value'=>'suspended','class'=>"mode"));
								$html .= $this->Form->submit("Suspend", array("class" => "btn suspend_button btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .= '</div>				  
						</div>
					</div>
				  </div>
				</div>
				</div>
				';
		$html .= $this->Form->end();
		$html .= "<style>
					tr th:nth-child(8) { visibility: hidden; }
				</style>";	
	
		/*Suspend Unsupend Participant end */
		
		
		/* Archive popup */
		$html .=	$this->Form->create('User', array('novalidate' => true,'id'=>'suspendedValidate','url' => 'archiveParticipant','class' =>''));
		$html .= '<div class="modal fade inActiveParticipantArchive" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-archive text-center text-primary helBold" id="myModalLabel">Archive User?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong class="archive_content">Are you sure you want to archive this user?</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								$html .= $this->Form->input("id_user", array("type"=>"hidden","div" => false,"label" => false,'class'=>"participantId"));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,'value'=>'unarchive','class'=>"mode"));
								$html .= $this->Form->submit("Archive", array("class" => "btn archive_button btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
					$html .='</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		$html .= $this->Form->end();
		/* Active User Archive popup */		
		
		
		/*Delete participant User start */
		$html .=	$this->Form->create('User', array('novalidate' => true,'id'=>'deleteUserValidate','url' => 'deleteParticipantUser','class' =>''));
		$html .= '<div class="modal fade deleteParticipantAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title1 text-center text-primary helBold" id="myModalLabel"> Delete Participant? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<div class="form-info-text">
										<p><strong>Are you sure you want to delete this participant? This action cannot be undone and they will lose all of their access and associated data.</strong></p>
									</div>
								</div>
							</div>	
							
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_user", array("type"=>"hidden","div" => false,"label" => false,"class"=>"participant","value"=>(isset($this->request->params['pass'][1])?$this->request->params['pass'][1]:"")));
								$html .= $this->Form->input("id_client", array("type"=>"hidden","div" => false,"label" => false,"class"=>"client","value"=>(isset($this->request->params['pass'][0])?$this->request->params['pass'][0]:"")));
								 $html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								 $html .= $this->Form->submit("Delete", array("class" => "btn btn-success btn-block text-uppercase deletebutton submitNewSkill","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
							<div class="col-md-12">';				
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Delete User end */
		
		
		/* Can't Active User Archive popup */
		$html .= '<div class="modal fade activeParticipantArchive" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-archive1 text-center text-primary helBold" id="myModalLabel">Cannot archive user</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>You cannot archive a user unless they are inactive </strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">';
								$html .= '<button type="button" class="btn btn-success btn-block text-uppercase" data-dismiss="modal">Ok</button>
							</div>						  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/* Can't Active User Archive popup */	
		
		
		return $html;	
	}
	
	
	/********Resource add and edit popup	*********/
	
	public function addEditResourcePopup()
	{
		$html = "";
		/***** Add/Edit url Resource start ***/
		$html .=	$this->Form->create('Resource', array('novalidate' => true,'id'=>'addEditResourceValidate','url' => 'addEditResource','class' =>'','onsubmit'=>'return ( $.app.validate("'.$this->Html->url(array('action'=>'ajax_validation_resource')).'", this) )'));
		
		$html .= '<div class="modal fade addEditResourcePopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box manage-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title text-center text-primary helBold" id="myModalLabel">Add Resource</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						 <div class="row">
								<div class="col-md-12">
									<!--<div class="form-group form-bordered"> -->
                                    <div class="input-group custom-input-group text-addon-group url-link-input-grp">
									   <span class="input-group-addon">http://</span>
										<div class="input text">
										';
										 $html .= $this->Form->input("link", array("class" => "form-control text-input urltxt","div" => false,"label" => false,"placeholder" => "URL link","value"=>"","id"=>"link",'type'=>'text'));
										 $html .= '
									</div>
                                </div>
							</div>
                            
							<div class="col-md-12">
								<div class="form-group form-bordered">';
									 $html .= $this->Form->input("title", array("class" => "title form-control text-input","div" => false,"label" => false,"placeholder" => "Enter Title","id"=>"title","maxlength"=>30));
									 $html .= '
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group form-bordered">
                                    <div class="select-control">';
                                        $value = array(''=>'Choose access type','mentor'=>'Mentor','mentee'=>'Mentee','both'=>'Mentee & Mentor','champion'=>'Champion');
                                        $html .= 	$this->Form->input('access', array('type'=>'select', 'label'=>false, 'options'=>$value, 'default'=>'','class'=>'resourceAccess form-control selectvalidate'));
                                     $html .= '
                                   </div>
                               </div>
							</div>
							<div class="col-md-12">
								<div class="form-group form-bordered">
                                <div class="select-control">';
									$value = array(''=>'Choose when available','post_match'=>'Post-Match','on_registration'=>'On Registration');
									$html .= 	$this->Form->input('available', array('type'=>'select', 'label'=>false, 'options'=>$value, 'default'=>'','class'=>'resourceAvailable form-control selectvalidate'));
								 $html .= '
							   </div>
							</div>
                            </div>
							
							<div class="col-md-12">
								<div id="loader-img" class="alert" style="display:none;text-align:center;"><img src="'.$this->webroot.'"img/ajax-loader1.gif";?>"></div>
							</div>
							
							<div class="col-md-6">';
								$html .= '<button type="button" class="discardPopup btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_resource", array("type"=>"hidden","div" => false,"label" => false,"class"=>"resourceId"));
								$html .= $this->Form->input("resource_type", array("type"=>"hidden","div" => false,"label" => false,"value"=>"link",'class'=>'resource_type'));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								//$html .= $this->Form->submit("Delete", array("class" => "btn btn-danger btn-block text-uppercase deletebutton submitNewSkill","div" => false,"type"=>"submit","label" => false));
								$html .= $this->Form->submit("Create", array("class" => "btn btn-success btn-block text-uppercase savebutton submitNewSkill","div" => false,"type"=>"submit","label" => false));
					$html .= '</div>	
						 </div>					  
					  </div>';
			 $html .= '
					</div>
				  </div>
				
				</div>';
		$html .= $this->Form->end();	
		/***** Add/Edit Resource end ***/
		
		
		/***** Add/Edit File Resource start ***/
		$html .=	$this->Form->create('Resource', array('novalidate' => true,'id'=>'addEditFileResourceValidate','url' => 'addEditResource','class' =>'','onsubmit'=>'return ( $.app.validate("'.$this->Html->url(array('action'=>'ajax_validation_resource')).'", this) )'));
		
		$html .= '<div class="modal fade addEditFileResourcePopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box manage-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title text-center text-primary helBold" id="myModalLabel">Add Resource</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						 <div class="row">
							<div class="col-md-12">
							
							<div class="col-md-12">
								<div class="form-group form-bordered addFile-group fileupload"><div class="addFile-unit">';
									$html .= $this->Form->input("file", array("class" => "form-control text-input","div" => false,"label" => false,"placeholder" => "",'type'=>'file',"id"=>"file",'accept'=>".doc, .docx, .docm, .dotx, .txt,.xls, .xlsx, .csv, .xlt, .xlsm, .ppt, .pptx, .pptm, .m4a, .wav, .aac, .mp3, .rar, .zip, .pdf",'style'=>'display:none'));
									 $html .= $this->Form->button("+ Add File", array("class" => "addFile form-control text-input","div" => false,"label" => false,"placeholder" => "Add File",'type'=>'button'));
									 $html .= '<div class="message"></div></div><div class="addFileProce-unit"><div class="filename"></div> 		
												<div class="progress">
														<progress id="progressBar" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%"> </progress>
													<span class="addFile-loader addFile-finish"></span>
													<a href="javascript:void(0);" class="addFile-close" rel=""></a>
												</div>
												<span id="loaded_n_total" class="help-block text-muted"></span>
												<span id="status" class="help-block text-muted"></span>
												</div>';
												
									$html .= '</div>';
									 $html .= $this->Form->input("uploadFile", array("class" => "uploadFile form-control text-input","div" => false,"label" => false,'style'=>'display:none','value'=>''));
									 
									 $html .= $this->Form->input("getfilename", array("class" => "getfilename form-control text-input","div" => false,"label" => false,'style'=>'display:none','value'=>''));
									
									 $html .= '
							    </div>
							</div>
							<div class="col-md-12">
								<div class="form-group form-bordered">';
									 $html .= $this->Form->input("title", array("class" => "title form-control text-input","div" => false,"label" => false,"placeholder" => "Enter Title","id"=>"title","maxlength"=>30));
									 $html .= '
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group form-bordered">
                                <div class="select-control">
                                ';
									$value = array(''=>'Choose access type','mentor'=>'Mentor','mentee'=>'Mentee','both'=>'Mentee & Mentor','champion'=>'Champion');
									$html .= 	$this->Form->input('access', array('type'=>'select', 'label'=>false, 'options'=>$value, 'default'=>'','class'=>'resourceAccess form-control selectvalidate','id'=>'ResourceAccess1'));
								 $html .= '
							   </div>
                               </div>
							</div>
							<div class="col-md-12">
								<div class="form-group form-bordered">
                                <div class="select-control">';
									$value = array(''=>'Choose when available','post_match'=>'Post-Match','on_registration'=>'On Registration');
									$html .= 	$this->Form->input('available', array('type'=>'select', 'label'=>false, 'options'=>$value, 'default'=>'','class'=>'resourceAvailable form-control selectvalidate','id'=>'ResourceAvailable1'));
								 $html .= '
							   </div>
                               </div>
							</div>
							
							<div class="col-md-12">
								<div id="loader-img" class="alert" style="display:none;text-align:center;"><img src="'.$this->webroot.'"img/ajax-loader1.gif";?>"></div>
							</div>
							
							<div class="col-md-6">';
								$html .= '<button type="button" class="discardFilePopup btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_resource", array("type"=>"hidden","div" => false,"label" => false,"class"=>"resourceId"));
								$html .= $this->Form->input("resource_type", array("type"=>"hidden","div" => false,"label" => false,"value"=>"file",'class'=>'resource_type'));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								$html .= $this->Form->submit("Create", array("class" => "btn btn-success btn-block text-uppercase savebutton submitNewSkill","div" => false,"type"=>"submit","label" => false));
					$html .= '</div>	
						 </div>					  
					  </div>';
			 $html .= '
					</div>
				  </div>
				</div>
				</div>
				';
		$html .= $this->Form->end();	
		/***** Add/Edit file Resource end ***/
		
		/*Delete multiple  Resource  start */
		$html .=	$this->Form->create('Resource', array('novalidate' => true,'id'=>'allResourceValidate','url' => 'deleteAllResource','class' =>''));
		$html .= '<div class="modal fade deleteAllAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-resource text-center text-primary helBold" id="myModalLabel"> Delete X Resource/s?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="form-info-text text-center">
										<p><strong class="resource_desc">Are you sure you want to delete this/these resource/s from the library? This action cannot be undone. The resource/s will remain in any programs it has previously been included in.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								$html .= $this->Form->input("selectedId", array("type"=>"hidden","div" => false,"label" => false,"class"=>"selectedId"));
								 $html .= $this->Form->submit("Delete", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Delete multiple  Resource  end */
		
		/*Delete single Resource  start */
		$html .=	$this->Form->create('Resource', array('novalidate' => true,'id'=>'resourceValidate','url' => 'deleteResource','class' =>''));
		$html .= '<div class="modal fade deleteResourceAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title1 text-center text-primary helBold" id="myModalLabel"> Delete Resource?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="form-info-text text-center">
										<p><strong>Are you sure you want to delete this resource from the program? This action cannot be undone. The resource will remain in any programs it has previously been included in.</strong></p>
									</div>
								</div>
							</div>	
							
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>

							<div class="col-md-6">';
								$html .= $this->Form->input("id_resource", array("type"=>"hidden","div" => false,"label" => false,"class"=>"resourceId"));
								 $html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								 $html .= $this->Form->submit("Delete", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Delete single Resource  start */
		
		/*Can'not Upload File  start */
		$html .= '<div class="modal fade cannotUploadFileAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-cannot-upload text-center text-primary helBold" id="myModalLabel"> Couldn’t upload file</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>The following file types are supported; .doc, .docx, . docm, .dotx, .txt,.xls, .xlsx, .csv, .xlt, .xlsm, .ppt, .pptx, .pptm, , .m4a, .wav, .aac, .mp3, .rar, .zip. Please make sure you do not upload a file larger than 20mb.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">';
								 $html .= '<button type="button" class="contupload btn btn-success btn-block text-uppercase" data-dismiss="modal">Ok</button>
							</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		/*Can'not Upload File  end */
		//$html .= $this->Html->link('','javascript:void(0)',array('class'=>'cannotUploadFileAction1','data-toggle'=>'modal','data-target'=>'.cannotUploadFileAction'));
		
		
		/* Discard url popup on cancel button*/
		$html .= '<div class="modal fade discardActionPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-discard text-center text-primary helBold" id="myModalLabel"> Discard changes? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="form-info-text text-center">
										<p><strong>Are you sure you want to discard these changes?</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								 <button type="button" class="openCurrentPopup btn btn-default btn-block text-uppercase" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								  $html .= $this->Html->link('Discard', '/admin/resources/', array('class'=>"btn btn-success btn-block text-uppercase"));
				$html .=	'</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/* Discard popup on cancel button*/
		
		/* Discard file popup on cancel button*/
		$html .= '<div class="modal fade discardFileActionPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-discard text-center text-primary helBold" id="myModalLabel"> Discard changes? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="form-info-text text-center">
										<p><strong>Are you sure you want to discard these changes?</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								 <button type="button" class="openCurrentFilePopup btn btn-default btn-block text-uppercase" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								  $html .= $this->Html->link('Discard', '/admin/resources/', array('class'=>"btn btn-success btn-block text-uppercase"));
				$html .=	'</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/* Discard popup on cancel button*/
		
		
		return $html;
	}
	/********Resource add and edit popup end*********/
	
	
	
	
	public function communicationAddEditPopup()
	{
		$html = "";
		/*Delete single communication  start */
		$html .=	$this->Form->create('Communication', array('novalidate' => true,'id'=>'communicationValidate','url' => 'deleteCommunication','class' =>''));
		$html .= '<div class="modal fade deleteCommunicationAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title1 text-center text-primary helBold" id="myModalLabel">Delete this Communication?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="col-sm-12 col-md-12">
										<p><strong>Are you sure you want to delete this Communication from the library? This action cannot be undone. The Communication will remain in any programs it has previously been included in.</strong></p>
									</div>
								</div>
							</div>	
							
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_communication", array("type"=>"hidden","div" => false,"label" => false,"class"=>"communicationId"));
								 $html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								 $html .= $this->Form->submit("Delete", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Delete single communication  start */
		
		/*Delete multiple  communication  start */
		$html .=	$this->Form->create('Communication', array('novalidate' => true,'id'=>'allCommunicationValidate','url' => 'allCommunicationDelete','class' =>''));
		$html .= '<div class="modal fade deleteAllAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-multiple-comm text-center text-primary helBold" id="myModalLabel"> Delete Communication/s?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="form-info-text text-center">
										<p><strong class="communication_msg">Are you sure you want to delete this/these Communication /s from the library? This action cannot be undone. The Communication /s will remain in any programs it has previously been included in.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								$html .= $this->Form->input("selectedId", array("type"=>"hidden","div" => false,"label" => false,"class"=>"selectedId"));
								 $html .= $this->Form->submit("Delete", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Delete multiple  communication  end */
		
		
		/* Discard popup on cancel button*/
		$html .= '<div class="modal fade discardActionPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-discard text-center text-primary helBold" id="myModalLabel"> Discard changes? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="form-info-text text-center">
										<p><strong>Are you sure you want to discard these changes?</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								 <button type="button" class="btn btn-default btn-block text-uppercase" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								  $html .= $this->Html->link('Discard', '/admin/communications/index/', array('escape' => false,'admin'=>true,'class'=>"btn btn-success btn-block text-uppercase closeExport"));
				$html .=	'</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/* Discard popup on cancel button*/
		
		/* Discard popup on cancel button*/
		$html .= '<div class="modal fade discardCommActionPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-discard text-center text-primary helBold" id="myModalLabel"> Discard changes? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="form-info-text text-center">
										<p><strong>Are you sure you want to discard these changes?</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								 <button type="button" class="btn btn-default btn-block text-uppercase" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								  $html .= $this->Html->link('Discard', '/admin/programs/communications/'.(isset($this->request->params['pass'][0])?$this->request->params['pass'][0]:""), array('escape' => false,'admin'=>true,'class'=>"btn btn-success btn-block text-uppercase closeExport"));
				$html .=	'</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/* Discard popup on cancel button*/
		return $html;	
	}
	
	
	/* Client create popup start */
	public function addEditProgram()
	{
		App::import('Model','Client');
        $this->Client = new Client();
        $getAllClients = $this->Client->getAllClients();
        //echo "<pre>";
        //print_r($getAllClients);
		$html  = 	"";
		$html .= '<div class="modal fade addEditProgram" id="addEditProgram" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content form-box">
							<div class="modal-header form-box-head">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title text-center text-primary helBold">Create company</h2>
							</div>
							<div class="modal-body form-box-body">';
							$html .=	$this->Form->create('Program', array('novalidate' => true,'id'=>'addEditProgramValidate','url' => 'addEditProgram','class' =>'','onsubmit'=>'return ( $.app.validate("'.$this->Html->url(array('action'=>'ajax_validation_addEditProgram')).'", this) )'));
							$html .='<div class="row">
										<div class="col-md-12">
											<div class="form-group select-control select-max program-client-name">
												<select id="" class="selectpicker show-menu-arrow" title="Client Name" name="data[Program][id_client]" data-live-search="true">';
													
													foreach($getAllClients as $key=>$value)
													{
														$html .='<option value="'.$value['Client']['id_client'].'" data-subtext="'.$value['Client']['url'].'.artofmentoring.net">'.ucfirst($value['Client']['name']).'</option>';
													}	
													
										$html .='</select>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group form-bordered">';
											 $html .= $this->Form->input("program_name", array("class" => "form-control text-input","div" => false,"label" => false,"placeholder" => "Program Name","maxlength"=>25));
							$html .= '</div></div>
									<div class="col-md-12">
										<div class="input-group custom-input-group text-addon-group url-input-group">
											<span class="input-group-addon"><span class="info-tooltip" data-toggle="tooltip" data-placement="top" title="If indexed, users are able to find the program site from a search engine.">i</span> Index URL?</span>
											<div class="select-control">';
												$value = array(''=>'Choose Option','1'=>'Yes','0'=>'No');
												$html .= 	$this->Form->input('indexed', array('type'=>'select', 'label'=>false, 'options'=>$value, 'default'=>'','class'=>'form-control'));
									$html .= '</div>
										</div>
									</div>
									<div class="col-md-6">';
										$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11 helBold" data-dismiss="modal">Cancel</button>
									</div>
									
									<div class="col-md-6">';
										//$html .= $this->Form->input("id_client", array("type"=>"hidden","div" => false,"label" => false,"class"=>"clientId"));
										$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
										$html .= $this->Form->button("Create", array("class" => "btn btn-success btn-block text-uppercase savebutton addProgram helBold","div" => false,"type"=>"button","label" => false));
							$html .= '</div>	
								</div>';
							$html .= $this->Form->end();
						$html .='</div>
						</div>
					</div>
					</div>
				</div>';
				
				/* Discard popup on cancel button*/
				$html .= '<div class="modal fade discardActionPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
							<div class="modal-content form-box delete-admin-modal-box">
							  <div class="modal-header form-box-head">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h2 class="modal-title-discard text-center text-primary helBold" id="myModalLabel"> Create New Program? </h2>
							  </div>
							  <div class="modal-body form-box-body"> 
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="form-group form-bordered">
											<div class="form-info-text text-center">
												<p><strong>You cannot change these details or the program URL after creation. Are you sure you want to create this new program?</strong></p>
											</div>
										</div>
									</div>	
									<div class="col-md-6">
										 <button type="button" class="btn btn-default btn-block text-uppercase" data-dismiss="modal">Cancel</button>
									</div>
									<div class="col-md-6">';
										 $html .= $this->Form->button("Create", array("class" => "btn btn-success btn-block text-uppercase submitProgramData","div" => false,"type"=>"button","label" => false));
						$html .=	'</div>							  
							  </div>
							 </div>
							</div>
						  </div>
						</div>';	
				/* Discard popup on cancel button*/
				
				
		/*Extention upload*/
		$html .= '<div class="modal fade cannotUploadFileAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-cannot-upload text-center text-primary helBold" id="myModalLabel"> Invalid file type</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>Please make sure your file is JPG, GIF, BMP or PNG and less than 5mb.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">';
								 $html .= '<button type="button" class="contupload btn btn-success btn-block text-uppercase" data-dismiss="modal">Ok</button>
							</div>
						</div>
					 </div>
					</div>
				  </div>
				  </div>
				';
		/*Extention upload end*/
				
		/*Max files upload popup */
		$html .= '<div class="modal fade maxUploadFileAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-cannot-upload text-center text-primary helBold" id="myModalLabel"> Amount Exceeds</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>You can upload 10 files.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">';
								 $html .= '<button type="button" class="contupload btn btn-success btn-block text-uppercase" data-dismiss="modal">Ok</button>
							</div>
						</div>
					 </div>
					</div>
				  </div>
				  </div>
				';
		/*Max files upload popup End*/		
		
		/* Discard popup on cancel button*/
		$html .= '<div class="modal fade editDiscardActionPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-discard text-center text-primary helBold" id="myModalLabel"> Discard changes? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>Are you sure you want to discard these changes?</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								 <button type="button" class="btn btn-default btn-block text-uppercase" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								  $html .= $this->Html->link('Discard', '/admin/programs/general/'.(isset($this->request->params['pass'][0])?$this->request->params['pass'][0]:""), array('escape' => false,'admin'=>true,'class'=>"btn btn-success btn-block text-uppercase closeExport"));
				$html .=	'</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/* Discard popup on cancel button*/
		
		
		/*Delete single Program  start */
		$html .=	$this->Form->create('Program', array('novalidate' => true,'id'=>'programValidate','url' => 'deleteProgram','class' =>''));
		$html .= '<div class="modal fade deleteProgramnAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title1 text-center text-primary helBold" id="myModalLabel">Delete Program?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>Are you sure you want to delete this program? This action cannot be un done, all program data will be deleted.</strong></p>
									</div>
								</div>
							</div>	
							
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_program", array("type"=>"hidden","div" => false,"label" => false,"class"=>"programId"));
								 $html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								 $html .= $this->Form->submit("Delete", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Delete single communication  start */
		
		
		/*Cannot Delete single Program  start */
		$html .= '<div class="modal fade cannotDeleteProgramnAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title1 text-center text-primary helBold" id="myModalLabel">Cannot Delete</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>You cannot delete a program unless it is inactive.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">';
								 $html .= '<button type="button" class="btn suspend_button btn-success btn-block text-uppercase" data-dismiss="modal">Ok</button>
							</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>';
		/*Cannot Delete single communication  start */
		
		
		/*Archive Program  start */
		$html .=	$this->Form->create('Program', array('novalidate' => true,'id'=>'archiveValidate','url' => 'archiveProgram','class' =>''));
		$html .= '<div class="modal fade archiveProgramnAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title1 text-center text-primary helBold" id="myModalLabel">Archive Program?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>Are you sure you want to archive this program?</strong></p>
									</div>
								</div>
							</div>	
							
							<div class="col-md-6">';
								 //$html .= $this->Html->link('Cancel', '/admin/programs/', array('admin'=>true,'class'=>"btn btn-default btn-block text-uppercase closebutton11"));
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>';
						$html .=  '</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_program", array("type"=>"hidden","div" => false,"label" => false,"class"=>"programId"));
								 $html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								 $html .= $this->Form->submit("Archive", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Archive Program  end */
		
		
		/*unArchive Program  start */
		$html .=	$this->Form->create('Program', array('novalidate' => true,'id'=>'unArchiveValidate','url' => 'unArchiveProgram','class' =>''));
		$html .= '<div class="modal fade unArchiveProgramnAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title1 text-center text-primary helBold" id="myModalLabel">Unarchive program?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>Are you sure you want to unarchive this program?</strong></p>
									</div>
								</div>
							</div>	
							
							<div class="col-md-6">';
								// $html .= $this->Html->link('Cancel', '/admin/programs/', array('admin'=>true,'class'=>"btn btn-default btn-block text-uppercase closebutton11"));
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>';
						$html .=  '</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_program", array("type"=>"hidden","div" => false,"label" => false,"class"=>"programId"));
								 $html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								 $html .= $this->Form->submit("Unarchive", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*unArchive Program  end */
		
		/*Cannot Archived single Program  start */
		$html .= '<div class="modal fade cannotProgramArchiveAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title2 text-center text-primary helBold" id="myModalLabel">Cannot archive program?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>You cannot archive a program unless they are inactive.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">';
								 $html .= '<button type="button" class="btn suspend_button btn-success btn-block text-uppercase" data-dismiss="modal">Ok</button>
							</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>';
		/*Cannot Archived single communication  start */
		
		/*Export csv data popup */
		$html .= '<div class="modal fade exportCsvProgram" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-export text-center text-primary helBold" id="myModalLabel">Export Data?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>This will export all results to a .csv file </strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closeExportPopup" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								 $html .= $this->Html->link('Export', '/admin/programs/exportProgramsUsingCSV/', array('escape' => false,'admin'=>true,'class'=>"btn btn-success btn-block text-uppercase closeExport"));
					$html .='</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';
		/*Export csv data popup end */
		
		/*Export xls data popup */
		$html .= '<div class="modal fade exportXlsProgram" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-export text-center text-primary helBold" id="myModalLabel">Export Data?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>This will export all results to a .xls file </strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closeExportPopup" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								 $html .= $this->Html->link('Export', '/admin/programs/exportProgramsUsingXLS/', array('escape' => false,'admin'=>true,'class'=>"btn btn-success btn-block text-uppercase closeExport"));
					$html .='</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
				
		/*Launch Program  start */
		$html .=	$this->Form->create('Program', array('novalidate' => true,'id'=>'programLanchValidate','url' => 'lanchProgram','class' =>''));
		$html .= '<div class="modal fade launchProgramnAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title1 text-center text-primary helBold" id="myModalLabel">Launch Program?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>Are you sure you want to launch this program?</strong></p>
									</div>
								</div>
							</div>	
							
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_program", array("type"=>"hidden","div" => false,"label" => false,"class"=>"programId"));
								 $html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								 $html .= $this->Form->submit("Launch", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/* Launch Program end */
		
		/*Suspend Unsupend Program start */
		$html .=	$this->Form->create('Program', array('novalidate' => true,'id'=>'suspendedValidate','url' => 'suspendProgram','class' =>''));
		$html .= '<div class="modal fade SuspendAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box reset-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-suspended text-center text-primary helBold" id="myModalLabel"> Suspend Program? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						  <div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong class="content_msg">Are you sure you want to suspend this program? All associated users will lose access to their account whilst they are suspended. All dates and match progression will be frozen.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								$html .= $this->Form->input("id_program", array("type"=>"hidden","div" => false,"label" => false,"class"=>"programId"));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,'value'=>'suspended','class'=>"mode"));
								$html .= $this->Form->submit("Suspend", array("class" => "btn suspend_button btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .= '</div>				  
						</div>
					</div>
				  </div>
				</div>
				</div>
				';
		$html .= $this->Form->end();
		$html .= "<style>
					tr th:nth-child(8) { visibility: hidden; }
				</style>";	
	
		/*Suspend Unsupend Program end */
		
		
		/*Unsupend Program start */
		$html .=	$this->Form->create('Program', array('novalidate' => true,'id'=>'unSuspendedValidate','url' => 'unsuspendProgram','class' =>''));
		$html .= '<div class="modal fade unsuspendAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box reset-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-suspended text-center text-primary helBold" id="myModalLabel"> Unsuspend Program? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						  <div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong class="content_msg">Are you sure you want to unsuspend this program? All associated users will regain their access to their account.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								$html .= $this->Form->input("id_program", array("type"=>"hidden","div" => false,"label" => false,"class"=>"programId"));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,'value'=>'unsuspended','class'=>"mode"));
								$html .= $this->Form->submit("Unsuspend", array("class" => "btn suspend_button btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .= '</div>				  
						</div>
					</div>
				  </div>
				</div>
				</div>
				';
		$html .= $this->Form->end();
		$html .= "<style>
					tr th:nth-child(8) { visibility: hidden; }
				</style>";	
	
		/*Unsupend Program end */
		return 	$html;
	}
	
	public function generalProgram($programId = null)
	{
		$html = "";
		/*Export csv data popup */
		$html .= '<div class="modal fade exportCsvProgram" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-export text-center text-primary helBold" id="myModalLabel">Export Data?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>This will export all results to a .csv file </strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closeExportPopup" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								 $html .= $this->Html->link('Export', '/admin/programs/exportProgramsUsingCSV/'.$programId, array('escape' => false,'admin'=>true,'class'=>"btn btn-success btn-block text-uppercase closeExport"));
					$html .='</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';
		/*Export csv data popup end */
		
		/*Export xls data popup */
		$html .= '<div class="modal fade exportXlsProgram" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-export text-center text-primary helBold" id="myModalLabel">Export Data?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>This will export all results to a .xls file </strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closeExportPopup" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								 $html .= $this->Html->link('Export', '/admin/programs/exportProgramsUsingXLS/'.$programId, array('escape' => false,'admin'=>true,'class'=>"btn btn-success btn-block text-uppercase closeExport"));
					$html .='</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
				
		/*Launch Program  start */
		
		
		/*Suspend Unsupend Program start */
		$html .=	$this->Form->create('Program', array('novalidate' => true,'id'=>'suspendedValidate','url' => 'suspendProgram','class' =>''));
		$html .= '<div class="modal fade SuspendAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box reset-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-suspended text-center text-primary helBold" id="myModalLabel"> Suspend Program? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						  <div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong class="content_msg">Are you sure you want to suspend this program? All associated users will lose access to their account whilst they are suspended. All dates and match progression will be frozen.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								$html .= $this->Form->input("id_program", array("type"=>"hidden","div" => false,"label" => false,"class"=>"programId"));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,'value'=>'suspended','class'=>"mode"));
								$html .= $this->Form->submit("Suspend", array("class" => "btn suspend_button btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .= '</div>				  
						</div>
					</div>
				  </div>
				</div>
				</div>
				';
		$html .= $this->Form->end();
		$html .= "<style>
					tr th:nth-child(8) { visibility: hidden; }
				</style>";	
	
		/*Suspend Unsupend Program end */
		
		
		/*Unsupend Program start */
		$html .=	$this->Form->create('Program', array('novalidate' => true,'id'=>'unSuspendedValidate','url' => 'unsuspendProgram','class' =>''));
		$html .= '<div class="modal fade unsuspendAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box reset-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-suspended text-center text-primary helBold" id="myModalLabel"> Unsuspend Program? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						  <div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong class="content_msg">Are you sure you want to unsuspend this program? All associated users will regain their access to their account.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								$html .= $this->Form->input("id_program", array("type"=>"hidden","div" => false,"label" => false,"class"=>"programId"));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,'value'=>'unsuspended','class'=>"mode"));
								$html .= $this->Form->submit("Unsuspend", array("class" => "btn suspend_button btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .= '</div>				  
						</div>
					</div>
				  </div>
				</div>
				</div>
				';
		$html .= $this->Form->end();
		$html .= "<style>
					tr th:nth-child(8) { visibility: hidden; }
				</style>";	
	
		/*Unsupend Program end */
		
		/*Delete single Program  start */
		$html .=	$this->Form->create('Program', array('novalidate' => true,'id'=>'programValidate','url' => 'deleteProgram','class' =>''));
		$html .= '<div class="modal fade deleteProgramnAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title1 text-center text-primary helBold" id="myModalLabel">Delete Program?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>Are you sure you want to delete this program? This action cannot be un done, all program data will be deleted.</strong></p>
									</div>
								</div>
							</div>	
							
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_program", array("type"=>"hidden","div" => false,"label" => false,"class"=>"programId"));
								 $html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								 $html .= $this->Form->submit("Delete", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Delete single communication  start */
		
		
		/*Cannot Delete single Program  start */
		$html .= '<div class="modal fade cannotDeleteProgramnAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title1 text-center text-primary helBold" id="myModalLabel">Cannot Delete</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>You cannot delete a program unless it is inactive.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">';
								 $html .= '<button type="button" class="btn suspend_button btn-success btn-block text-uppercase" data-dismiss="modal">Ok</button>
							</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>';
		/*Cannot Delete single communication  start */
		
		/*Launch Program  start */
		$html .=	$this->Form->create('Program', array('novalidate' => true,'id'=>'programLanchValidate','url' => 'lanchProgram','class' =>''));
		$html .= '<div class="modal fade launchProgramnAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title1 text-center text-primary helBold" id="myModalLabel">Launch Program?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>Are you sure you want to launch this program?</strong></p>
									</div>
								</div>
							</div>	
							
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_program", array("type"=>"hidden","div" => false,"label" => false,"class"=>"programId"));
								 $html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								 $html .= $this->Form->submit("Launch", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/* Launch Program end */
		
		/*Archive Program  start */
		$html .=	$this->Form->create('Program', array('novalidate' => true,'id'=>'archiveValidate','url' => 'archiveProgram','class' =>''));
		$html .= '<div class="modal fade archiveProgramnAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title1 text-center text-primary helBold" id="myModalLabel">Archive Program?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>Are you sure you want to archive this program?</strong></p>
									</div>
								</div>
							</div>	
							
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>';
						$html .=  '</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_program", array("type"=>"hidden","div" => false,"label" => false,"class"=>"programId"));
								 $html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								 $html .= $this->Form->submit("Archive", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Archive Program  end */
		
		
		/*unArchive Program  start */
		$html .=	$this->Form->create('Program', array('novalidate' => true,'id'=>'unArchiveValidate','url' => 'unArchiveProgram','class' =>''));
		$html .= '<div class="modal fade unArchiveProgramnAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title1 text-center text-primary helBold" id="myModalLabel">Unarchive program?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>Are you sure you want to unarchive this program?</strong></p>
									</div>
								</div>
							</div>	
							
							<div class="col-md-6">';
								 $html .= $this->Html->link('Cancel', '/admin/programs/', array('admin'=>true,'class'=>"btn btn-default btn-block text-uppercase closebutton11"));
						$html .=  '</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_program", array("type"=>"hidden","div" => false,"label" => false,"class"=>"programId"));
								 $html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								 $html .= $this->Form->submit("Unarchive", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*unArchive Program  end */
		
		/*Cannot Archived single Program  start */
		$html .= '<div class="modal fade cannotProgramArchiveAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title2 text-center text-primary helBold" id="myModalLabel">Cannot archive program?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>You cannot archive a program unless they are inactive.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">';
								 $html .= '<button type="button" class="btn suspend_button btn-success btn-block text-uppercase" data-dismiss="modal">Ok</button>
							</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>';
		/*Cannot Archived single communication  start */
		
		return $html;
	}	
	
	public function programResource($progId)
	{
		$html = '';
		
		/*Delete single Program  start */
		$html .=	$this->Form->create('Program', array('novalidate' => true,'id'=>'programValidate','url' => 'deleteProgramResource','class' =>''));
		$html .= '<div class="modal fade deleteProgramnResourceAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title1 text-center text-primary helBold" id="myModalLabel">Remove Resource?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>Are you sure you want to remove this resource from the program?</strong></p>
									</div>
								</div>
							</div>	
							
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_program_resource", array("type"=>"hidden","div" => false,"label" => false,"class"=>"resourceId"));
								 $html .= $this->Form->submit("Remove", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Delete single communication  start */
		
		/***** Add/Edit url Resource start ***/
		$html .=	$this->Form->create('ProgramResource', array('novalidate' => true,'id'=>'addEditResourceValidate','url' => array('controller'=>'Programs', 'action'=>'addEditResource'),'class' =>'','onsubmit'=>'return ( $.app.validate("'.$this->Html->url(array('controller'=>'Programs','action'=>'ajax_validation_program_resource')).'", this) )'));
		
		$html .= '<div class="modal fade addEditResourcePopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box manage-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close close1" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title text-center text-primary helBold" id="myModalLabel">Add Resource</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						 <div class="row">
								<div class="col-md-12">
									<!--<div class="form-group form-bordered"> -->
                                    <div class="input-group custom-input-group text-addon-group url-link-input-grp">
									   <span class="input-group-addon">http://</span>
										<div class="input text">
										';
										 $html .= $this->Form->input("link", array("class" => "form-control text-input urltxt","div" => false,"label" => false,"placeholder" => "URL link","value"=>"","id"=>"link",'type'=>'text'));
										 $html .= '
									</div>
                                </div>
							</div>
                            
							<div class="col-md-12">
								<div class="form-group form-bordered">';
									 $html .= $this->Form->input("title", array("class" => "title form-control text-input","div" => false,"label" => false,"placeholder" => "Enter Title","id"=>"title","maxlength"=>30));
									 $html .= '
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group form-bordered">
                                    <div class="select-control">';
                                        $value = array(''=>'Choose access type','mentor'=>'Mentor','mentee'=>'Mentee','both'=>'Mentee & Mentor','champion'=>'Champion');
                                        $html .= 	$this->Form->input('access', array('type'=>'select', 'label'=>false, 'options'=>$value, 'default'=>'','class'=>'resourceAccess form-control selectvalidate'));
                                     $html .= '
                                   </div>
                               </div>
							</div>
							<div class="col-md-12">
								<div class="form-group form-bordered">
                                <div class="select-control">';
									$value = array(''=>'Choose when available','post_match'=>'Post-Match','on_registration'=>'On Registration');
									$html .= 	$this->Form->input('available', array('type'=>'select', 'label'=>false, 'options'=>$value, 'default'=>'','class'=>'resourceAvailable form-control selectvalidate'));
								 $html .= '
							   </div>
							</div>
                            </div>
							
							<div class="col-md-12">
								<div id="loader-img" class="alert" style="display:none;text-align:center;"><img src="'.$this->webroot.'"img/ajax-loader1.gif";?>"></div>
							</div>
							
							<div class="col-md-12">
								<div class="pull-left editlibrary">
									<div class="checkbox custom-checkbox helBold">
										<input type="checkbox" name="saveLibrary" id="keepSigned_check">
										<label for="keepSigned_check" class="text-primary helRegular">Save to Library</label>
									</div>
								</div>
							</div>
							
							
							<div class="col-md-6">';
								$html .= '<button type="button" class="discardPopup btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_program", array("type"=>"hidden","div" => false,"label" => false,"class"=>"id_program",'value'=>(isset($this->request->params['pass'][0])?$this->request->params['pass'][0]:"")));
								$html .= $this->Form->input("id_program_resource", array("type"=>"hidden","div" => false,"label" => false,"class"=>"resourceId"));
								$html .= $this->Form->input("resource_type", array("type"=>"hidden","div" => false,"label" => false,"value"=>"link",'class'=>'resource_type'));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								//$html .= $this->Form->submit("Delete", array("class" => "btn btn-danger btn-block text-uppercase deletebutton submitNewSkill","div" => false,"type"=>"submit","label" => false));
								$html .= $this->Form->submit("Create", array("class" => "btn btn-success btn-block text-uppercase savebutton submitNewSkill","div" => false,"type"=>"submit","label" => false));
					$html .= '</div>	
						 </div>					  
					  </div>';
			 $html .= '
					</div>
				  </div>
				
				</div>';
		$html .= $this->Form->end();	
		/***** Add/Edit Resource end ***/
		
		
		/***** Add/Edit File Resource start ***/
		$html .=	$this->Form->create('ProgramResource', array('novalidate' => true,'id'=>'addEditFileResourceValidate','url' => array('controller'=>'Programs', 'action'=>'addEditResource'),'class' =>'','onsubmit'=>'return ( $.app.validate("'.$this->Html->url(array('controller'=>'Programs','action'=>'ajax_validation_program_resource')).'", this) )'));
		
		$html .= '<div class="modal fade addEditFileResourcePopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box manage-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close close1" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title text-center text-primary helBold" id="myModalLabel">Add Resource</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						 <div class="row">
							<div class="col-md-12">
							
							<div class="col-md-12">
								<div class="form-group form-bordered addFile-group fileupload"><div class="addFile-unit">';
									$html .= $this->Form->input("file", array("class" => "form-control text-input","div" => false,"label" => false,"placeholder" => "",'type'=>'file',"id"=>"file",'accept'=>".doc, .docx, .docm, .dotx, .txt,.xls, .xlsx, .csv, .xlt, .xlsm, .ppt, .pptx, .pptm, .m4a, .wav, .aac, .mp3, .rar, .zip, .pdf",'style'=>'display:none'));
									 $html .= $this->Form->button("+ Add File", array("class" => "addFile form-control text-input","div" => false,"label" => false,"placeholder" => "Add File",'type'=>'button'));
									 $html .= '<div class="message"></div></div><div class="addFileProce-unit"><div class="filename"></div> 		
												<div class="progress">
														<progress id="progressBar" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%"> </progress>
													<span class="addFile-loader addFile-finish"></span>
													<a href="javascript:void(0);" class="addFile-close" rel=""></a>
												</div>
												<span id="loaded_n_total" class="help-block text-muted"></span>
												<span id="status" class="help-block text-muted"></span>
												</div>';
												
									$html .= '</div>';
									 $html .= $this->Form->input("uploadFile", array("class" => "uploadFile form-control text-input","div" => false,"label" => false,'style'=>'display:none','value'=>'','id'=>'ResourceUploadFile'));
									 
									 $html .= $this->Form->input("getfilename", array("class" => "getfilename form-control text-input","div" => false,"label" => false,'style'=>'display:none','value'=>''));
									
									 $html .= '
							    </div>
							</div>
							<div class="col-md-12">
								<div class="form-group form-bordered">';
									 $html .= $this->Form->input("title", array("class" => "title form-control text-input","div" => false,"label" => false,"placeholder" => "Enter Title","id"=>"title","maxlength"=>30));
									 $html .= '
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group form-bordered">
                                <div class="select-control">
                                ';
									$value = array(''=>'Choose access type','mentor'=>'Mentor','mentee'=>'Mentee','both'=>'Mentee & Mentor','champion'=>'Champion');
									$html .= 	$this->Form->input('access', array('type'=>'select', 'label'=>false, 'options'=>$value, 'default'=>'','class'=>'resourceAccess form-control selectvalidate','id'=>'ResourceAccess1'));
								 $html .= '
							   </div>
                               </div>
							</div>
							<div class="col-md-12">
								<div class="form-group form-bordered">
                                <div class="select-control">';
									$value = array(''=>'Choose when available','post_match'=>'Post-Match','on_registration'=>'On Registration');
									$html .= 	$this->Form->input('available', array('type'=>'select', 'label'=>false, 'options'=>$value, 'default'=>'','class'=>'resourceAvailable form-control selectvalidate','id'=>'ResourceAvailable1'));
								 $html .= '
							   </div>
                               </div>
							</div>
							
							<div class="col-md-12">
								<div id="loader-img" class="alert" style="display:none;text-align:center;"><img src="'.$this->webroot.'"img/ajax-loader1.gif";?>"></div>
							</div>
							
							<div class="col-md-12">
								<div class="pull-left editlibrary">
									<div class="checkbox custom-checkbox helBold">
										<input type="checkbox" name="saveLibrary" id="keepSigned_check_1">
										<label for="keepSigned_check_1" class="text-primary helRegular">Save to Library</label>
									</div>
								</div>
							</div>
							
							<div class="col-md-6">';
								$html .= '<button type="button" class="discardFilePopup btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_program", array("type"=>"hidden","div" => false,"label" => false,"class"=>"id_program",'value'=>(isset($this->request->params['pass'][0])?$this->request->params['pass'][0]:"")));
								$html .= $this->Form->input("id_program_resource", array("type"=>"hidden","div" => false,"label" => false,"class"=>"resourceId"));
								$html .= $this->Form->input("resource_type", array("type"=>"hidden","div" => false,"label" => false,"value"=>"file",'class'=>'resource_type'));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								$html .= $this->Form->submit("Create", array("class" => "btn btn-success btn-block text-uppercase savebutton submitNewSkill","div" => false,"type"=>"submit","label" => false));
					$html .= '</div>	
						 </div>					  
					  </div>';
			 $html .= '
					</div>
				  </div>
				</div>
				</div>
				';
		$html .= $this->Form->end();	
		/***** Add/Edit file Resource end ***/
		
		/*Can'not Upload File  start */
		$html .= '<div class="modal fade cannotUploadFileAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-cannot-upload text-center text-primary helBold" id="myModalLabel"> Couldn’t upload file</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>The following file types are supported; .doc, .docx, . docm, .dotx, .txt,.xls, .xlsx, .csv, .xlt, .xlsm, .ppt, .pptx, .pptm, , .m4a, .wav, .aac, .mp3, .rar, .zip. Please make sure you do not upload a file larger than 20mb.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">';
								 $html .= '<button type="button" class="contupload btn btn-success btn-block text-uppercase" data-dismiss="modal">Ok</button>
							</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		/*Can'not Upload File  end */
		//$html .= $this->Html->link('','javascript:void(0)',array('class'=>'cannotUploadFileAction1','data-toggle'=>'modal','data-target'=>'.cannotUploadFileAction'));
		
		
		/* Discard url popup on cancel button*/
		$html .= '<div class="modal fade discardActionPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-discard text-center text-primary helBold" id="myModalLabel"> Discard changes? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="form-info-text text-center">
										<p><strong>Are you sure you want to discard these changes?</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								 <button type="button" class="openCurrentPopup btn btn-default btn-block text-uppercase" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								  $html .= $this->Html->link('Discard', '/admin/programs/', array('class'=>"btn btn-success btn-block text-uppercase"));
				$html .=	'</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/* Discard popup on cancel button*/
		
		/* Discard file popup on cancel button*/
		$html .= '<div class="modal fade discardFileActionPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-discard text-center text-primary helBold" id="myModalLabel"> Discard changes? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="form-info-text text-center">
										<p><strong>Are you sure you want to discard these changes?</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								 <button type="button" class="openCurrentFilePopup btn btn-default btn-block text-uppercase" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								  $html .= $this->Html->link('Discard', '/admin/programs/resources/'.(isset($this->request->params['pass'][0])?$this->request->params['pass'][0]:""), array('class'=>"btn btn-success btn-block text-uppercase"));
				$html .=	'</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/* Discard popup on cancel button*/
		
		App::import('Model','Resource');
        $this->Resource  = new Resource();
        $getProgramResources 	= $this->Resource->getProgramResources($progId);
        //echo "<pre>";
        //print_r($getProgramResources);die;
        $html .=	$this->Form->create('ProgramResource', array('novalidate' => true,'id'=>'addprogramResourceValidate','url' => 'addProgramResource','class' =>''));
		$html .= '<div class="modal fade noSpace-modal addProgramResourcePopup" id="addResources" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content form-box">
					<div class="modal-header form-box-head">
						<button type="button" class="close close1" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="text-center text-primary helBold">Add Resource</h2>
					</div>
					
					<div class="modal-body form-box-body">
						<div class="form-group form-bordered search-full">
							<input name="" class="form-control" placeholder="Enter Title or File Name" id="programFindResource" type="text">
						</div>
						<div class="table-responsive font20">
							<table id="employee-grid22" class="table table-condensed">
								<tbody id="gotResults">';
								//echo $progId;die;
								if(count($getProgramResources) > 0)
								{
									foreach($getProgramResources as $key=>$value)
									{
											if($value['Resource']['type']	== 'file')
											{
												$fileName	= 	$value['Resource']['file'];
											}
											else
											{
												$fileName	= 	$value['Resource']['link'];	
											}
											$html .= '<tr>
														<td class="checkbox-col">
															<div class="checkbox custom-checkbox">
																<input name="resourceSelected[]" class="selectedcheckbox checkboxSelectBox" id="keepSigned_'.$value['Resource']['id_resource'].'" value="'.$value['Resource']['id_resource'].'" type="checkbox">
																<label for="keepSigned_'.$value['Resource']['id_resource'].'"></label>
																<input name="added_by['.$value['Resource']['id_resource'].']"  value="'.$value['Resource']['added_by'].'" type="text" style="display:none">
															</div>
														</td>
														<td class="ar-title text-primary">'.ucfirst($value['Resource']['title']).'</td>
														<td class="text-primary">'.$fileName.'</td>
													</tr>';
									}
								}
								else
								{
									$html .= '<tr>
												<td colspan="3" style="text-align: center;">No data available in table</td>
											</tr>';
								}		
						$html .= '</tbody>
							</table>
						</div>
						<!--<ul class="dropdown-menu">
						<li>								
						<a data-target=".addEditResourcePopup" data-toggle="modal" data-backdrop="static" class="clearResourceForm" href="javascript:void(0)">Create URL</a>						</li>
						<li>
						<a data-target=".addEditFileResourcePopup" data-toggle="modal" data-backdrop="static" class="clearResourceForm" href="javascript:void(0)">Create File</a>						</li>
					  </ul>-->
					  
					  
						<div class="row btns-group">
							<div class="col-md-4">
								<button type="button" data-target=".addEditFileResourcePopup" data-toggle="modal" data-backdrop="static"  class="clearResourceForm btn btn-default btn-block text-uppercase helBold">Create New File</button>
							</div>
							<div class="col-md-4">
								<button type="button" data-target=".addEditResourcePopup" data-toggle="modal" data-backdrop="static" class="clearResourceForm btn btn-default btn-block text-uppercase helBold">Create New URL</button>
							</div>
							<div class="col-md-4">
								 <button type="button" data-target=".addProgramResoucesPopup" data-toggle="modal" data-backdrop="static" class="btn btn-success btn-default btn-block text-uppercase helBold selectedcheckbox addResourceCount" disabled>Add</button>
								 
								 ';
								$html .= $this->Form->input("programId", array("type"=>"hidden","div" => false,"label" => false,"class"=>"programId",'value'=>$progId));
								
								 $html .= $this->Form->submit("Unarchive", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false,"style"=>'display:none;'));
							 $html .='</div>
						</div>
						
					</div>
					
				</div>
			</div>
		</div>
		<script>
			$(".close").on("click",function(){
					//location.reload();
			});
		</script>
		';
		$html .= $this->Form->end();	
		
		/* Add resource popup on button*/
		$html .= '<div class="modal fade addProgramResoucesPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-addResource text-center text-primary helBold" id="myModalLabel"> Add (X) Resource/s</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="form-info-text text-center">
										<p><strong class="content_text">Are you sure you want to add this / these Resource/s to this program? Please note, their default rules will apply
										</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								 <button type="button" class="btn btn-default btn-block text-uppercase" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">
								 <button type="button" class="btn btn-default btn-block text-uppercase btn-success saveAddResourcebutton" data-dismiss="modal">Add</button>
							</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/* Discard popup on cancel button*/
		
		return $html;	
	}
	
	public function programNote($program_id = null)
	{
		$html = '';
		/* Discard popup on cancel button*/
		$html .= '<div class="modal fade discardActionPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-discard text-center text-primary helBold" id="myModalLabel"> Discard changes? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="form-info-text text-center">
										<p><strong>Are you sure you want to discard these changes?</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								 <button type="button" class="btn btn-default btn-block text-uppercase" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								  $html .= $this->Html->link('Discard', '/admin/programs/notes/'.$program_id.'/', array('escape' => false,'admin'=>true,'class'=>"btn btn-success btn-block text-uppercase closeExport"));
				$html .=	'</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/* Discard popup on cancel button*/
		return $html;	
	}	
	
	
	public function programLandingPage($program_id = null)
	{
		$html = '';
		/* Discard popup on cancel button*/
		$html .= '<div class="modal fade editDiscardActionPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-discard text-center text-primary helBold" id="myModalLabel"> Discard changes? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>Are you sure you want to discard these changes?</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								 <button type="button" class="btn btn-default btn-block text-uppercase" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								  $html .= $this->Html->link('Discard', '/admin/programs/landingPage/'.(isset($this->request->params['pass'][0])?$this->request->params['pass'][0]:""), array('escape' => false,'admin'=>true,'class'=>"btn btn-success btn-block text-uppercase closeExport"));
				$html .=	'</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/* Discard popup on cancel button*/
		
		/*Max files upload popup */
		$html .= '<div class="modal fade maxUploadFileAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-cannot-upload text-center text-primary helBold" id="myModalLabel"> Amount Exceeds</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>You can upload 5 files.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">';
								 $html .= '<button type="button" class="contupload btn btn-success btn-block text-uppercase" data-dismiss="modal">Ok</button>
							</div>
						</div>
					 </div>
					</div>
				  </div>
				  </div>
				';
		/*Max files upload popup End*/	
		
		$html .= '<div class="modal fade cannotUploadFileAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-cannot-upload text-center text-primary helBold" id="myModalLabel"> Invalid file type</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>Please make sure your file is JPG, GIF, BMP or PNG and less than 5mb.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">';
								 $html .= '<button type="button" class="contupload btn btn-success btn-block text-uppercase" data-dismiss="modal">Ok</button>
							</div>
						</div>
					 </div>
					</div>
				  </div>
				  </div>
				';
		/*Extention upload end*/
		
		$html .= '<div class="modal fade cannotUploadFileSizeAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-cannot-upload text-center text-primary helBold" id="myModalLabel"> Invalid file width and height</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>Please make sure your file width and height less than 2560 x 1440 pixels. </strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">';
								 $html .= '<button type="button" class="contupload btn btn-success btn-block text-uppercase" data-dismiss="modal">Ok</button>
							</div>
						</div>
					 </div>
					</div>
				  </div>
				  </div>
				';
		/*Extention upload end*/
		
		return $html;
	}
	
	function ProgramChampion($progId = null,$clientId = null)
	{
		$html = "";
		/* Add new champion popup on add button*/
		App::import('Model','ClientUser');
        $this->ClientUser 		= new ClientUser();
        $getProgramChampion 	= $this->ClientUser->getProgramChampion($progId,$clientId);
        //echo "<pre>";
        //print_r($getProgramChampion);die;
        $html .=	$this->Form->create('ProgramChampion', array('novalidate' => true,'id'=>'addProgramChampionValidate','url' => 'addProgramChampion','class' =>''));
		$html .= '<div class="modal fade noSpace-modal addProgramChampionAction" id="addProgramChampio33" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content form-box">
					<div class="modal-header form-box-head">
						<button type="button" class="close close1" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="text-center text-primary helBold">Add Champion</h2>
					</div>
					
					<div class="modal-body form-box-body">
						<div class="form-group form-bordered search-full">
							<input name="" class="form-control" placeholder="Enter Name" id="findProgramChampion" type="text">
						</div>
						<div class="table-responsive font20">
							<table id="employee-grid22" class="table table-condensed">
								<tbody id="gotResults">';
								//echo $progId;die;
								if(count($getProgramChampion) > 0)
								{
									foreach($getProgramChampion as $key=>$value)
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
						$html .= '</tbody>
							</table>
						</div>
						<!--<ul class="dropdown-menu">
						<li>								
						<a data-target=".addEditResourcePopup" data-toggle="modal" data-backdrop="static" class="clearResourceForm" href="javascript:void(0)">Create URL</a>						</li>
						<li>
						<a data-target=".addEditFileResourcePopup" data-toggle="modal" data-backdrop="static" class="clearResourceForm" href="javascript:void(0)">Create File</a>						</li>
					  </ul>-->
					  
						<div class="row btns-group">
							<div class="col-md-12 text-right">
								 <button type="button" data-target=".addProgramResoucesPopup" data-toggle="modal" data-backdrop="static" class="btn btn-success btn-default btn-mWidth text-uppercase helBold selectedcheckbox addResourceCount" disabled>Add</button>';
								$html .= $this->Form->input("programId", array("type"=>"hidden","div" => false,"label" => false,"class"=>"programId",'value'=>$progId));
								$html .= $this->Form->input("id_client", array("type"=>"hidden","div" => false,"label" => false,"class"=>"clientId",'value'=>$clientId));
								 $html .= $this->Form->submit("Add", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false,"style"=>'display:none;'));
							 $html .='</div>
						</div>
						
					</div>
					
				</div>
			</div>
		</div>
		<script>
			$(".close").on("click",function(){
					//location.reload();
			});
		</script>
		';
		$html .= $this->Form->end();	
		/* Add new champion popup on add button end*/
		
		/* Add resource popup on button*/
		$html .= '<div class="modal fade addProgramResoucesPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-addChampion text-center text-primary helBold" id="myModalLabel"> Add (X) Resource/s</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="form-info-text text-center">
										<p><strong class="content_text_Champion">Are you sure you want to add this / these Resource/s to this program? Please note, their default rules will apply
										</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								 <button type="button" class="btn btn-default btn-block text-uppercase" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">
								 <button type="button" class="btn btn-default btn-block text-uppercase btn-success saveAddChampionbutton" data-dismiss="modal">Add</button>
							</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/* Discard popup on cancel button*/
		
		/*Delete single Program  start */
		$html .=	$this->Form->create('Program', array('novalidate' => true,'id'=>'programValidate','url' => 'deleteProgramChampion','class' =>''));
		$html .= '<div class="modal fade deleteProgramnChampionAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title1 text-center text-primary helBold" id="myModalLabel">Remove Champion?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>Are you sure you want to remove this champion? This will cause them to lose all their access to this program</strong></p>
									</div>
								</div>
							</div>	
							
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_program_champion", array("type"=>"hidden","div" => false,"label" => false,"class"=>"championId"));
								 $html .= $this->Form->submit("Remove", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Delete single communication  start */
		
		$html .= '<div class="modal fade cannotDeleteAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-cannot-upload text-center text-primary helBold" id="myModalLabel"> Cannot Remove</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>You cannot remove this champion because they are the only champion assigned to this program.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">';
								 $html .= '<button type="button" class="contupload btn btn-success btn-block text-uppercase" data-dismiss="modal">Ok</button>
							</div>
						</div>
					 </div>
					</div>
				  </div>
				  </div>
				';
		
		/*Edit champion User start */
		
		/* edit champion popup */
		$html .=	$this->Form->create('User', array('novalidate' => true,'id'=>'addEditChampionValidate','url' => array('controller'=>'programs', 'action'=>'editchampion'),'class' =>'','onsubmit'=>'return ( $.app.validate("'.$this->Html->url(array('controller'=>'clients','action'=>'ajax_validation_champion')).'", this) )'));
		
		$html .= '<div class="modal fade skilsAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box manage-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title text-center text-primary helBold" id="myModalLabel">Champion</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						 <div class="row">
							<div class="col-md-6">
								<div class="form-group form-bordered">';
									 $html .= $this->Form->input("firstname", array("class" => "form-control text-input","div" => false,"label" => false,"placeholder" => "First Name","id"=>"firstname"));
									 $html .= '
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-bordered">';
									 $html .= $this->Form->input("lastname", array("class" => "form-control text-input","div" => false,"label" => false,"placeholder" => "Last Name","id"=>"lastname"));
									 $html .= '
							    </div>
							</div>
							
							<div class="col-md-12">
								<div class="form-group form-bordered">';
									 $html .= $this->Form->input("email", array("class" => "form-control text-input","div" => false,"label" => false,"placeholder" => "Email Address","id"=>"email"));
								 $html .= '
							   </div>
							</div>
							<div class="col-md-12">
								<div class="form-group form-bordered">';
									 $html .= $this->Form->input("phone", array("class" => "form-control text-input","div" => false,"label" => false,"placeholder" => "Phone Number","id"=>"phone","type"=>'tel',"maxlength"=>10));
								 $html .= '
							   </div>
							</div>
							
							<div class="col-md-12">
								<div id="loader-img" class="alert" style="display:none;text-align:center;"><img src="'.$this->webroot.'"img/ajax-loader1.gif";?>"></div>
							</div>
							
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("page", array("type"=>"hidden","div" => false,"label" => false,"class"=>"id_program_champion",'value'=>'program_champion'));
								$html .= $this->Form->input("id_user", array("type"=>"hidden","div" => false,"label" => false,"class"=>"championId"));
								$html .= $this->Form->input("id_client", array("type"=>"hidden","div" => false,"label" => false,"class"=>"","value"=>$clientId));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								$html .= $this->Form->input("id_champion", array("type"=>"hidden","div" => false,"label" => false,"class"=>"id_champion","value"=>""));
								$html .= $this->Form->submit("Create", array("class" => "btn btn-success btn-block text-uppercase savebutton submitNewSkill checkChampion","div" => false,"type"=>"button","label" => false));
					$html .= '</div>	
						 </div>					  
					  </div>';
			 $html .= '
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/* edit champion popup */
		
		/*Suspend Program start */
		$html .=	$this->Form->create('ClientUser', array('novalidate' => true,'id'=>'suspendedValidate','url' => 'suspendProgramChampion','class' =>''));
		$html .= '<div class="modal fade championSuspendAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box reset-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-champion-suspended text-center text-primary helBold" id="myModalLabel"> Suspend User? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						  <div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong class="content_champion_suspend">Are you sure you want to suspend this user? They will not have access to their account whilst they are suspended.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								$html .= $this->Form->input("id_client_user", array("type"=>"hidden","div" => false,"label" => false,"class"=>"championId"));
								$html .= $this->Form->input("id_client", array("type"=>"hidden","div" => false,"label" => false,"class"=>"","value"=>$clientId));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,'value'=>'suspended','class'=>"mode"));
								$html .= $this->Form->submit("Suspend", array("class" => "btn suspend_button btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .= '</div>				  
						</div>
					</div>
				  </div>
				</div>
				</div>
				';
		$html .= $this->Form->end();
		/*$html .= "<style>
					tr th:nth-child(8) { visibility: hidden; }
				</style>";	*/
	
		/*Suspend Unsupend Program end */
		
		
		/*Unsupend Program start */
		$html .=	$this->Form->create('ClientUser', array('novalidate' => true,'id'=>'unSuspendedValidate','url' => 'unsuspendProgramChampion','class' =>''));
		$html .= '<div class="modal fade championUnsuspendAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box reset-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-suspended text-center text-primary helBold" id="myModalLabel"> Unsuspend User? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						  <div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong class="content_msg">Are you sure you want to unsuspend this user? They will regain their access to their account whilst they are suspended.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								$html .= $this->Form->input("id_client_user", array("type"=>"hidden","div" => false,"label" => false,"class"=>"championId"));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,'value'=>'unsuspended','class'=>"mode"));
								$html .= $this->Form->submit("Unsuspend", array("class" => "btn suspend_button btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .= '</div>				  
						</div>
					</div>
				  </div>
				</div>
				</div>
				';
		$html .= $this->Form->end();
		/*$html .= "<style>
					tr th:nth-child(8) { visibility: hidden; }
				</style>";	*/
	
		/*Unsupend Program end */
		
		$html .= '<div class="modal fade cannotSuspendAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-cannot-upload text-center text-primary helBold" id="myModalLabel"> Cannot Suspend</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>You cannot suspend this champion because they are the only champion assigned to the following programs.</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-12">';
								 $html .= '<button type="button" class="contupload btn btn-success btn-block text-uppercase" data-dismiss="modal">Ok</button>
							</div>
						</div>
					 </div>
					</div>
				  </div>
				  </div>
				';
		
		/*Reset Password start */
		$html .=	$this->Form->create('User', array('novalidate' => true,'id'=>'resetPasswordValidate','url' =>array('controller'=>'users', 'action'=>'championResendPassword'),'class' =>''));
		$html .= '<div class="modal fade resendAccessAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box reset-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-program-champion text-center text-primary helBold" id="myModalLabel"> Resend Access? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						  <div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>Do you want to resend access to this champion? This will send them an email with a link to allow them to reset their password</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								$html .= $this->Form->input("email", array("type"=>"hidden","div" => false,"label" => false,'id'=>"resendEmail"));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,'value'=>'resetChampionUserPassword'));
								$html .= $this->Form->submit("Resend", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .= '</div>				  
						</div>
					</div>
				  </div>
				</div>
				</div>
				';
		$html .= $this->Form->end();
		/*$html .= "<style>
					tr th:nth-child(3) { visibility: hidden; }
				</style>";	*/
	
		/*Reset Password end */
		
		/* Multiple role check allow start*/
		$html .= '<div class="modal fade multiRolePopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-multiple text-center text-primary helBold" id="myModalLabel"> Multiple User Role </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="col-sm-12 col-md-12">
										<p><strong>There is already an account using this email. If any fields belonging to that account are different, they will be overwritten to match this account. Would you like to continue?</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								 <button type="button" class="btn btn-default btn-block text-uppercase multiRoleCancel" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">
								 <button type="button" class="btn btn-success btn-block text-uppercase continue" data-dismiss="modal">Continue</button>
							</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/* Multiple role check allow start*/
		
		
		return $html;	
	}	
	
	public function programCommunication($progId)
	{
		$html = '';
		
		/*Delete single Program  start */
		$html .=	$this->Form->create('Program', array('novalidate' => true,'id'=>'programValidate','url' => 'deleteProgramCommunication','class' =>''));
		$html .= '<div class="modal fade deleteProgramnResourceAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title1 text-center text-primary helBold" id="myModalLabel">Remove Communication?</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12 text-center">
								<div class="form-group form-bordered">
									<div class="form-info-text">
										<p><strong>Are you sure you want to remove this communication from the program?</strong></p>
									</div>
								</div>
							</div>	
							
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							
							<div class="col-md-6">';
								$html .= $this->Form->input("id_program_communication", array("type"=>"hidden","div" => false,"label" => false,"class"=>"communicationId"));
								 $html .= $this->Form->submit("Remove", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();	
		/*Delete single communication  start */
		
		/* Discard url popup on cancel button*/
		$html .= '<div class="modal fade discardActionPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-discard text-center text-primary helBold" id="myModalLabel"> Discard changes? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="form-info-text text-center">
										<p><strong>Are you sure you want to discard these changes?</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								 <button type="button" class="openCurrentPopup btn btn-default btn-block text-uppercase" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								  $html .= $this->Html->link('Discard', '/admin/programs/', array('class'=>"btn btn-success btn-block text-uppercase"));
				$html .=	'</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/* Discard popup on cancel button*/
		
		/* Discard file popup on cancel button*/
		$html .= '<div class="modal fade discardFileActionPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-discard text-center text-primary helBold" id="myModalLabel"> Discard changes? </h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="form-info-text text-center">
										<p><strong>Are you sure you want to discard these changes?</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								 <button type="button" class="openCurrentFilePopup btn btn-default btn-block text-uppercase" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								  $html .= $this->Html->link('Discard', '/admin/programs/resources/'.(isset($this->request->params['pass'][0])?$this->request->params['pass'][0]:""), array('class'=>"btn btn-success btn-block text-uppercase"));
				$html .=	'</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/* Discard popup on cancel button*/
		
		App::import('Model','Communication');
        $this->Communication  = new Communication();
        $getProgramCommunications 	= $this->Communication->getProgramCommunications($progId);
        //echo "<pre>";
        //print_r($getProgramResources);die;
        $html .=	$this->Form->create('ProgramCommunication', array('novalidate' => true,'id'=>'addprogramCommunicationValidate','url' => 'addProgramCommunication','class' =>''));
		$html .= '<div class="modal fade noSpace-modal addProgramCommunicationPopup" id="addCommunications" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content form-box">
					<div class="modal-header form-box-head">
						<button type="button" class="close close1" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="text-center text-primary helBold">Add Coummnications</h2>
					</div>
					
					<div class="modal-body form-box-body">
						<div class="form-group form-bordered search-full">
							<input name="" class="form-control" placeholder="Enter Email Subject" id="programFindResource" type="text">
						</div>
						<div class="table-responsive font20">
							<table id="employee-grid22" class="table table-condensed">
								<tbody id="gotResults">';
								if(count($getProgramCommunications) > 0)
								{
									foreach($getProgramCommunications as $key=>$value)
									{
											$html .= '<tr>
														<td class="checkbox-col">
															<div class="checkbox custom-checkbox">
																<input name="communicationSelected[]" class="selectedcheckbox checkboxSelectBox" id="keepSigned_'.$value['Communication']['id_communication'].'" value="'.$value['Communication']['id_communication'].'" type="checkbox">
																<label for="keepSigned_'.$value['Communication']['id_communication'].'"></label>
																<input name="added_by['.$value['Communication']['id_communication'].']"  value="'.$value['Communication']['added_by'].'" type="text" style="display:none">
															</div>
														</td>
														<td class="ar-title text-primary">'.ucfirst($value['Communication']['subject']).'</td>
													</tr>';
									}
								}
								else
								{
									$html .= '<tr>
												<td colspan="3" style="text-align: center;">No data available in table</td>
											</tr>';
								}		
						$html .= '</tbody>
							</table>
						</div>
						<!--<ul class="dropdown-menu">
						<li>								
						<a data-target=".addEditResourcePopup" data-toggle="modal" data-backdrop="static" class="clearResourceForm" href="javascript:void(0)">Create URL</a>						</li>
						<li>
						<a data-target=".addEditFileResourcePopup" data-toggle="modal" data-backdrop="static" class="clearResourceForm" href="javascript:void(0)">Create File</a>						</li>
					  </ul>-->
					  
					  
						<div class="row btns-group">
							<!--<div class="col-md-4">
								<button type="button" data-target=".addEditFileResourcePopup" data-toggle="modal" data-backdrop="static"  class="clearResourceForm btn btn-default btn-block text-uppercase helBold">Create New File</button>
							</div>-->
							<div class="col-md-6">';
								$html .= $this->Html->link('Create New COMMS', '/admin/programs/communicationAddEdit/'.(isset($this->request->params['pass'][0])?$this->request->params['pass'][0]:""), array('class'=>"btn btn-default btn-block text-uppercase helBold"));
							$html .='</div>
							<div class="col-md-6">
								 <button type="button" data-target=".addProgramCommunicationPopup" data-toggle="modal" data-backdrop="static" class="btn btn-success btn-default btn-block text-uppercase helBold selectedcheckbox addResourceCount" disabled>Add</button>';
								$html .= $this->Form->input("programId", array("type"=>"hidden","div" => false,"label" => false,"class"=>"programId",'value'=>$progId));
								 $html .= $this->Form->submit("Unarchive", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false,"style"=>'display:none;'));
							 $html .='</div>
						</div>
						
					</div>
					
				</div>
			</div>
		</div>';
		$html .= $this->Form->end();	
		
		/* Add resource popup on button*/
		$html .= '<div class="modal fade addProgramCommunicationPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-addCommunication text-center text-primary helBold" id="myModalLabel"> Add (X) Resource/s</h2>
					  </div>
					  <div class="modal-body form-box-body"> 
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="form-info-text text-center">
										<p><strong class="communication_content_text">Are you sure you want to add this / these Resource/s to this program? Please note, their default rules will apply
										</strong></p>
									</div>
								</div>
							</div>	
							<div class="col-md-6">
								 <button type="button" class="btn btn-default btn-block text-uppercase" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">
								 <button type="button" class="btn btn-default btn-block text-uppercase btn-success saveCommunicationbutton" data-dismiss="modal">Add</button>
							</div>							  
					  </div>
					 </div>
					</div>
				  </div>
				</div>';	
		/* Discard popup on cancel button*/
		
		return $html;	
	}
	
	/*Survey page popups start*/
	public function surveyAddEditPopup()
	{
		$clientid = (isset($this->request->params['pass'][0])?$this->request->params['pass'][0]:"");
		$html = "";
		// exit;
		/*Add/Edit Survey start */
		$html .=	$this->Form->create('Survey', array('novalidate' => true,'id'=>'addEditSurveyValidate','url' => 'AddEditSurvey','class' =>'','onsubmit'=>'return ( $.app.validate("'.$this->Html->url(array('action'=>'ajax_validation_survey')).'", this) )'));

		$html .= '<div class="modal fade skilsAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box manage-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title text-center text-primary helBold 1" id="myModalLabel">Create New Survey</h2>
					  </div>
					  <div class="modal-body form-box-body">
						 <div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">';
									 $html .= $this->Form->input("title", array("class" => "form-control text-input",'maxlength'=>'60',"div" => false,"label" => false,"placeholder" => "Enter Survey Name","id"=>"title"));
									 $html .= '
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group form-bordered">';
									 $html .= '<div class="select-control">';
													$value = array(''=>'Mentor/Mentee/Both','mentor'=>'Mentor','mentee'=>'Mentee','both'=>'Both');
													$html .= 	$this->Form->input('role', array('type'=>'select', 'label'=>false, 'options'=>$value, 'default'=>'0','class'=>'form-control'));
									 $html .= '</div>
							    </div>
							</div>
							<div class="col-md-12">
							<div class="form-group" style="display:inline-block">
							<div class="input-group custom-input-group text-addon-group url-input-group">
							<span class="input-group-addon" style="font-size:22px;">When to Send</span>
							</div>
							</div>
							</div>

							<div class="col-md-12"><div class="form-group" style="display:inline-block">
							<div class="input-group custom-input-group text-addon-group url-input-group">
							<span class="input-group-addon grey" style="color:#ccc">Day After Match</span>
							</div></div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-bordered">';
									 $html .= '<div class="select-control">';
													$value = array(''=>'#',
																'1'=>'1',
																'2'=>'2',
																'3'=>'3',
																'4'=>'4',
																'5'=>'5',
																'6'=>'6',
																'7'=>'7',
																'8'=>'8',
																'9'=>'9',
																'10'=>'10',
																'11'=>'11',
																'12'=>'12',
																'13'=>'13',
																'14'=>'14',
																'15'=>'15',
																'16'=>'16',
																'17'=>'17',
																'18'=>'18',
																'19'=>'19',
																'20'=>'20',
																'21'=>'21',
																'22'=>'22',
																'23'=>'23',
																'24'=>'24',
																'25'=>'25',
																'26'=>'26',
																'27'=>'27',
																'28'=>'28',
																'29'=>'29',
																'30'=>'30'
																);
													$html .= 	$this->Form->input('days', array('type'=>'select', 'label'=>false, 'options'=>$value, 'default'=>'','class'=>'form-control'));
									 $html .= '</div>
									 </div>
									 </div>
									 <div class="col-md-6">
								<div class="form-group form-bordered">
									 <div class="select-control">';
													// $value = array(''=>'Choose Days Type',
													// 			'1'=>'Days',
													// 			'2'=>'Weeks'
													// 			);
													// $html .= 	$this->Form->input('type', array('type'=>'select', 'label'=>false, 'options'=>$value, 'default'=>'','class'=>'form-control'));
									 $value = array(''=>'Day/Week','1'=>'Days','0'=>'Weeks');
													$html .= 	$this->Form->input('type', array('type'=>'select', 'label'=>false, 'options'=>$value, 'default'=>'','class'=>'form-control'));
									 $html .= '</div>';
							   $html.='</div>
							</div>

							<div class="col-md-12">
								<div id="loader-img" class="alert" style="display:none;text-align:center;"><img src='.$this->webroot.'img/ajax-loader1.gif></div>
							</div>

							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>

							<div class="col-md-6">';
								$html .= $this->Form->input("id_survey", array("type"=>"hidden","div" => false,"label" => false,"class"=>"surveyId"));
								$html .= $this->Form->input("id_client", array("type"=>"hidden","div" => false,"label" => false,"class"=>"","value"=>(isset($this->request->params['pass'][0])?$this->request->params['pass'][0]:"")));
								$html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								$html .= $this->Form->submit("Create", array("class" => "btn btn-success btn-block text-uppercase savebutton submitNewSkill checkSurvey","div" => false,"type"=>"button","label" => false));
					$html .= '</div>
						 </div>
					  </div>';
			 $html .= '
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();
		/*Add Survey end */


		/* edit survey start */
		$html .=	$this->Form->create('Survey', array('novalidate' => true,'id'=>'EditSurveyValidate','url' => 'EditSurvey','class' =>'','onsubmit'=>'return ( $.app.validate("'.$this->Html->url(array('action'=>'ajax_validation_survey')).'", this) )'));

		$html .= '<div class="modal fade skilsAction1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box manage-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title text-center text-primary helBold" id="myModalLabel">Edit Survey</h2>
					  </div>
					  <div class="modal-body form-box-body">
						 <div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">';
									 $html .= $this->Form->input("title", array("class" => "form-control text-input",'maxlength'=>'60',"div" => false,"label" => false,"placeholder" => "Survey Name","id"=>"title1"));
									 $html .= '
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group form-bordered">';
									 $html .= '<div class="select-control">';
													$value = array(''=>'Mentor/Mentee/Both','mentor'=>'Mentor','mentee'=>'Mentee','both'=>'Both');
													$html .= 	$this->Form->input('role', array('type'=>'select', 'label'=>false, 'options'=>$value, 'default'=>'0','class'=>'form-control','id'=>'SurveyRole1'));
									 $html .= '</div>
							    </div>
							</div>
							<div class="col-md-12">
							<div class="form-group" style="display:inline-block">
							<div class="input-group custom-input-group text-addon-group url-input-group">
							<span class="input-group-addon" style="font-size:22px;">When to Send</span>
							</div>
							</div>
							</div>

							<div class="col-md-12"><div class="form-group" style="display:inline-block">
							<div class="input-group custom-input-group text-addon-group url-input-group">
							<span class="input-group-addon grey" style="color:#ccc">Day After Match</span>
							</div></div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-bordered">';
									 $html .= '<div class="select-control">';
													$value = array(''=>'#',
																'1'=>'1',
																'2'=>'2',
																'3'=>'3',
																'4'=>'4',
																'5'=>'5',
																'6'=>'6',
																'7'=>'7',
																'8'=>'8',
																'9'=>'9',
																'10'=>'10',
																'11'=>'11',
																'12'=>'12',
																'13'=>'13',
																'14'=>'14',
																'15'=>'15',
																'16'=>'16',
																'17'=>'17',
																'18'=>'18',
																'19'=>'19',
																'20'=>'20',
																'21'=>'21',
																'22'=>'22',
																'23'=>'23',
																'24'=>'24',
																'25'=>'25',
																'26'=>'26',
																'27'=>'27',
																'28'=>'28',
																'29'=>'29',
																'30'=>'30'
																);
													$html .= 	$this->Form->input('days', array('type'=>'select', 'label'=>false, 'options'=>$value, 'default'=>'','class'=>'form-control','id'=>'SurveyDays1'));
									 $html .= '</div>
									 </div>
									 </div>
									 <div class="col-md-6">
								<div class="form-group form-bordered">
									 <div class="select-control">';
									$value = array(''=>'Day/Week','1'=>'Days','0'=>'Weeks');
									$html .= 	$this->Form->input('type', array('type'=>'select', 'label'=>false, 'options'=>$value, 'default'=>'','class'=>'form-control','id'=>'SurveyType1'));
									 $html .= '</div>';
							   $html.='</div>
							</div>


							   	<!--<div class="col-md-12">
							<div class="form-group" style="display:inline-block">
							<div class="input-group custom-input-group text-addon-group url-input-group">
							<span class="input-group-addon grey" style="font-size:22px; color:#ccc;">or custom date</span>
							</div>
							</div>
							</div>

						<div class="col-md-12">
								<div class="form-group form-bordered">';
									 $html .= $this->Form->input("custom_date", array("class" => "form-control text-input datepicker1",
									 	"div" => false,"label" => false,"placeholder" => "Custom Date","id"=>"custom_date"));
									 $html .= '
								</div>
							</div>-->

							<div class="col-md-12">
								<div id="loader-img" class="alert" style="display:none;text-align:center;"><img src='.$this->webroot.'img/ajax-loader1.gif></div>
							</div>

							<div class="col-md-6">';
								$html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton112" id="canceleditSurvey">Cancel</button>
							</div>

							<div class="col-md-6">';
								$html .= $this->Form->input("id_survey", array("type"=>"hidden","div" => false,"label" => false,"class"=>"surveyId",'id'=>'id_survey1'));
								$html .= $this->Form->input("id_client", array("type"=>"hidden","div" => false,"label" => false,"class"=>"",'id'=>'id_client1',"value"=>(isset($this->request->params['pass'][0])?$this->request->params['pass'][0]:"")));

								$html .= $this->Form->submit("Create", array("class" => "btn btn-success btn-block text-uppercase savebutton submitNewSkill checkSurveyEdit","div" => false,"type"=>"button","label" => false));
					$html .= '</div>
						 </div>
					  </div>';
			 $html .= '
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();



		/* edit survey end */



		/*Delete Survey start */
		$html .=	$this->Form->create('User', array('novalidate' => true,'id'=>'deleteSurveyValidate','url' => 'deleteSurvey','class' =>''));
		$html .= '<div class="modal fade deleteSurveyAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title1 text-center text-primary helBold" id="myModalLabel"> Delete this Survey? </h2>
					  </div>
					  <div class="modal-body form-box-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="col-sm-12 col-md-12">
										<p><strong>Are you sure you want to delete this survey
										from the library? This action cannot be undone.
										The survey will remain in any programs it has previously
										been included in.</strong></p>
									</div>
								</div>
							</div>

							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>

							<div class="col-md-6">';
								$html .= $this->Form->input("id_survey", array("type"=>"hidden","div" => false,"label" => false,"class"=>"surveyId"));
								 $html .= $this->Form->input("mode", array("type"=>"hidden","div" => false,"label" => false,"class"=>"mode"));
								 $html .= $this->Form->submit("Delete", array("class" => "btn btn-success btn-block text-uppercase deletebutton submitNewSkill","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
							<div class="col-md-12">';
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();
		/*Delete Survey end */

		/*Delete multiple  sURVEY  start */
		$html .=	$this->Form->create('Survey', array('novalidate' => true,'id'=>'allSurveyValidate','url' => 'allSurveyDelete','class' =>''));
		$html .= '<div class="modal fade deleteAllAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-survey text-center text-primary helBold" id="myModalLabel"> Delete Surveys/s?</h2>
					  </div>
					  <div class="modal-body form-box-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="form-info-text text-center">
										<p><strong class="survey_desc">
										Are you sure you want to delete this survey/s from the library? This action cannot be undone.
										 The survey/s will remain in any programs it has previously been included in.
										</strong></p>
									</div>
								</div>
							</div>
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase closebutton11" data-dismiss="modal">Cancel</button>
							</div>
							<div class="col-md-6">';
								$html .= $this->Form->input("selectedId", array("type"=>"hidden","div" => false,"label" => false,"class"=>"selectedId"));
								 $html .= $this->Form->submit("Delete", array("class" => "btn btn-success btn-block text-uppercase","div" => false,"type"=>"submit","label" => false));
				$html .=  '</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		$html .= $this->Form->end();
		/*Delete multiple  sURVEY  end */



		/*discard change  sURVEY  start */
		$html .= '<div class="modal fade discardAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
					  <div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-survey text-center text-primary helBold" id="myModalLabel"> Discard Changes ?</h2>
					  </div>
					  <div class="modal-body form-box-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="form-info-text text-center">
										<p><strong class="survey_desc">
												Are you sure you want to discard these changes?
										</strong></p>
									</div>
								</div>
							</div>
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase cdiscardbutton11"
								  >Cancel</button></div><div class="col-md-6">
									<button type="button" class="btn btn-default btn-block text-uppercase"
									data-dismiss="modal"
 								  >Discard</button>

							</div>
						</div>
					 </div>
					</div>
				  </div>
				</div>
				';
		/*discard change  sURVEY  end */


		/*delete question sURVEY  start */
		$html .= '<div class="modal fade deleteSurveyQuesAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
					<div class="modal-content form-box delete-admin-modal-box">
						<div class="modal-header form-box-head">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title-survey text-center text-primary helBold" id="myModalLabel"> Delete Question ?</h2>
						</div>
						<div class="modal-body form-box-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-bordered">
									<div class="form-info-text text-center">
										<p><strong class="survey_desc">
												Are you sure you want to delete this question ?
										</strong></p>
									</div>
								</div>
							</div>
							<div class="col-md-6">';
								 $html .= '<button type="button" class="btn btn-default btn-block text-uppercase" data-dismiss="modal"
									>Cancel</button></div><div class="col-md-6">
									<button type="button" class="btn btn-default btn-block text-uppercase deleteQuestionbtn"
									>Delete</button>
							</div>
						</div>
					 </div>
					</div>
					</div>
				</div>
				';
		/* delete question   sURVEY  end */




		$html .= "<style>
					tr th:nth-child(8) { visibility: hidden; }
				</style>";
				return $html;
			}

		/*Survey page popups end*/
}
