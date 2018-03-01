<?php defined('BASEPATH') || exit('No direct script access allowed');
/**
 * Bonfire
 *
 * An open source project to allow developers to jumpstart their development of
 * CodeIgniter applications.
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2014, Bonfire Dev Team
 * @license   http://opensource.org/licenses/MIT
 * @link      http://cibonfire.com
 * @since     Version 1.0
 * @filesource
 */
//------------------------------------------------------------------------------
// Countries
//------------------------------------------------------------------------------
$config['address.countries'] = array(
  'CO' => array(
    'name' => 'COLOMBIA',
    'printable' => 'Colombia',
    'iso3' => 'COL'
  ),
  'US' => array(
    'name' => 'UNITED STATES',
    'printable' => 'Estados Unidos',
    'iso3' => 'USA'),
);
//------------------------------------------------------------------------------
// States/Provinces/Regions
//------------------------------------------------------------------------------
$config['address.states'] = array(
  'CO' => array(
    '01' => 'Medellín',
    '02' => 'Bogotá',
    '03' => 'Pereira',
    '04' => 'Cali',
    '05' => 'Dosquebradas'
  ),
  'US' => array(
    'AK' => 'Alaska',
  ),
);
