<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed_url
{
	public static $name         = 'Feed URL';
	public static $version      = '1.0';
	public static $author       = 'Hop Studios';
	public static $author_url   = 'http://www.hopstudios.com/software';
	public static $description  = 'Gets the feed url from the channel configuration';
	public static $typography   = FALSE;
	
	public $return_data = "";
	
	public function __construct()
	{
		$channel = ee()->TMPL->fetch_param('channel');
		if ($channel == NULL || $channel == "")
		{
			// Try the old 'weblog'
			$channel = ee()->TMPL->fetch_param('weblog');
		}
		$site_id = ee()->config->item('site_id');
		
		$query = ee()->db->select('rss_url')
			->from('channels')
			->where('site_id', $site_id)
			->where('channel_name', $channel)
			->get();
		if (count($query->result()) == 1)
		{
			$rows = $query->result();
			$this->return_data = $rows[0]->rss_url;
		}
		else
		{
			
		}
	}
	
	public static function usage()
	{
		ob_start();  ?>

		Put the feed_url tag where you want the feed URL to appear.  The weblog parameter is required -- it should be your blog's short name.

		<a href="{exp:feed_url channel="blog"}" title="RSS">RSS</a>

		<?php
		$buffer = ob_get_contents();
		ob_end_clean();

		return $buffer;
	}
}
