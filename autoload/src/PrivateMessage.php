<?php

    namespace Message;

    class PrivateMessage {
        private string $text;
        private string $user;

        public function __construct(string $text, string $user) {
            $this->text = $text;
            $this->user = $user;
        }

        public function sent() {
            echo "Sent message only to user " . $this->user;
        }

    }
?>

