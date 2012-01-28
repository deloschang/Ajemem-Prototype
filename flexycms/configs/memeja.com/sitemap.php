<?php

	define("SITEMAP_FILEPATH",$_SERVER['DOCUMENT_ROOT'].'/ccu2new/');
	define("SITEMAP_PATH",'http://'.$_SERVER['HTTP_HOST'].'/ccu2new/');	
	define("SITEMAP_URL",APP_ROOT_URL );
	define("CATEGORY_DIR","index.php/page/category");	
	define("SECTION_DIR","index.php/page/gallery");
	define("CONTENT_DIR","index.php/page/content");	
	define("SITEMAP_NAMEFORMAT", "sitemap");
	define("SITEINDEX_FILENAME", "siteindex.xml");
	define("MAX_SITEMAP_FILE_SIZE", "10485760");
	define("MAX_SITE_SIZE", "50000");
	define("MAX_SITE_INDEX_SIZE", "1000");
	define("CAT_PAGE_PRIORITY", 0.8);
	define("CAT_PAGE_FREQ","weekly");
	define("SEC_PAGE_PRIORITY", 0.8);
	define("SEC_PAGE_FREQ","weekly");
	define("CONTENT_PAGE_PRIORITY", 0.5);
	define("CONTENT_PAGE_FREQ","daily");
?>