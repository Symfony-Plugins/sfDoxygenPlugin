<?php
/**
 * Checks the version of doxygen installed on local machine.
 *
 * @package    lib
 * @subpackage task
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 */
class sfDoxygenVersionTask extends sfBaseTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    $this->namespace        = 'doxygen';
    $this->name             = 'version';
    $this->briefDescription = 'Generates documentation of the project';
    $this->detailedDescription = <<<EOF
The [doxygen:version|INFO] checks the version of doxygen installed on
local machine:

  [./symfony doxygen:version|INFO]
EOF;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    sfFilesystem::sh('doxygen --version');
  }

}

