<?php

use Services\Annotations;
/**
 * Created by PhpStorm.
 * User: christiancannata
 * Date: 28/10/15
 * Time: 15:27
 */
class Routing
{

    protected $annotationService;
    protected $f3;

    public function __construct($f3)
    {
        $this->annotationService = new Annotations();

        $this->f3=$f3;
    }

    public function buildRouting()
    {
        foreach (glob("app/controller/*Controller.php") as $filename) {
            $parsed =  $this->get_string_between($filename, 'controller/', '.php');

            $namespace = "Controller";

            $class_methods =  get_class_methods("\\".$namespace."\\".$parsed);

            foreach ($class_methods as $method) {

                $result = $this->annotationService->getMethodAnnotations("\\".$namespace."\\".$parsed, $method);


                if (isset($result['Route']) && isset($result['Route'][0]['name']) && isset($result['Route'][0]['method'])) {

                    $methodAnnotation = $result['Route'][0]['method'];
                    $nameAnnotation = $result['Route'][0]['name'];

                    $this->f3->route(
                        $methodAnnotation." ".$nameAnnotation,
                        "\\".$namespace."\\".$parsed."::".$method
                    );

                } else {
                    if (strstr($method, "get") || strstr($method, "post") || strstr($method, "delete") || strstr(
                            $method,
                            "get"
                        )
                    ) {
                        $route = explode("/", $this->from_camel_case($method));

                        $this->f3->route(
                            strtoupper($route[0])." /".$route[1],
                            "\\".$namespace."\\".$parsed."::".$method
                        );

                    } else {

                        /*  print_r($result);
                          die();
                          $method=str_replace("Action","",$method);
                          die(var_dump(from_camel_case($method)));*/
                    }

                }

            }


        }
    }


    private
    function from_camel_case(
        $input,
        $separator = "/"
    ) {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }

        return implode($separator, $ret);
    }

    private
    function get_string_between(
        $string,
        $start,
        $end
    ) {
        $string = ' '.$string;
        $ini = strpos($string, $start);
        if ($ini == 0) {
            return '';
        }
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;

        return substr($string, $ini, $len);
    }
}