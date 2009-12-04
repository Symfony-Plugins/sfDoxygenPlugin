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
    $this->aliases          = array('doxygen-init');
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
    sfFilesystem::sh("mkdir -p {$doxygen_config_dir}");
    sfFilesystem::sh("doxygen -g {$doxygen_config_dir}/doxygen.cfg");
    $version_string = sfFilesystem::sh("doxygen --version");
    $version_array = explode('.', $version_string);
    // checks if doxygen version is 1.5.7 or above
    if ($version_array[1] >= 6 || ($version_array[1] == 5 && $version_array[2] >=7))
    {
      sfFilesystem::sh("doxygen -l {$doxygen_config_dir}/doxygen.xml");
    }
    sfFilesystem::sh("cp {$plugins_config_dir}/doxygen.ini {$doxygen_config_dir}/doxygen.ini");
    sfFilesystem::sh("cp {$plugins_config_dir}/exclude.txt {$doxygen_config_dir}/exclude.txt");
    sfFilesystem::sh("cp {$plugins_config_dir}/exclude_patterns.txt {$doxygen_config_dir}/exclude_patterns.txt");
  }
}

