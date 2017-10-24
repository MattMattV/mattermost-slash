<?php

namespace MV\SlashCommands\Controllers;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class Ah
 * @package MV\SlashCommands\Controllers
 */
class Comic
{
    /**
     * @var null|Container the current DI container of the Slim app object
     */
    private $container = null;

    const COMICS = array(
      array("name" => "commitstrip", "url" => "http://www.commitstrip.com/[LANG]/rss", "lang" => array("fr", "en")),
      array("name" => "cyanide", "url" => "http://explosm.net/", "lang" => array("en"))
    );

    CONST ERROR_1 = "No src on tag";
    CONST ERROR_2 = "Can't load content in DOM Parser";

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function __invoke(Request $request, Response $response)
    {
        $myExplode = explode(' ', urldecode($request->getParam('text')) );
        if( count($myExplode) > 0 ) {
            $comicName = $myExplode[0];
        }
        else {
            $comicName = '';
        }
        if( count($myExplode) > 1 ) {
            $comicLang = $myExplode[1];
        }
        else {
            $comicLang = NULL;
        }
        //Test if comic exist
        if( in_array( strtolower($comicName), array_map(function($item) {
            return $item["name"];
        }, self::COMICS)) ) {
            $status = false;
            $imageUrl = $this->findComicUrl($comicName, $comicLang, $status);

            if( ! $status ) {
                //Error message
                $message = [
                    'response_type' => 'ephemeral',
                    'text' => $comicName . " | Error : " . $imageUrl,
                    'user_name' => $request->getParam('user_name')
                ];
            }
            else {
                $message = [
                    'response_type' => 'in_channel',
                    'text' => "![" . $comicName . "](" . $imageUrl . ")",
                    'user_name' => $request->getParam('user_name')
                ];
            }
        }
        else {
            //Error message
            $message = [
                'response_type' => 'ephemeral',
                'text' => $comicName . " not exist, you can use :\n" . implode("\n", array_map(function($item) {
                  return " - " .$item["name"];
                }, self::COMICS)),
                'user_name' => $request->getParam('user_name')
            ];
        }

        return $response->withJson($message);
    }

    private function findComicUrl($name, $lang = NULL, &$status) {
        $status = false;
        switch ( $name ) {
            case self::COMICS[0]["name"]:
                //Detect lang
                if( $lang == NULL || ! in_array($lang, self::COMICS[0]["lang"]) ) {
                    $lang = self::COMICS[0]["lang"][0];
                }

                $myRss = simplexml_load_string( file_get_contents(str_replace("[LANG]", $lang, self::COMICS[0]["url"])) );
                $elems = $myRss->xpath(".//link");
                if( count( $elems ) > 1 ) {
                    $domParser = new \DOMDocument();
                    if( $domParser->loadHTML(file_get_contents( str_replace("/fr/", "/" . $lang . "/", $elems[1]->__toString() ) ) ) ) {
                        $elems = $domParser->getElementsByTagName('img');
                        foreach( $elems as $elem ) {
                            if( $elem->hasAttribute("class") ) {
                                $status = true;
                                if( $elem->hasAttribute("src") ) {
                                    $status = true;
                                    return $elem->getAttribute("src");
                                }
                                return self::ERROR_1;
                            }
                        }
                    }
                }
                return self::ERROR_2;
                break;

            case self::COMICS[1]["name"]:
                $domPaser = new \DOMDocument();
                if( $domPaser->loadHTML(file_get_contents(self::COMICS[1]["url"]) ) ) {
                    $elem = $domPaser->getElementById('featured-comic');
                    if( $elem->hasAttribute("src") ) {
                        $status = true;
                        return $elem->getAttribute("src");
                    }
                    return self::ERROR_1;
                }
                return self::ERROR_2;
                break;
          }

        return NULL;
    }
}
