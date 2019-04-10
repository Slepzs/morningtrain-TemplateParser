<?php


class Template {

    /*
     * Privat property der kan holde alle vores variabler.
     * */
    private $vars = array();

    /* function som sætter navnet på variablen lige med værdien.  */
    public function assign($key, $value) {
        $this->vars[$key] = $value;
    }

    /* Function som tager navnet på vores template og render den som html.  */
    public function render($template_name){
        /* Filnavnet og Extension. Giver os mulighed for selv at vælge om det skal være .html eller .php alt efter hvad vi ønsker. */
        $path = $template_name . '.html';

        /* Hvis Filen existerer så find den. */
        if(file_exists($path)) {
            /* file_get_contents læser alt indholdet af filen som en string */
            $contents = file_get_contents($path);

            /* Hver variable indsat i dokument bliver så erstattet af værdierne, som er angivet i dokumentet */
            foreach($this->vars as $key => $value) {
                $contents = preg_replace('/\[' . $key .'\]/', $value, $contents);
            }

            /* Her gør vi det muligt at bruge forskellige betingelser, som f.eks. if statements. */
            $contents = preg_replace('/\<\!\-\- if (.*) \-\-\>/', '<?php if ($1) : ?>', $contents);
            $contents = preg_replace('/\<\!\-\- else \-\-\>/', '<?php else : ?>', $contents);
            $contents = preg_replace('/\<\!\-\- endif \-\-\>/', '<?php endif ; ?>', $contents);

            /*
             * eval gør den muligt for os a bruge php kode i filen. I stedet for et simpelt echo'
             * */
            eval(' ?>'. $contents . '<?php ');
            // echo $contents;
        } else {
            /* Exit med Fejl kode. */
            exit('<h1>Template Error</h1>');
        }
    }




}



?>