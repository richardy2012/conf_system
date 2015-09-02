<?php 
include_once('config.php');

function &db() {
	include_once('db.php');
	static $db = null;
	if ($db === null)
	{
		$cfg = parse_url(DB_CONFIG);

		if ($cfg['scheme'] == 'mysql')
		{
			if (empty($cfg['pass']))
			{
				$cfg['pass'] = '';
			}
			else
			{
				$cfg['pass'] = urldecode($cfg['pass']);
			}
			$cfg ['user'] = urldecode($cfg['user']);

			if (empty($cfg['path']))
			{
				trigger_error('Invalid database name.', E_USER_ERROR);
			}
			else
			{
				$cfg['path'] = str_replace('/', '', $cfg['path']);
			}

			$charset = 'utf8';
			$db = new cls_mysql();
			//$db->cache_dir = ROOT_PATH. '/temp/query_caches/';
			$db->connect($cfg['host']. ':' .$cfg['port'], $cfg['user'],
					$cfg['pass'], $cfg['path'], $charset);
		}
		else
		{
			trigger_error('Unkown database type.', E_USER_ERROR);
		}
	}

	return $db;
}

?>