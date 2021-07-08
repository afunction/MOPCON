<?php

namespace MopCon;

class BaseComponent
{
    protected $twig_template_path;

    public function __construct($twig_template_path = __DIR__ . '/../template')
    {
        $this->twig_template_path = $twig_template_path;
    }

    /**
     * @param string $file_path
     * @return array
     */
    public function getConfig($file_path = __DIR__ . '/../config.php')
    {
        if (!file_exists($file_path)) {
            throw new \Exception('file not found');
        }

        return require $file_path;
    }

    /**
     * @return string
     */
    public function getBaseUri()
    {
        return isset($this->getConfig()['base_uri']) ? $this->getConfig()['base_uri'] : 'https://mopcon.org';
    }

    public function render($template_name, $params = [])
    {
        $main_i18n = [
            'zh' => [
                'sitetitle' => '行動科技年會 | Mobile / Open / Platform Conference',
                'ogtitle' => '行動科技年會 | Mobile / Open / Platform Conference',
                'ogsitename' => '行動科技年會 | Mobile / Open / Platform Conference',
                'ogdesc' => '濁水溪以南最強大行動科技研討會',
                'nav' => [
                    'code_of_conduct' => 'MOPCON 行動準則',
                    'album' => '歷年相簿',
                    'contact_us' => '聯絡我們'
                ],
                'his_mopcon' => '歷年 MOPCON',
            ],
            'en' => [
                'sitetitle' => 'MOPCON | Mobile / Open / Platform Conference',
                'ogtitle' => 'MOPCON | Mobile / Open / Platform Conference',
                'ogsitename' => 'MOPCON | Mobile / Open / Platform Conference',
                'ogdesc' => 'Your favoeite conference for mobile technology in southern Taiwan',
                'nav' => [
                    'code_of_conduct' => 'MOPCON Code of Conduct',
                    'album' => 'Album',
                    'contact_us' => 'Contact Us'
                ],
                'his_mopcon' => 'Past MOPCON',
            ]
        ];

        $i18n = $this->getI18n($main_i18n);
        $webParams = str_replace(['&lang=zh', '&lang=en'], ['', ''], isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : "");
        $params = array_merge($params, [
            'i18n' => $i18n,
            'webParams' => $webParams,
            'current_year' => date('Y')
        ]);
        $loader = new \Twig_Loader_Filesystem($this->twig_template_path);
        $twig = new \Twig_Environment($loader);

        echo $twig->render($template_name, $params);
    }

    /**
     * @param array $msg_data
     * @return array
     */
    protected function getI18n(array $msg_data)
    {
        if (empty($msg_data)) {
            return [];
        }

        $lang = $this->getLang();

        if (isset($msg_data[$lang])) {
            return $msg_data[$lang];
        }
        if (isset($msg_data['en'])) {
            return $msg_data['en'];
        }
        return reset($msg_data);
    }

    /**
     * @return string
     */
    protected function getLang()
    {
        $lang = &$_GET['lang'];

        if (in_array($lang, ['zh', 'en'])) {
            setcookie('lang', $lang);
            return $lang;
        }

        return isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'zh';
    }
}
