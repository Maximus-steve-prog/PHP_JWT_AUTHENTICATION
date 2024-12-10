<?php 

    class Response{
        private $content;
        private $statusCode;
        public function __construct($content,$statusCode){
            $this->content = $content;
            $this->statusCode = $statusCode;
        }

        /**
         * Get the value of statusCode
         */ 
        public function getStatusCode()
        {
                return $this->statusCode;
        }

        /**
         * Set the value of statusCode
         *
         * @return  self
         */ 
        public function setStatusCode($statusCode)
        {
                $this->statusCode = $statusCode;

                return $this;
        }

        /**
         * Get the value of content
         */ 
        public function getContent()
        {
                return $this->content;
        }

        /**
         * Set the value of content
         *
         * @return  self
         */ 
        public function setContent($content)
        {
                $this->content = $content;

                return $this;
        }
    }


?>