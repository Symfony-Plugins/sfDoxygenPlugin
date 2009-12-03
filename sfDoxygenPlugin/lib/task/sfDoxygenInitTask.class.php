<?php
/**
 * Creates doxygen configuration files for the project.
 *
 * @package    lib
 * @subpackage task
 * @author     Tomasz Ducin <tomasz.ducin@gmail.com>
 */
class sfDoxygenInitTask extends sfBaseTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    $this->namespace        = 'doxygen';
    $this->name             = 'init';
    $this->briefDescription = 'Creates doxygen config files needed to generate the docs';
    $this->detailedDescription = <<<EOF
The [doxygen:init|INFO] task creates the doxygen config file:

  [./symfony doxygen:init|INFO]
EOF;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    $doxygen_config_dir = sfConfig::get('sf_config_dir').'/doxygen';
    $plugins_config_dir = sfConfig::get('sf_plugins_dir').'/sfDoxygenPlugin/config';
    sfFilesystem::sh("mkdir {$doxygen_config_dir}");
    sfFilesystem::sh("doxygen -g {$doxygen_config_dir}/doxygen.cfg");
    sfFilesystem::sh("doxygen -l {$doxygen_config_dir}/doxygen.xml");
    sfFilesystem::sh("cp {$plugins_config_dir}/doxygen.ini {$doxygen_config_dir}/doxygen.ini");
    sfFilesystem::sh("cp {$plugins_config_dir}/doxygen_exclude.txt {$doxygen_config_dir}/doxygen_exclude.txt");
  }
}

