<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at http://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   Full Page Cache
 * @version   1.0.1
 * @build     360
 * @copyright Copyright (C) 2015 Mirasvit (http://mirasvit.com/)
 */



class Mirasvit_Fpc_Helper_Help extends Mirasvit_MstCore_Helper_Help
{
    protected $_help = array(
        'system' => array(
            'general_enabled' => 'Enables full page cache. You can enable/disable full page cache for each store view.',
            'general_lifetime' => 'Cache lifetime (in seconds). Determines the time after which the page cache will be invalid. A new page cache will be created the next time a visitor visits the page.',
            'general_max_cache_size' => 'Maximum full page cache size in megabytes.If the limit is reached, extension change full page cache status to invalidated, but cache still works.',
            'general_flush_cache_schedule' => 'Specifies how often cron must clear (flush) cache. Leave empty for disable this feature.<xmp></xmp> <b>Can be a cron expression only.</b> Example:<br/>0 1 * * *<br/>0 0 */3 * *',

            'crawler_enabled' => 'Enable this feature. I.e. extension will automatically visit all not cached pages defined at Crawler URLs. If feature disabled, extension will work as before, but without automatically caching not cached pages.',
            'crawler_max_threads' => 'Determines the number of parallel requests during this process.',
            'crawler_thread_delay' => 'Delay between crawler requests.',
            'crawler_max_urls_per_run' => 'Maximum number of crawled URLs per one cron (or shell) run.',
            'crawler_schedule' => 'Specifies how often cron must run crawler. For example, 0 */3 * * * - every 3 hours.<xmp></xmp><b>Can be a cron expression only.</b> Example:<br/>*/5 * * * *<br/>*/15 * * * *',
            'crawler_sort_crawler_urls' => 'Specifies the crawl order.',
            'crawler_sort_by_page_type' => 'Specifies the order in which the crawler should add pages in a cache.',
            'crawler_sort_by_product_attribute' => 'Specifies the order in which the crawler should add pages in a cache. If you use "Sort by page type", will be applied after the first sorting. To apply the changes, please, flush all cache.',
            'crawler_run_as_apache_user' => 'Crawler will run using apache user. Preferably use No.<xmp></xmp><b>Enable only if crawler don\'t work with current configuration.</b>',
            'crawler_status' => '',

            'cache_rules_max_depth' => 'Determines the number of layered navigation filters, or parameters, that can be applied in order for a page to be cached.',
            'cache_rules_cacheable_actions' => 'List of cacheable actions.',
            'cache_rules_allowed_pages' => 'List of allowed pages (regular expression).<xmp></xmp><b>Can be a regular expression only.</b> Example:<br/>/books\/a-tale-of-two-cities.html/<br/>/books/',
            'cache_rules_ignored_pages' => 'List of not allowed for caching pages (regular expression).<xmp></xmp><b>Can be a regular expression only.</b> Example:<br/>/books\/a-tale-of-two-cities.html/<br/>/books/',
            'cache_rules_user_agent_segmentation' => 'Determines the cache by user agent  (regular expression)',

            'debug_hints' => '',
            'debug_info' => '',
            'debug_allowed_ip' => 'Comma separated IP addresses',
        ),
    );
}
