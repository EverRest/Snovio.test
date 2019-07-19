<?php


namespace App\Library\Services;

use App\Library\Contracts\ParserInterface;
use App\Repositories\EmailRepository;
use App\Repositories\LinkRepository;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\App;

/**
 * Class Parser
 * @package App\Library\Services
 */
class Parser implements ParserInterface
{
    /**
     * @var EmailRepository
     */
    public $emailRepo;
    /**
     * @var LinkRepository
     */
    public $linkRepo;
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

    protected $crawler;

    /**
     * Parser constructor.
     * @param EmailRepository $email
     * @param LinkRepository $link
     */
    public function __construct(EmailRepository $email, LinkRepository $link)
    {
        $this->client = App::make('Goutte\Client');
        $this->linkRepo = $link;
        $this->emailRepo = $email;
    }
    /**
     * @param string $url
     * @return mixed
     */
    public function getCrawler(string $url = '')
    {
        return $this->crawler = $this->client->request('GET', $url);
    }

    /**
     * @param array $options
     * @return string
     */
    public function parse(array $options = [])
    {
        if (empty($this->options)) $this->options = $options;

        try {
                $level = 1;
                $link = $options['url'];
                $parent_id = null;
                for ($j = 1; $j <= $this->options['deep']; $j++)
                {
                    $links = $this->crawler->filter('ul li a');
                    $insideLinks = $links->each(function ($node) {
                        if (Validator::validate('email', $node->attr["href"])) {
                            return $node->attr("href");
                        }
                    });
//                    $emails = $this->>getAllEmails();
                    $this->saveNode($link, $parent_id,$this->getEmails($links));
//                    $link = $this->linkRepo->save(
//                        [
//                            'id' => '',
//                            'link' => $link,
//                            'parent_id' =>$parent_id
//
//                        ]
//                    );
//                    $emails = $this->getEmails();
//                    $this->linkRepo->saveMany($link->id, $emails);

                }
//            $this->getLink($this->options['url']);
//            ++$this->deep;
//            $crawler = $this->client->request('GET', $this->options['url']);
//            $links = $crawler->filter('ul li a');
//            $links->each(function ($node)
//            {
//
//            });
//            echo $crawler->text();exit;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param string $link
     * @param int|null $parent_id
     * @param array $emails
     * @return mixed
     */
    protected function saveNode(string $link = '',int $parent_id = null, array $emails = [])
    {
        $linkEntity = $this->linkRepo->save(
            [
                'id' => '',
                'link' => $link,
                'parent_id' => $parent_id

            ]
        );

        foreach ($emails as $email) {
            if ($this->count <= $this->options['quantity']) {
                $this->emailRepo->save([
                    'email' => $email,
                    'link_id' => $linkEntity->id
                ]);
                $this->count++;
            } else {
                return $linkEntity->with('emails');
            }
        }

        return $linkEntity->with('emails');
    }

    /**
     *  Get email
     * @param string $string
     */
    protected function getEmail(string $string = '')
    {
        if($this->isEmail($string) && $this->options['quantity'] >  $this->count) {
            ++$this->count;
            $this->emails[] = $string;
        }
    }

    /**
     * @param string $string
     */
    protected  function getLink(string $string = '')
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

    /**
     * @param string $string
     * @return bool
     */
    private function isEmail(string $string = ''): bool
    {
        return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $string) !== 0;
    }
}