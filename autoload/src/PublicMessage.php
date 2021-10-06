<?php

    namespace Message;

    class PublicMessage {
        private string $text;

        public function __construct(string $text) {
            $this->text = $text;
        }

        public function sent() {
            echo "Sent message to all users ";
        }

    }
?>

