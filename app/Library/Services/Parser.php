<?php


namespace App\Library\Services;

use App\Library\Contracts\ParserInterface;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\App;

/**
 * Class Parser
 * @package App\Library\Services
 */
class Parser implements ParserInterface
{
    /**
     * @var Client
     */
    public $client;
    /**
     * @var array
     */
    public $nodes = [];
    /**
     * @var array
     */
    public $emails = [];
    /**
     * @var array
     */
    protected $options = [];
    /**
     * @var int
     */
    protected $count = 0;
    /**
     * @var int
     */
    protected $deep = 0;
    /**
     * Parser constructor.
     */
    public function __construct()
    {
        $this->client = App::make('Goutte\Client');
    }
    
    public function parse(array $options = [])
    {
        if (empty($this->options)) $this->options = $options;

        try {
            $this->getLink($this->options['url']);
            ++$this->deep;
            $crawler = $this->client->request('GET', $this->options['url']);
            $links = $crawler->filter('ul li a');
            $allLinks = $crawler->filter('a');
            $links->each(function ($node) {
                echo $node->attr('href') . '<br>';
//                if (count($this->nodes) < $this->options['deep']) {
//                    $this->getEmail($node->attr('href'));
//                    $this->options['url'] = $node->attr('href');
//                    $this->parse();
//                }
                $this->getEmail($node->attr('href'));
            });
            $allLinks->each(function ($node) {
                echo $node->attr('href') . '<br>';
//                if (count($this->nodes) < $this->options['deep']) {
////                    $this->options['url'] = $node->attr('href');
////                    $this->parse();
//                }
            });

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     *  Get email
     * @param string $string
     */
    protected function getEmail(string $string = ''): void
    {
        if($this->isEmail($string) && $this->options['quantity'] >  $this->count) {
            ++$this->count;
            $this->emails[] = $string;
        }
    }

    protected  function getLink(string $string = ''): void
    {
        if(strlen($string > 3)) {
            $this->nodes[] = $string;
        }
    }

    /**
     * @param array $arr
     * @return array
     */
    protected function cleanDuplicates(array $arr = []): array
    {
        return array_unique($arr);
    }

    private function isEmail(string $string = ''): bool
    {
        return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $string) !== 0;
    }
}