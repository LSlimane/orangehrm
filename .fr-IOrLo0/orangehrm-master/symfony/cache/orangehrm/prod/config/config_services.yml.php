<?php
// auto-generated by sfServiceConfigHandler
// date: 2020/08/03 00:24:14

$class = 'orangehrm_prodServiceContainer';
if (!class_exists($class, false)) {
class orangehrm_prodServiceContainer extends sfServiceContainer
{
  protected $shared = array();

  protected function getSfLoggerService()
  {
    if (isset($this->shared['sf_logger'])) return $this->shared['sf_logger'];

    $instance = new sfEventLogger($this->getService('sf_event_dispatcher'));

    return $this->shared['sf_logger'] = $instance;
  }

  protected function getSfFilesystemService()
  {
    if (isset($this->shared['sf_filesystem'])) return $this->shared['sf_filesystem'];

    $instance = new sfFilesystem($this->getService('sf_event_dispatcher'), $this->getService('sf_formatter'));

    return $this->shared['sf_filesystem'] = $instance;
  }
}

}
return $class;

