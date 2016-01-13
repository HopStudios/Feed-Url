<?php

/*
==========================================================
	This software package is intended for use with 
	ExpressionEngine.	ExpressionEngine is Copyright © 
	2002-2009 EllisLab, Inc. 
	http://ellislab.com/
==========================================================
	THIS IS COPYRIGHTED SOFTWARE, All RIGHTS RESERVED.
	Written by: Justin Crawford
	Copyright (c) 2009 Hop Studios
	http://www.hopstudios.com/software/
--------------------------------------------------------
	Please do not distribute this software without written
	consent from the author.
==========================================================
	Files:
	- pi.feed_url.php
----------------------------------------------------------
	Purpose: 
	- Gets the feed url from the weblog configuration
==========================================================
*/

$plugin_info = array(
  'pi_name' => 'Feed URL',
  'pi_version' => '1.0.0',
  'pi_author' => 'Justin Crawford (Hop Studios)',
  'pi_author_url' => 'http://www.hopstudios.com/software',
  'pi_description' => 'Gets the feed url from the weblog configuration',
  'pi_usage' => Feed_url::usage()
  );

class Feed_url
{

	var $return_data = "";

  function Feed_url()
  {
		global $DB, $TMPL, $PREFS;
		$weblog = $TMPL->fetch_param('weblog');
		$query = $DB->query("SELECT rss_url FROM exp_weblogs WHERE blog_name = '{$weblog}' AND site_id = '" . $PREFS->ini('site_id') . "'");
		if ($query->num_rows > 0)
		{
			$this->return_data = $query->row['rss_url'];
		}
		else
		{
			$this->return_data = '';
		}
  }

  // ----------------------------------------
  //  Plugin Usage
  // ----------------------------------------
  function usage()
  {
  ob_start(); 
  ?>

Put the feed_url tag where you want the feed URL to appear.  The weblog parameter is required -- it should be your blog's short name.

<a href="{exp:feed_url weblog="hopstudios_blog"}" title="RSS">RSS</a>

	<?php
  $buffer = ob_get_contents();
	
  ob_end_clean(); 

  return $buffer;
  }
  // END

}

?>
