<?php
/**
 * WordpressTest.php
 *
 * @package Embera
 * @author Michael Pratt <yo@michael-pratt.com>
 * @link   http://www.michael-pratt.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Embera\Provider;

use Embera\ProviderTester;

/**
 * Test the Wordpress Provider
 */
final class WordpressTest extends ProviderTester
{
    protected $tasks = [
        'valid_urls' => [
            'http://en.blog.wordpress.com/2011/07/12/new-theme-matala/',
            'http://wp.me/p6MX0-47g',
            'http://wp.me/a6MX0-461',
        ],
        'invalid_urls' => [
            'http://wordpress.com/',
            'http://wp.me/',
        ],
    ];

    public function testProvider()
    {
        $this->validateProvider('Wordpress', [ 'width' => 480, 'height' => 270]);
    }
}
