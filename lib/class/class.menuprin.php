<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: latinex.us
 * Date: 28/8/2019
 * Time: 13:50
 * Proyecto: lx_redmultipago.com
 */

class MenuPrin
{
    public $b;
    public $userTipo = 4;
    public $mm_prin = "";
    public $m = [];
    public $d = "h";

    public function li($file, $label, $preRuta="", $icon="")
    {
        $ruta = empty($preRuta) ? $file : $preRuta . "/" . $file;
        $i = empty($icon) ? "" : '<i class="material-icons">'.$icon.'</i>';
        if($this->d == "h")
        {
            return '<li><a href="' . E_URL . $ruta . '">' . $label . '</a></li>';
        }
        else
        {
            return '<li><a class="waves-effect" href="' . E_URL . $ruta . '">' . $i . $label . '</a></li>';
        }
    }

    public function sb($idL, $idSL, $opt)
    {
        /**
         * Si existe "l" como indice del submeú actual entonces es una vista directa
         */
        if (isset($opt["l"]))
        {
            /**
             *  la opción del sub-menú lleva a una vista directa
             *  http://dominio/vista
             */
            return $this->li($opt["l"], $opt["n"], "", $opt["i"]);
        }
        else
        {
            /**
             *  la opción del sub-menú lleva a una sub-vista
             *  http://dominio/vista/sub-vista
             */
            return $this->li($idSL, $opt["n"], $idL, $opt["i"]);
        }
    }

    public function pp($MM_id, $MM_val)
    {
        $b = $this->b;
        $userTipo = $this->userTipo;

        /**
         *  A continuación pregunto si existe el índice "c" en la opción actual del menú principal
         *  De existir implica que esta opción tendrá un sub-menú desplegable
         */
        if (isset($MM_val["c"]))
        {
            /**
             * La variable $sbMenu contendrá el submenú de la opción actual
             */
            $sbMenu = "";

            /**
             *  A continuación recorro las opciones del sub-menú
             */
            foreach ($MM_val["c"] as $i => $v)
            {
                /**
                 *  Para cada opción del sub-menu pregunto si tiene un indice "u"
                 *  de ser así esto significa que esta opción de sub-menú sólo podría mostrarse a determinados roles
                 */
                if(isset($v["u"]))
                {
                    /**
                     *  Preguntamos si el rol del usuario actual está en el array $v["u"]
                     */
                    if(in_array($userTipo, $v["u"]))
                    {
                        /**
                         *  Creo el elemento de sub-menú
                         */
                        $sbMenu .= $this->sb($MM_id, $i, $v);
                    }
                }
                else
                {
                    /**
                     *  Creo el elemento de sub-menú
                     */
                    $sbMenu .= $this->sb($MM_id, $i, $v);
                }
            }

            $dataTarget = "dd" . ucfirst($MM_id);
            /**
             *  Aquí creo el elemento de dropdown
             *  que quedará oculto hasta que se haga click en el menu principal
             */
            echo $b->blk($sbMenu, ["id" => $dataTarget, "class" => "dropdown-content"], "ul");

            return $b->blk($MM_val["n"], ["class" => "dropdown-trigger btn btn-small mIzq", "data-target" => $dataTarget], "a");
        }
        else
        {
            return $b->blk($MM_val["n"], ["class" => "btn btn-small mIzq", "href" => E_URL . $MM_id], "a");
        }
    }

    public function mmPrin()
    {

        /*    $menuPrincipal = [
        //        "inversiones_admin"=>[
        //            "i"=>"star",
        //            "n"=>"Inversiones",
        //            "c"=>[
        //                "ingresos" => [
        //                    "i"=>"call_received",
        //                    "n"=>"Ingresos"
        //                ],
        //                "egresos" => [
        //                    "i"=>"call_made",
        //                    "n"=>"Egresos"
        //                ],
        //                "bancos"=>[
        //                    "i"=>"casino",
        //                    "n"=>"Bancos",
        //                    "l"=>"bancos"
        //                ],
        //                "cuentas"=>[
        //                    "i"=>"attach_money",
        //                    "n"=>"Cuentas",
        //                    "l"=>"bancos/cuentas",
        //                    "u" => [1]
        //                ]
        //            ],
        //			  "u" => [1,2]
        //        ],
        //        "movimientos_admin"=>[
        //            "i"=>"star",
        //            "n"=>"Movimientos",
        //            "c"=>[
        //                "cobros"=>[
        //                    "i"=>"star",
        //                    "n"=>"Cobros"
        //                ],
        //                "pagos"=>[
        //                    "i"=>"star",
        //                    "n"=>"Pagos"
        //                ]
        //            ]
        //        ],
        //        "rendimiento_admin"=>[
        //            "i"=>"star",
        //            "n"=>"Rendimiento"
        //        ],
        //        "noticias_admin"=>[
        //            "i"=>"star",
        //            "n"=>"Noticias",
        //            "c"=>[
        //                "noticias"=>[
        //                    "i"=>"star",
        //                    "n"=>"Noticias"
        //                ],
        //                "temas"=>[
        //                    "i"=>"star",
        //                    "n"=>"Temas"
        //                ]
        //            ]
        //        ],
        //        "usuarios"=>[
        //            "i"=>"account_circle",
        //            "n"=>"Usuarios"
        //        ],
        //        "salir"=>[
        //            "i"=>"star",
        //            "n"=>"Salir"
        //        ]
        //    ];
        */

        $b = $this->b;
        $userTipo = $this->userTipo;
        $d = $this->d;
        $mm_prin = $this->mm_prin;
        $m = $this->m;

        /**
         *      $d -> define si el menú será mostrado verticalmente u horizontalmente
         *      v: vertical
         *      h: horizaontal
         */
        if($d=="v")
        {
            /**
            foreach($m as $MM_id=>$MM_val)
            {
                if(isset($MM_val["u"]))
                {
                    if (in_array($userTipo, $MM_val["u"]))
                    {
                        if (isset($MM_val["c"])) {
                            $sbMenu = "";
                            foreach ($MM_val["c"] as $i => $v)
                            {
                                if(isset($v["u"]))
                                {
                                    if (in_array($userTipo, $v["u"]))
                                    {
                                        if (isset($v["l"])) {
                                            $sbMenu .= $this->li($v["l"], $v["n"]);
                                        }
                                        else
                                        {
                                            $sbMenu .= $this->li($i, $v["n"], $MM_id);
                                        }
                                    }
                                }
                                else
                                {
                                    if (isset($v["l"]))
                                    {
                                        $sbMenu .= $this->li($v["l"], $v["n"]);
                                    }
                                    else
                                    {
                                        $sbMenu .= $this->li($i, $v["n"], $MM_id);
                                    }
                                }
                            }

                            $sbMenu = $b->blk($sbMenu, ["id" => "dl" . ucfirst($MM_id)], "ul");

                            $mm_prin .= '<li>' . $b->blk($MM_val["n"], ["class" => "btn btn-small mIzq"], "a") . '</li>';
                            $mm_prin .= $b->blk($sbMenu, [], "li");
                        }
                        else
                        {
                            $mm_prin .= '<li>' . $b->blk($MM_val["n"], ["class" => "btn btn-small mIzq mAbajo", "href" => E_URL . $MM_id], "a") . '</li>';
                            $mm_prin .= "<br />";
                        }
                    }
                }
                else
                {
                    if (isset($MM_val["c"])) {
                        $sbMenu = "";
                        foreach ($MM_val["c"] as $i => $v) {
                            if (isset($v["l"])) {
                                //$sbMenu .= '<li><a href="' . E_URL . $v["l"] . '">' . $v["n"] . '</a></li>' . PHP_EOL;
                                $sbMenu .= $this->li($v["l"], $v["n"]);
                            } else {
                                //$sbMenu .= '<li><a href="' . E_URL . $MM_id . "/" . $i . '">' . $v["n"] . '</a></li>' . PHP_EOL;
                                $sbMenu .= $this->li($v["l"], $v["n"], $MM_id);
                            }
                        }

                        $sbMenu = $b->blk($sbMenu, ["id" => "dl" . ucfirst($MM_id)], "ul");

                        $mm_prin .= '<li>' . $b->blk($MM_val["n"], ["class" => "btn btn-small mIzq"], "a") . '</li>';
                        $mm_prin .= $b->blk($sbMenu, [], "li");
                    } else {
                        $mm_prin .= '<li>' . $b->blk($MM_val["n"], ["class" => "btn btn-small mIzq mAbajo", "href" => E_URL . $MM_id], "a") . '</li>';
                        $mm_prin .= "<br />";
                    }
                }
            }
            */

            $listaOpt = '<li><div class="user-view fondo1 cen"><a href="'.E_URL.'inicio"><img class="col8" src="'.E_URL.'public/img/logoSitio.png"></a></div></li>';

            foreach($m as $MM_id=>$MM_val)
            {
                if(isset($MM_val["u"]))
                {
                    if(in_array($userTipo, $MM_val["u"]))
                    {
                        $listaOpt .= '<li><a class="subheader">'.$MM_val["n"].'</a></li>';
                        if(isset($MM_val["c"]))
                        {
                            foreach ($MM_val["c"] as $i => $v)
                            {
                                if(isset($v["u"]))
                                {
                                    if(in_array($userTipo, $v["u"]))
                                    {
                                        $listaOpt .= $this->sb($MM_id, $i, $v);
                                    }
                                }
                                else
                                {
                                    $listaOpt .= $this->sb($MM_id, $i, $v);
                                }
                            }
                        }
                        else
                        {
                            $listaOpt .= $this->li($MM_id, $MM_val["n"], "", $MM_val["i"]);
                        }
                        $listaOpt .= '<li><div class="divider"></div></li>';
                    }
                }
                else
                {
                    $listaOpt .= '<li><a class="subheader">'.$MM_val["n"].'</a></li>';
                    if(isset($MM_val["c"]))
                    {
                        foreach ($MM_val["c"] as $i => $v)
                        {
                            if(isset($v["u"]))
                            {
                                if(in_array($userTipo, $v["u"]))
                                {
                                    $listaOpt .= $this->sb($MM_id, $i, $v);
                                }
                            }
                            else
                            {
                                $listaOpt .= $this->sb($MM_id, $i, $v);
                            }
                        }
                    }
                    else
                    {
                        $listaOpt .= $this->li($MM_id, $MM_val["n"], "", $MM_val["i"]);
                    }
                    $listaOpt .= '<li><div class="divider"></div></li>';
                }
            }
            $mm_prin = $b->blk($listaOpt, ["class"=>"sidenav", "id"=>"slide-out"],"ul");
        }
        else
        {
            /**
             *  Es un menú horizontal
             *  A continuación recorro la lista de las opciones principales de menú
             */
            foreach($m as $MM_id=>$MM_val)
            {
                /**
                 *  Pregunto si el elemento actual tiene un indice "u"
                 *  de ser así implica que será un elemento visible sólo para cierto
                 */
                if(isset($MM_val["u"]))
                {
                    /**
                     *  El valor de $MM_val["u"] siempre será un arreglo
                     *  con los indices de los roles autorizados
                     *  Entonces pregunto si el rol del usuario actual se encuentra en dicho array
                     */
                    if(in_array($userTipo, $MM_val["u"]))
                    {
                        /**
                         *  Si el rol asignado al usuario actual está en el Array $MM_val["u"]
                         *  entonces continuamos a buscar los contenidos de esta opción de menú principal
                         */
                        $mm_prin .= $this->pp($MM_id, $MM_val);
                    }
                }
                else
                {
                    $mm_prin .= $this->pp($MM_id, $MM_val);
                }
            }
        }
        return $mm_prin;
    }
}

