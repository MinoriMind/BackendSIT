<?php

    namespace Message;

    class Message {
        private string $text;

        public function __construct(string $text) {
            $this->text = $text;
        }
    }
?>
