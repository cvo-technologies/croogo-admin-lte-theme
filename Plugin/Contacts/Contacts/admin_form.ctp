<?php

$this->extend('/Common/lte_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('croogo', 'Contacts'), array('controller' => 'contacts', 'action' => 'index'));

if ($this->request->params['action'] == 'admin_edit') {
	$this->Html->addCrumb($this->request->data['Contact']['title']);
}

if ($this->request->params['action'] == 'admin_add') {
	$this->Html->addCrumb(__d('croogo', 'Add'), '/' . $this->request->url);
}

$this->start('form');
echo $this->Form->create('Contact');
$this->end();

$this->Form->inputDefaults(array(
	'class' => 'form-control',
	'div'   => 'form-group'
));

$this->start('tabs');
echo $this->Croogo->adminTab(__d('croogo', 'Contact'), '#contact-basic');
echo $this->Croogo->adminTab(__d('croogo', 'Details'), '#contact-details');
echo $this->Croogo->adminTab(__d('croogo', 'Message'), '#contact-message');
$this->end();

$this->start('sidebar');
echo $this->Html->beginBox(__d('croogo', 'Publishing'));
echo $this->element('save-buttons');
echo $this->Form->input('status', array('label' => __d('croogo', 'Published'), 'class' => false));
echo $this->Html->endBox();
$this->end();
?>
<div id="contact-basic" class="tab-pane">
	<?php
	echo $this->Form->input('id');
	echo $this->Form->input('title', array(
		'label' => __d('croogo', 'Title'),
	));
	echo $this->Form->input('alias', array(
		'label' => __d('croogo', 'Alias'),
	));
	echo $this->Form->input('email', array(
		'label' => __d('croogo', 'Email')
	));
	echo $this->Form->input('body', array(
		'label' => __d('croogo', 'Body'),
	));
	?>
</div>

<div id="contact-details" class="tab-pane">
	<?php
	echo $this->Form->input('name', array(
		'label' => __d('croogo', 'Name'),
	));
	echo $this->Form->input('position', array(
		'label' => __d('croogo', 'Position'),
	));
	echo $this->Form->input('address', array(
		'label' => __d('croogo', 'Address'),
	));
	echo $this->Form->input('address2', array(
		'label' => __d('croogo', 'Address2'),
	));
	echo $this->Form->input('state', array(
		'label' => __d('croogo', 'State'),
	));
	echo $this->Form->input('country', array(
		'label' => __d('croogo', 'Country'),
	));
	echo $this->Form->input('postcode', array(
		'label' => __d('croogo', 'Post Code'),
	));
	echo $this->Form->input('phone', array(
		'label' => __d('croogo', 'Phone'),
	));
	echo $this->Form->input('fax', array(
		'label' => __d('croogo', 'Fax'),
	));
	?>
</div>

<div id="contact-message" class="tab-pane">
	<?php
	echo $this->Form->input('message_status', array(
		'label' => __d('croogo', 'Let users leave a message'),
	));
	echo $this->Form->input('message_archive', array(
		'label' => __d('croogo', 'Save messages in database'),
	));
	echo $this->Form->input('message_notify', array(
		'label' => __d('croogo', 'Notify by email instantly'),
	));
	echo $this->Form->input('message_spam_protection', array(
		'label' => __d('croogo', 'Spam protection (requires Akismet API key)'),
	));
	echo $this->Form->input('message_captcha', array(
		'label' => __d('croogo', 'Use captcha? (requires Recaptcha API key)'),
	));

	echo $this->Html->link(__d('croogo', 'You can manage your API keys here.'), array(
		'plugin'     => 'settings',
		'controller' => 'settings',
		'action'     => 'prefix',
		'Service',
	));
	?>
</div>
